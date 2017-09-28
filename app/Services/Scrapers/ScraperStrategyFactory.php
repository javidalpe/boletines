<?php


namespace App\Services\Scrapers;


use App\Services\Scrapers\Comunidades\AragonScraperStrategy;
use App\Services\Scrapers\Comunidades\CanariasScraperStrategy;
use App\Services\Scrapers\Comunidades\ExtremaduraScraperStrategy;
use App\Services\Scrapers\Comunidades\JuntaDeAndaluciaBoletinScraperStrategy;
use App\Services\Scrapers\Comunidades\MelillaScraperStrategy;
use App\Services\Scrapers\Comunidades\NavarraScraperStrategy;
use App\Services\Scrapers\Comunidades\PrincipadoDeAsturiasScraperStrategy;
use App\Services\Scrapers\Comunidades\RegionDeMurciaBoletinScraperStrategy;
use App\Services\ScrapingService;

class ScraperStrategyFactory
{

    public static function getScrapperStrategy($id)
    {
        switch ($id)
        {
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_JUNTA_DE_ANDALUCIA:
                return new JuntaDeAndaluciaBoletinScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_ARAGON:
                return new AragonScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DEL_PRINCIPADO_DE_ASTURIAS:
                return new PrincipadoDeAsturiasScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_ISLAS_BALEARES:
                return  null;
            case ScrapingService::BOLETIN_OFICIAL_DE_CANARIAS:
                return new CanariasScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_CANTABRIA:
                return null;
            case ScrapingService::DIARIO_OFICIAL_DE_CASTILLA_LA_MANCHA:
                return null;
            case ScrapingService::BOLETIN_OFICIAL_DE_CASTILLA_Y_LEON:
                return null;
            case ScrapingService::DIARI_OFICIAL_DE_LA_GENERALITAT_DE_CATALUNYA:
                return null;
            case ScrapingService::DIARIO_OFICIAL_DE_EXTREMADURA:
                return new ExtremaduraScraperStrategy();
            case ScrapingService::DIARIO_OFICIAL_DE_GALICIA:
                return null;
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_RIOJA:
                return null;
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_COMUNIDAD_DE_MADRID:
                return null;
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_REGION_DE_MURCIA:
                return new RegionDeMurciaBoletinScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DE_NAVARRA:
                return new NavarraScraperStrategy();
            case ScrapingService::BOLETIN_OFICIAL_DEL_PAIS_VASCO:
                return null;
            case ScrapingService::DIARI_OFICIAL_DE_LA_COMUNITAT_VALENCIANA:
                return null;
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_CIUDAD_AUTONOMA_DE_CEUTA:
                return null;
            case ScrapingService::BOLETIN_OFICIAL_DE_LA_CIUDAD_AUTONOMA_DE_MELILLA:
                return new MelillaScraperStrategy();
        }
    }
}