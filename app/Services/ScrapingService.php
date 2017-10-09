<?php


namespace App\Services;


use App\Chunk;
use App\Publication;
use App\Run;
use App\Services\Scrapers\Exceptions\BadRequestException;
use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\Scrapers\ScraperStrategyFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ScrapingService
{
    const PRIORITY_NATIONAL = 0; //Estatal
    const PRIORITY_ADMINISTRATIVE_AREA_1 = 1; //Comunidad
    const PRIORITY_ADMINISTRATIVE_AREA_2 = 2; //Provincia
    const PRIORITY_CITY = 3; //Alcaldia

    //Estatal
    const BOLETIN_OFICIAL_DEL_ESTADO = 0;

    //Comunidad
    const BOLETIN_OFICIAL_DE_LA_JUNTA_DE_ANDALUCIA = 1;
    const BOLETIN_OFICIAL_DE_ARAGON = 2;
    const BOLETIN_OFICIAL_DEL_PRINCIPADO_DE_ASTURIAS = 3;
    const BOLETIN_OFICIAL_DE_ISLAS_BALEARES = 4;
    const BOLETIN_OFICIAL_DE_CANARIAS = 5;
    const BOLETIN_OFICIAL_DE_CANTABRIA = 6;
    const DIARIO_OFICIAL_DE_CASTILLA_LA_MANCHA = 7;
    const BOLETIN_OFICIAL_DE_CASTILLA_Y_LEON = 8;
    const DIARI_OFICIAL_DE_LA_GENERALITAT_DE_CATALUNYA = 9;
    const DIARIO_OFICIAL_DE_EXTREMADURA = 10;
    const DIARIO_OFICIAL_DE_GALICIA = 11;
    const BOLETIN_OFICIAL_DE_LA_RIOJA = 12;
    const BOLETIN_OFICIAL_DE_LA_COMUNIDAD_DE_MADRID = 13;
    const BOLETIN_OFICIAL_DE_LA_REGION_DE_MURCIA = 14;
    const BOLETIN_OFICIAL_DE_NAVARRA = 15;
    const BOLETIN_OFICIAL_DEL_PAIS_VASCO = 16;
    const DIARI_OFICIAL_DE_LA_COMUNITAT_VALENCIANA = 17;
    const BOLETIN_OFICIAL_DE_LA_CIUDAD_AUTONOMA_DE_CEUTA = 18;
    const BOLETIN_OFICIAL_DE_LA_CIUDAD_AUTONOMA_DE_MELILLA = 19;

    const RUN_RESULT_OK = 'ok';
    const RUN_RESULT_ERROR = 'error';

    const PDF_EXTENSION = 'pdf';
    const PDF_EXTENSION_MAY = 'PDF';
    const URL_HASH_FUNCTION = 'md5';

    private $splitService;
    private $scheduleService;

    /**
     * ScrapingService constructor.
     */
    public function __construct()
    {
        $this->splitService = new FileSplitService();
        $this->scheduleService = new PublicationsScheduleService();
    }


    public function updateIndexes()
    {
        Log::debug("Updating all indexes");

        $publications = Publication::all();
        foreach ($publications as $publication) {
            $scrapper = ScraperStrategyFactory::getScrapperStrategy($publication->id);
            if ($this->shouldRunScraper($scrapper, $publication)) {
                $this->run($publication, $scrapper);
            }
        }
    }

    public function updateIndex($id)
    {
        Log::debug("Updating {$id} indexes");
        $publication = Publication::find($id);

        if (!$publication) {
            Log::debug("Runner for publication {$id} not found");
            return;
        }

        $scrapper = ScraperStrategyFactory::getScrapperStrategy($publication->id);
        if ($scrapper) {
            $this->run($publication, $scrapper);
        }
    }

    private function run(Publication $publication, IBoletinScraperStrategy $scrapper)
    {
        $run = new Run();
        $boletinId = $publication->id;
        $regionName = $publication->name;
        $priority = $publication->priority;

        $run->publication_id = $boletinId;

        Log::debug("Updating index of {$regionName}");

        $microsecondsBefore = microtime(true);

        $oldCount = Chunk::where('publication_name', $regionName)->count();
        $newCount = $oldCount;

        try {
            $urls = $scrapper->downloadFilesFromInternet();

            Log::debug("Parsing {$newCount} files.");

            $this->saveFiles($urls, $regionName, $priority);

            $run->result = self::RUN_RESULT_OK;
            $newCount = Chunk::where('publication_name', $regionName)->count();
            $publication->last_success_run_at = Carbon::now();
        } catch (ClientException $e) {
            Log::debug("Error updating {$regionName}: error al obtener la url " . $e->getRequest()->getUri());
            $run->result = self::RUN_RESULT_ERROR;
        } catch (\ErrorException $e) {
            Log::debug("Error updating {$regionName}: " . $e->getTraceAsString());
            $run->result = self::RUN_RESULT_ERROR;
        } catch (BadRequestException $e) {
            Log::debug("Error updating {$regionName}: error al obtener la url " . $e->url);
            $run->result = self::RUN_RESULT_ERROR;
        } catch (\PDOException $e) {
            Log::debug("Error updating {$regionName}: error al guardar el documento " . $e->getTraceAsString());
            $run->result = self::RUN_RESULT_ERROR;
        } catch (Exception $e) {
            Log::debug("Error updating {$regionName}: " . $e->getTraceAsString());
            $run->result = self::RUN_RESULT_ERROR;
        }

        $microsecondsAfter = microtime(true);
        $run->duration = $microsecondsAfter - $microsecondsBefore;
        $run->new_files = $newCount - $oldCount;
        $run->save();

        $publication->last_run_result = $run->result;
        $publication->last_run_at = Carbon::now();
        $publication->save();
    }

    private function saveFiles($urls, $regionName, $priority)
    {
        foreach ($urls as $url) {
            $this->parseFile($url, $regionName, $priority);
        }
    }


    /**
     * @param $url
     * @param $regionName
     * @param $priority
     */
    private function parseFile($url, $regionName, $priority)
    {
        if ($this->exists($url)) return;

        $response = $this->getHttpGetResponse($url);

        $content = (string)$response->getBody();

        if (!$content || strlen($content) <= 10) return;

        $content = $this->getPlainTextFromRemotePdf($url, $content);

        if (!$content || strlen($content) <= 10) return;

        $publishedAt = $this->getFileDate($response);

        $this->storeText($url, $content, $regionName, $priority, $publishedAt);
    }

    /**
     * @param $url
     * @param $text
     * @param $regionName
     * @param $priority
     * @param $publishedAt
     */
    private function storeText($url, $text, $regionName, $priority, $publishedAt)
    {
        $chunks = $this->splitService->splitDocument($text);

        foreach ($chunks as $content) {
            $this->createChunk($url, $content, $regionName, $priority, $publishedAt);
        }
    }


    /**
     * @param string $url
     * @param string $content
     * @param string $regionName
     * @param int $priority
     * @param Carbon $publishedAt
     */
    private function createChunk(string $url, string $content, string $regionName, int $priority, Carbon $publishedAt)
    {
        $chunk = new Chunk();
        $chunk->url = $url;
        $chunk->publication_name = $regionName;
        $chunk->publication_priority = $priority;
        $chunk->published_at = $publishedAt;
        $chunk->content = $content;
        $chunk->save();
    }

    /**
     * @param $filename
     * @return string
     */
    private function getFullPath($filename)
    {
        $fullFilePath = storage_path('app/' . $filename);
        return $fullFilePath;
    }

    /**
     * @param $filename
     * @return bool|string
     */
    private function getContentFromPDF($filename)
    {
        Log::debug("Parsing pdf: " . $filename);

        $fullFilePath = $this->getFullPath($filename);

        $fullPathWithText = storage_path('app/' . $filename . '.txt');

        exec("pdftotext -enc ASCII7 {$fullFilePath} {$fullPathWithText}");

        if (!file_exists($fullPathWithText)) {
            return false;
        }

        $content = file_get_contents($fullPathWithText);
        unlink($fullPathWithText);
        return $content;
    }

    /**
     * @param IBoletinScraperStrategy $scrapper
     * @param Publication $publication
     * @return bool
     */
    private function shouldRunScraper(IBoletinScraperStrategy $scrapper, Publication $publication): bool
    {
        return $scrapper && $this->scheduleService->isTodayAPublicationDay($publication->priority);
    }

    /**
     * @param $url
     * @return bool
     */
    private function exists($url)
    {
        return Chunk::where('url', $url)->first() != null;
    }

    /**
     * @param $url
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function getHttpGetResponse($url)
    {
        $try = 3;
        while ($try) {
            try {
                $client = new Client();
                return $client->request('GET', $url);
            } catch (RequestException $e) {
                $try--;
            }
        }
        return null;
    }

    /**
     * @param $response
     * @return Carbon
     */
    private function getFileDate($response): Carbon
    {
        $lastModifiedHeader = $response->getHeader('Last-Modified');

        if (!$lastModifiedHeader) return Carbon::now();

        return Carbon::parse($lastModifiedHeader[0]);
    }

    /**
     * @param $url
     * @param $content
     * @return bool|string
     */
    private function getPlainTextFromRemotePdf($url, $content)
    {
        $filename = hash(self::URL_HASH_FUNCTION, $url);

        Storage::put($filename, $content);
        $content = $this->getContentFromPDF($filename);
        Storage::delete($filename);

        return $content;
    }


}