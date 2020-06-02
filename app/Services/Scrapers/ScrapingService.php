<?php


namespace App\Services;


use App\Chunk;
use App\Publication;
use App\Run;
use App\SearchablePage;
use App\Services\Scrapers\Exceptions\BadRequestException;
use App\Services\Scrapers\Http\HttpService;
use App\Services\Scrapers\Http\Request;
use App\Services\Scrapers\Http\Response;
use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\Scrapers\ParseContentStrategy\ParseContentStrategyFactory;
use App\Services\Scrapers\ScraperStrategyFactory;
use App\Services\Scrapers\StorageStrategy\StorageStrategyFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
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


    //Borme
	const BOLETIN_OFICIAL_DEL_REGISTRO_MERCANTIL = 2;

	//Comunidad
	const BOLETIN_OFICIAL_DE_ARAGON = 3;
	const BOLETIN_OFICIAL_DEL_PRINCIPADO_DE_ASTURIAS = 4;
	const BOLETIN_OFICIAL_DE_ISLAS_BALEARES = 5;
	const BOLETIN_OFICIAL_DE_CANARIAS = 6;
	const BOLETIN_OFICIAL_DE_CANTABRIA = 7;
	const DIARIO_OFICIAL_DE_CASTILLA_LA_MANCHA = 8;
	const BOLETIN_OFICIAL_DE_CASTILLA_Y_LEON = 9;
	const DIARI_OFICIAL_DE_LA_GENERALITAT_DE_CATALUNYA = 10;
	const DIARIO_OFICIAL_DE_EXTREMADURA = 11;
	const DIARIO_OFICIAL_DE_GALICIA = 12;
	const BOLETIN_OFICIAL_DE_LA_RIOJA = 13;
	const BOLETIN_OFICIAL_DE_LA_COMUNIDAD_DE_MADRID = 14;
	const BOLETIN_OFICIAL_DE_LA_REGION_DE_MURCIA = 15;
	const BOLETIN_OFICIAL_DE_NAVARRA = 16;
	const BOLETIN_OFICIAL_DEL_PAIS_VASCO = 17;
	const DIARI_OFICIAL_DE_LA_COMUNITAT_VALENCIANA = 18;
	const BOLETIN_OFICIAL_DE_LA_CIUDAD_AUTONOMA_DE_CEUTA = 19;
    const BOLETIN_OFICIAL_DE_LA_CIUDAD_AUTONOMA_DE_MELILLA = 20;

    //Provincias
    const BOLETIN_OFICIAL_DE_LA_JUNTA_DE_ANDALUCIA = 21;
    const BOLETIN_A_CORUNA = 22;
    const BOLETIN_TERRITORIO_HISTORICO_DE_ALAVA = 23;
    const BOLETIN_ALBACETE = 24;
    const BOLETIN_ALICANTE = 25;
    const BOLETIN_ALMERIA = 26;
    const BOLETIN_AVILA = 27;
    const BOLETIN_BADAJOZ = 28;
    const BOLETIN_BARCELONA = 29;
    const BOLETIN_BURGOS = 30;
    const BOLETIN_CACERES = 31;
    const BOLETIN_CADIZ = 32;
    const BOLETIN_CASTELLON = 33;
    const BOLETIN_CIUDAD_REAL = 34;
    const BOLETIN_CORDOBA = 35;
    const BOLETIN_CUENCA = 36;
    const BOLETIN_GIRONA = 37;
    const BOLETIN_GRANADA = 38;
    const BOLETIN_GUADALAJARA = 39;
    const BOLETIN_GUIPUZKOA = 40;
    const BOLETIN_HUELVA = 41;
    const BOLETIN_HUESCA = 42;
    const BOLETIN_JAEN = 43;
    const BOLETIN_LAS_PALMAS = 44;
    const BOLETIN_LEON = 45;
    const BOLETIN_LLEIDA = 46;
    const BOLETIN_LUGO = 47;
    const BOLETIN_MALAGA = 48;
    const BOLETIN_OURENSE = 49;
    const BOLETIN_PALENCIA = 50;
    const BOLETIN_PONTEVEDRA = 51;
    const BOLETIN_SALAMANCA = 52;
    const BOLETIN_SANTA_CRUZ_DE_TENERIFE = 53;
    const BOLETIN_SEGOVIA = 54;
    const BOLETIN_SEVILLA = 55;
    const BOLETIN_SORIA = 56;
    const BOLETIN_TARRAGONA = 57;
    const BOLETIN_TERUEL = 58;
    const BOLETIN_TOLEDO = 59;
    const BOLETIN_VALENCIA = 60;
    const BOLETIN_VALLADOLID = 61;
    const BOLETIN_VIZCAYA = 62;
    const BOLETIN_ZAMORA = 63;
	const BOLETIN_ZARAGOZA = 64;

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


	public function updateIndexesFrom(int $from)
	{
		Log::debug("Updating all indexes from $from");

		$publications = Publication::where('id', '>=', $from)->get();
		foreach ($publications as $publication) {
			$scrapper = $this->scraperStrategyFactory->getScrapperStrategy($publication);

			if (!$scrapper) continue;

			if ($this->shouldRunScraper($publication)) {
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

		$oldCount = Chunk::count();
		$newCount = $oldCount;

		try {
			$requests = $scrapper->downloadFilesFromInternet();
			Log::debug("Found " . count($requests) . " urls with content.");

			$this->saveFiles($requests, $publication);

			$run->result = self::RUN_RESULT_OK;
			$newCount = Chunk::count();
			$publication->last_success_run_at = Carbon::now();
		} catch (ServerException $e) {
			Log::warning("Error updating {$regionName}: error de servidor en " . $e->getRequest()->getUri());
			$run->result = self::RUN_RESULT_ERROR;
		} catch (ClientException $e) {
			Log::warning("Error updating {$regionName}: error cliente al obtener la url " . $e->getRequest()->getUri() . " : " . $e->getMessage());
			$run->result = self::RUN_RESULT_ERROR;
		} catch (\ErrorException $e) {
		    if (config('app.debug')) {
		        throw $e;
            }
			Log::warning("Error updating {$regionName}: " . $e->getTraceAsString());
			$run->result = self::RUN_RESULT_ERROR;
		} catch (BadRequestException $e) {
			Log::warning("Error updating {$regionName}: error en la petición al obtener la url " . $e->url);
			$run->result = self::RUN_RESULT_ERROR;
		} catch (\PDOException $e) {
			Log::warning("Error updating {$regionName}: error al guardar el documento " . $e->getTraceAsString());
			$run->result = self::RUN_RESULT_ERROR;
		} catch (GuzzleException $e) {
			Log::warning("Error updating {$regionName}: error al obtener una url " . $e->getMessage());
			$run->result = self::RUN_RESULT_ERROR;
		}

		$microsecondsAfter = microtime(true);
		$run->duration = $microsecondsAfter - $microsecondsBefore;
		$new_chunks = $newCount - $oldCount;
		$run->new_files = $new_chunks;
		$run->save();

		Log::info("Finished {$regionName} with {$new_chunks} new chunks");

		$publication->last_run_result = $run->result;
		$publication->last_run_at = Carbon::now();
		$publication->save();

		HttpService::clearCache();
	}

	/**
	 * @param             $requests Request[]
	 * @param Publication $publication
	 *
	 * @throws GuzzleException
	 */
	private function saveFiles($requests, Publication $publication)
	{
		foreach ($requests as $request) {
			$this->parseFile($request, $publication);
		}
	}


	/**
	 * @param Request     $request
	 * @param Publication $publication
	 *
	 * @throws GuzzleException
	 */
	private function parseFile(Request $request, Publication $publication)
	{
		$storeStrategy = $this->storageStrategyFactory->getStorageStrategyForPublication($publication);

        $originUrl = $request->url;

		if ($storeStrategy->fileExists($originUrl)) {
		    Log::info("$originUrl already parsed");
            return;
        }

		try {
			$response = HttpService::get($request, false);
		} catch (GuzzleException $e) {
			Log::error("$originUrl returns http exception");
			return;
		}

		if (!$response) {
            Log::error("$originUrl returns nothing");
            return;
        }

		$content = $response->body();

		if (!$content || strlen($content) <= 10) return;

		$parseStrategy = $this->parseContentStrategyFactory->getParseContentStrategy($publication);

        $storeUrl = $storeStrategy->saveDocument($content, $originUrl);

        $publishedAt = $this->getFileDate($response);

        $pages = $parseStrategy->parseBodyContent($content, $storeUrl);

        foreach ($pages as $page) {
            $this->storePage($publication, $page, $publishedAt);
        }
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
		$chunk->publication_id = $publication->id;
		$chunk->publication_priority = $publication->priority;
		$chunk->published_at = $publishedAt;
		$chunk->content = $content;
		$chunk->save();
	}


	/**
	 * @param Publication $publication
	 *
	 * @return bool
	 */
	private function shouldRunScraper(Publication $publication): bool
	{
		return $this->scheduleService->isTodayAPublicationDay($publication);
	}

	/**
	 * @param Response $response
	 * @param bool $useLastModifiedHeader
	 *
	 * @return Carbon
	 */
	private function getFileDate($response, $useLastModifiedHeader = false): Carbon
	{
		if (!$useLastModifiedHeader) {
			return Carbon::now();
		}

		$lastModifiedHeader = $response->response->getHeader('Last-Modified');

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

    /**
     * @param Publication $publication
     * @param SearchablePage $page
     * @param $publishedAt
     */
    private function storePage(Publication $publication, SearchablePage $page, $publishedAt)
    {
        if (!$page->plainText || strlen($page->plainText) <= 10) return;

        $reducedText = $this->removeUselessCharacters($page->plainText);

        $this->storeText($page->pageUrl, $reducedText, $publication, $publishedAt);
    }


}
