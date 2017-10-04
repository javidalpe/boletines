<?php


namespace App\Services;


use App\Chunk;
use App\Publication;
use App\Run;
use App\Services\Scrapers\Exceptions\BadRequestException;
use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\Scrapers\ScraperStrategyFactory;
use GuzzleHttp\Exception\ClientException;
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
        $oldFiles = $scrapper->getFiles();
        $oldCount = count($oldFiles);
        $newCount = $oldCount;

        try {
	        $scrapper->downloadFilesFromInternet();
	        $files = $scrapper->getFiles();
	        $newCount = count($files);

	        Log::debug("Parsing {$newCount} files.");

	        $this->saveFiles($files, $regionName, $priority);

	        $run->result = self::RUN_RESULT_OK;
	        $publication->last_success_run_at = Carbon::now();
        } catch (ClientException $e) {
	        Log::debug("Error updating {$regionName}: error al obtener la url "  . $e->getRequest()->getUri());
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

    private function saveFiles($files, $regionName, $priority)
    {
        foreach ($files as $file) {
            $this->parseFile($file, $regionName, $priority);
        }
    }


    /**
     * @param $filename
     * @param $regionName
     * @param $priority
     */
    private function parseFile($filename, $regionName, $priority)
    {
        $info = pathinfo($filename);

        if ($info['extension'] != self::PDF_EXTENSION && $info['extension'] != self::PDF_EXTENSION_MAY) return;

        $destinationPath = str_replace("public/", "", $filename);

        $existingDocument = Chunk::where('filename', $destinationPath)->first();

        if ($existingDocument) return;

        Log::debug("Parsing pdf: " . $filename);

        $content = $this->getContentFromPDF($filename);

        if (!$content) return;

        $publishedAt = Storage::lastModified($filename);

        $this->storeText($destinationPath, $content, $regionName, $priority, $publishedAt);
    }

    /**
     * @param $destinationPath
     * @param $text
     * @param $regionName
     * @param $priority
     * @param $publishedAt
     */
    private function storeText($destinationPath, $text, $regionName, $priority, $publishedAt)
    {
        $chunks = $this->splitService->splitDocument($text);


        foreach ($chunks as $content) {
	        $this->createChunk($destinationPath, $content, $regionName, $priority, $publishedAt);
        }
    }


    /**
     * @param $filename
     * @param $content
     * @param $regionName
     * @param $priority
     * @param $publishedAt
     */
    private function createChunk($filename, $content, $regionName, $priority, $publishedAt)
    {
        $chunk = new Chunk();
        $chunk->filename = $filename;
        $chunk->publication_name = $regionName;
        $chunk->publication_priority = $priority;
        $chunk->published_at = Carbon::createFromTimestamp($publishedAt);
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
        $fullFilePath = $this->getFullPath($filename);
        $pathIfo = pathinfo($fullFilePath);

        $fullPathWithText = storage_path('app/tmp/' . $pathIfo['filename'] . '.txt');

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
    private function shouldRunScraper(IBoletinScraperStrategy $scrapper, Publication $publication) : bool
    {
        return $scrapper && $this->scheduleService->isTodayAPublicationDay($publication->priority);
    }


}