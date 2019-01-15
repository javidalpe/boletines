<?php


namespace App\Services;


use App\Chunk;
use App\Publication;
use App\Run;
use App\Services\Scrapers\Exceptions\BadRequestException;
use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\Scrapers\ParseContentStrategy\ParseContentStrategyFactory;
use App\Services\Scrapers\ScraperStrategyFactory;
use App\Services\Scrapers\StorageStrategy\StorageStrategyFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ScrapingService
{
	const PRIORITY_NATIONAL = 0; //Estatal y Europeo
	const PRIORITY_ADMINISTRATIVE_AREA_1 = 1; //Comunidad
	const PRIORITY_PROVINCE = 2; //Provincia
	const PRIORITY_CITY = 3; //Alcaldia

    //Estatal
    const BOLETIN_OFICIAL_DEL_ESTADO = 0;

    //Europeo
    const DIARIO_OFICIAL_DE_LA_UNION_EUROPEA = 1;

	//Comunidad
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
    const BOLETIN_OFICIAL_DE_LA_JUNTA_DE_ANDALUCIA = 20;

    //Provincias
    const BOLETIN_A_CORUNA = 21;
    const BOLETIN_TERRITORIO_HISTORICO_DE_ALAVA = 22;
    const BOLETIN_ALBACETE = 23;
    const BOLETIN_ALICANTE = 24;
    const BOLETIN_ALMERIA = 25;
    const BOLETIN_AVILA = 26;
    const BOLETIN_BADAJOZ = 27;
    const BOLETIN_BARCELONA = 28;
    const BOLETIN_BURGOS = 29;
    const BOLETIN_CACERES = 30;
    const BOLETIN_CADIZ = 31;
    const BOLETIN_CASTELLON = 32;
    const BOLETIN_CIUDAD_REAL = 33;
    const BOLETIN_CORDOBA = 34;
    const BOLETIN_CUENCA = 35;
    const BOLETIN_GIRONA = 36;
    const BOLETIN_GRANADA = 37;
    const BOLETIN_GUADALAJARA = 38;
    const BOLETIN_GUIPUZKOA = 39;
    const BOLETIN_HUELVA = 40;
    const BOLETIN_HUESCA = 41;
    const BOLETIN_JAEN = 42;
    const BOLETIN_LAS_PALMAS = 43;
    const BOLETIN_LEON = 44;
    const BOLETIN_LLEIDA = 45;
    const BOLETIN_LUGO = 46;
    const BOLETIN_MALAGA = 47;
    const BOLETIN_OURENSE = 48;
    const BOLETIN_PALENCIA = 49;
    const BOLETIN_PONTEVEDRA = 50;
    const BOLETIN_SALAMANCA = 51;
    const BOLETIN_SANTA_CRUZ_DE_TENERIFE = 52;
    const BOLETIN_SEGOVIA = 53;
    const BOLETIN_SEVILLA = 54;
    const BOLETIN_SORIA = 55;
    const BOLETIN_TARRAGONA = 56;
    const BOLETIN_TERUEL = 57;
    const BOLETIN_TOLEDO = 58;
    const BOLETIN_VALENCIA = 59;
    const BOLETIN_VALLADOLID = 60;
    const BOLETIN_VIZCAYA = 61;
    const BOLETIN_ZAMORA = 62;
    const BOLETIN_ZARAGOZA = 63;

	const RUN_RESULT_OK = 'ok';
	const RUN_RESULT_ERROR = 'error';

	const PDF_EXTENSION = 'pdf';
	const PDF_EXTENSION_MAY = 'PDF';

    const PAGINATION_REGEX = '/\sp[aá]g[º\-\.]?\s*\d+/miu';
    const NUMERATION_REGEX = '/\sn([uú]m)?[º\-\.]?\s*\d+/miu';
    const ALPHA_NUMERATION_REGEX = '/\s[a-zA-Z]\)/miu';
    const SECTION_REGEX = '/\s(\d+\.)+\d*\s?\-?/miu';
    const POSITION_REGEX = '/(PRIMERO|SEGUNDO|TERCERO|CUARTO|QUINTO|SEXTO|SEPTIMO)\.?\s?\–?/miu';

	private $splitService;
	private $scheduleService;
	private $scraperStrategyFactory;
	private $storageStrategyFactory;
	private $parseContentStrategyFactory;


	/**
	 * ScrapingService constructor.
	 *
	 * @param FileSplitService            $splitService
	 * @param PublicationsScheduleService $scheduleService
	 * @param StorageStrategyFactory      $storageStrategyFactory
	 * @param ScraperStrategyFactory      $scraperStrategyFactory
	 * @param ParseContentStrategyFactory $parseContentStrategyFactory
	 */
    public function __construct(FileSplitService $splitService,
                                PublicationsScheduleService $scheduleService,
                                StorageStrategyFactory $storageStrategyFactory,
                                ScraperStrategyFactory $scraperStrategyFactory,
								ParseContentStrategyFactory $parseContentStrategyFactory)
	{
		$this->splitService = $splitService;
		$this->scheduleService = $scheduleService;
		$this->scraperStrategyFactory = $scraperStrategyFactory;
		$this->storageStrategyFactory = $storageStrategyFactory;
		$this->parseContentStrategyFactory = $parseContentStrategyFactory;
	}


	public function updateIndexes()
	{
		Log::debug("Updating all indexes");

		$publications = Publication::all();
		foreach ($publications as $publication) {
			$scrapper = $this->scraperStrategyFactory->getScrapperStrategy($publication);

			if (!$scrapper) continue;

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

		$scrapper = $this->scraperStrategyFactory->getScrapperStrategy($publication);
		if ($scrapper) {
			$this->run($publication, $scrapper);
		}
	}

	private function run(Publication $publication, IBoletinScraperStrategy $scrapper)
	{
		$run = new Run();
		$boletinId = $publication->id;
		$regionName = $publication->name;

		$run->publication_id = $boletinId;

		Log::debug("Updating index of {$regionName}");

		$microsecondsBefore = microtime(true);

		$oldCount = Chunk::where('publication_name', $regionName)->count();
		$newCount = $oldCount;

		try {
			$requests = $scrapper->downloadFilesFromInternet();
			$urls = array_map(function ($request) {
                return $request->url;
            }, $requests);

			Log::debug("Handling " . count($urls) . " urls.");

			$this->saveFiles($urls, $publication);

			$run->result = self::RUN_RESULT_OK;
			$newCount = Chunk::where('publication_name', $regionName)->count();
			$publication->last_success_run_at = Carbon::now();
		} catch (ServerException $e) {
			Log::debug("Error updating {$regionName}: error de servidor en " . $e->getRequest()->getUri());
			$run->result = self::RUN_RESULT_ERROR;
		} catch (ClientException $e) {
			Log::debug("Error updating {$regionName}: error cliente al obtener la url " . $e->getRequest()->getUri() . " : " . $e->getMessage());
			$run->result = self::RUN_RESULT_ERROR;
		} catch (\ErrorException $e) {
		    if (config('app.debug')) {
		        throw $e;
            }
			Log::debug("Error updating {$regionName}: " . $e->getTraceAsString());
			$run->result = self::RUN_RESULT_ERROR;
		} catch (BadRequestException $e) {
			Log::debug("Error updating {$regionName}: error en la petición al obtener la url " . $e->url);
			$run->result = self::RUN_RESULT_ERROR;
		} catch (\PDOException $e) {
			Log::debug("Error updating {$regionName}: error al guardar el documento " . $e->getTraceAsString());
			$run->result = self::RUN_RESULT_ERROR;
		}

		$microsecondsAfter = microtime(true);
		$run->duration = $microsecondsAfter - $microsecondsBefore;
		$new_files = $newCount - $oldCount;
		$run->new_files = $new_files;
		$run->save();

		Log::debug("Finished with {$new_files} new files");

		$publication->last_run_result = $run->result;
		$publication->last_run_at = Carbon::now();
		$publication->save();
	}

	/**
	 * @param                          $urls
	 * @param Publication              $publication
	 */
	private function saveFiles($urls, Publication $publication)
	{
		foreach ($urls as $url) {
			$this->parseFile($url, $publication);
		}
	}


	/**
	 * @param                          $originUrl
	 * @param Publication              $publication
	 */
	private function parseFile($originUrl, Publication $publication)
	{
		$storeStrategy = $this->storageStrategyFactory->getStorageStrategyForPublication($publication);

		if ($storeStrategy->fileExists($originUrl)) return;

		$response = $this->getHttpGetResponse($originUrl);

		if (!$response) return;

		$content = (string)$response->getBody();

		if (!$content || strlen($content) <= 10) return;

		$parseStrategy = $this->parseContentStrategyFactory->getParseContentStrategy($publication);
		$plainText = $parseStrategy->parseBodyContent($content, $originUrl);

		if (!$plainText || strlen($plainText) <= 10) return;

		$publishedAt = $this->getFileDate($response);

		$storeUrl = $storeStrategy->saveDocument($content, $originUrl);

		$reducedText = $this->removeUselessCharacters($plainText);

		$this->storeText($storeUrl, $reducedText, $publication, $publishedAt);
	}

	/**
	 * @param             $storeUrl
	 * @param             $text
	 * @param Publication $publication
	 * @param Carbon      $publishedAt
	 */
	private function storeText($storeUrl, $text, Publication $publication, Carbon $publishedAt)
	{
		$chunks = $this->splitService->splitDocument($text);

		foreach ($chunks as $content) {
			$this->createChunk($storeUrl, $content, $publication, $publishedAt);
		}
	}


	/**
	 * @param string      $storedUrl
	 * @param string      $content
	 * @param Publication $publication
	 * @param Carbon      $publishedAt
	 */
	private function createChunk(string $storedUrl, string $content, Publication $publication, Carbon $publishedAt)
	{
		$chunk = new Chunk();
		$chunk->url = $storedUrl;
		$chunk->publication_name = $publication->name;
		$chunk->publication_priority = $publication->priority;
		$chunk->published_at = $publishedAt;
		$chunk->content = $content;
		$chunk->save();
	}


	/**
	 * @param IBoletinScraperStrategy $scrapper
	 * @param Publication             $publication
	 *
	 * @return bool
	 */
	private function shouldRunScraper(IBoletinScraperStrategy $scrapper, Publication $publication): bool
	{
		return $this->scheduleService->isTodayAPublicationDay($publication->priority);
	}

	/**
	 * @param $url
	 *
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 */
	private function getHttpGetResponse($url)
	{
		$try = 3;
		while ($try) {
			try {
				$client = new Client(['verify' => false]);

				return $client->request('GET', $url);
			} catch (RequestException $e) {
				$try--;
			}
		}

		return null;
	}

	/**
	 * @param      $response
	 * @param bool $useLastModifiedHeader
	 *
	 * @return Carbon
	 */
	private function getFileDate($response, $useLastModifiedHeader = false): Carbon
	{
		if (!$useLastModifiedHeader) {
			return Carbon::now();
		}

		$lastModifiedHeader = $response->getHeader('Last-Modified');

		if (!$lastModifiedHeader) return Carbon::now();

		return Carbon::parse($lastModifiedHeader[0]);
	}


    /**
     * @param $plainText
     *
     * @return string
     */
    private function removeUselessCharacters($plainText)
    {
        $reduced = preg_replace(self::PAGINATION_REGEX, '', $plainText);
        $reduced = preg_replace(self::NUMERATION_REGEX, '', $reduced);
        $reduced = preg_replace(self::ALPHA_NUMERATION_REGEX, '', $reduced);
        $reduced = preg_replace(self::SECTION_REGEX, '', $reduced);
        $reduced = preg_replace(self::POSITION_REGEX, '', $reduced);

        return $reduced;
    }


}
