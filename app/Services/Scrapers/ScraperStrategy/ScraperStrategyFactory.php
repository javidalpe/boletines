<?php


namespace App\Services\Scrapers;


use App\Publication;
use App\Services\Scrapers\Comunidades\AragonScraperStrategy;
use App\Services\Scrapers\Comunidades\CanariasScraperStrategy;
use App\Services\Scrapers\Comunidades\CantabriaScraperStrategy;
use App\Services\Scrapers\Comunidades\CastillaLaManchaScraperStrategy;
use App\Services\Scrapers\Comunidades\CastillaYLeonScraperStrategy;
use App\Services\Scrapers\Comunidades\CatalunyaScraperStrategy;
use App\Services\Scrapers\Comunidades\CeutaScraperStrategy;
use App\Services\Scrapers\Comunidades\ComunidadDeMadridScraperStrategy;
use App\Services\Scrapers\Comunidades\ComunidadValencianaScraperStrategy;
use App\Services\Scrapers\Comunidades\ExtremaduraScraperStrategy;
use App\Services\Scrapers\Comunidades\IslasBalearesScraperStrategy;
use App\Services\Scrapers\Comunidades\JuntaDeAndaluciaBoletinScraperStrategy;
use App\Services\Scrapers\Comunidades\LaRiojaScraperStrategy;
use App\Services\Scrapers\Comunidades\MelillaScraperStrategy;
use App\Services\Scrapers\Comunidades\NavarraScraperStrategy;
use App\Services\Scrapers\Comunidades\PaisVascoScraperStrategy;
use App\Services\Scrapers\Comunidades\PrincipadoDeAsturiasScraperStrategy;
use App\Services\Scrapers\Comunidades\RegionDeMurciaBoletinScraperStrategy;
use App\Services\Scrapers\Comunidades\XuntaGaliciaScraperStrategy;
use App\Services\Scrapers\Estatal\BoeScraperStrategy;
use App\Services\Scrapers\Europeo\EurLexScraperStrategy;
use App\Services\ScrapingService;
use Exception;

class ScraperStrategyFactory
{

	/**
	 * @param Publication $publication
	 *
	 * @return IBoletinScraperStrategy|null
	 */
    public function getScrapperStrategy(Publication $publication) : ?IBoletinScraperStrategy
    {
        switch ($publication->id)
        {
	        case ScrapingService::BOLETIN_OFICIAL_DEL_ESTADO:
	        	return new BoeScraperStrategy();
            case ScrapingService::DIARIO_OFICIAL_DE_LA_UNION_EUROPEA:
                return new EurLexScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_JUNTA_DE_ANDALUCIA:
                return new JuntaDeAndaluciaBoletinScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_ARAGON:
                return new AragonScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DEL_PRINCIPADO_DE_ASTURIAS:
                return new PrincipadoDeAsturiasScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_ISLAS_BALEARES:
                return new IslasBalearesScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_CANARIAS:
                return new CanariasScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_CANTABRIA:
                return new CantabriaScraperStrategy();
            case ScrapingService::DIARIO_OFICIAL_DE_CASTILLA_LA_MANCHA:
                return new CastillaLaManchaScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_CASTILLA_Y_LEON:
                return new CastillaYLeonScraperStrategy();
            case ScrapingService::DIARI_OFICIAL_DE_LA_GENERALITAT_DE_CATALUNYA:
                return new CatalunyaScraperStrategy();
            case ScrapingService::DIARIO_OFICIAL_DE_EXTREMADURA:
                return new ExtremaduraScraperStrategy();
            case ScrapingService::DIARIO_OFICIAL_DE_GALICIA:
                return new XuntaGaliciaScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_RIOJA:
                return new LaRiojaScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_COMUNIDAD_DE_MADRID:
                return new ComunidadDeMadridScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_REGION_DE_MURCIA:
                return new RegionDeMurciaBoletinScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_NAVARRA:
                return new NavarraScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DEL_PAIS_VASCO:
                return new PaisVascoScraperStrategy();
            case ScrapingService::DIARI_OFICIAL_DE_LA_COMUNITAT_VALENCIANA:
                return new ComunidadValencianaScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_CIUDAD_AUTONOMA_DE_CEUTA:
                return new CeutaScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_CIUDAD_AUTONOMA_DE_MELILLA:
                return new MelillaScraperStrategy();
	        default:
	        	return null;
        }
    }
}