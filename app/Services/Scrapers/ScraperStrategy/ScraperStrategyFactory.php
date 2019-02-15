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
use App\Services\Scrapers\Europeo\ACorunaScraperStrategy;
use App\Services\Scrapers\Europeo\AlavaScraperStrategy;
use App\Services\Scrapers\Europeo\AlbaceteScraperStrategy;
use App\Services\Scrapers\Europeo\AlicanteScraperStrategy;
use App\Services\Scrapers\Europeo\AlmeriaScraperStrategy;
use App\Services\Scrapers\Europeo\AvilaScraperStrategy;
use App\Services\Scrapers\Europeo\BadajozScraperStrategy;
use App\Services\Scrapers\Europeo\BarcelonaScraperStrategy;
use App\Services\Scrapers\Europeo\BurgosScraperStrategy;
use App\Services\Scrapers\Europeo\CaceresScraperStrategy;
use App\Services\Scrapers\Europeo\CadizScraperStrategy;
use App\Services\Scrapers\Europeo\CastellonScraperStrategy;
use App\Services\Scrapers\Europeo\CiudadRealScraperStrategy;
use App\Services\Scrapers\Europeo\CordobaScraperStrategy;
use App\Services\Scrapers\Europeo\CuencaScraperStrategy;
use App\Services\Scrapers\Europeo\EurLexScraperStrategy;
use App\Services\Scrapers\Europeo\GipuzkoaScraperStrategy;
use App\Services\Scrapers\Europeo\GironaScraperStrategy;
use App\Services\Scrapers\Europeo\GranadaScraperStrategy;
use App\Services\Scrapers\Europeo\GuadalajaraScraperStrategy;
use App\Services\Scrapers\Europeo\HuelvaScraperStrategy;
use App\Services\Scrapers\Europeo\HuescaScraperStrategy;
use App\Services\Scrapers\Europeo\JaenScraperStrategy;
use App\Services\Scrapers\Europeo\LasPalmasScraperStrategy;
use App\Services\Scrapers\Europeo\LeonScraperStrategy;
use App\Services\Scrapers\Europeo\LleidaScraperStrategy;
use App\Services\Scrapers\Europeo\LugoScraperStrategy;
use App\Services\Scrapers\Europeo\MalagaScraperStrategy;
use App\Services\Scrapers\Europeo\OurenseScraperStrategy;
use App\Services\Scrapers\Europeo\PalenciaScraperStrategy;
use App\Services\Scrapers\Europeo\PontevedraScraperStrategy;
use App\Services\Scrapers\Europeo\SalamancaScraperStrategy;
use App\Services\Scrapers\Europeo\SantaCruzDeTenerifeScraperStrategy;
use App\Services\Scrapers\Europeo\SegoviaScraperStrategy;
use App\Services\Scrapers\Europeo\SevillaScraperStrategy;
use App\Services\Scrapers\Europeo\SoriaScraperStrategy;
use App\Services\Scrapers\Europeo\TarragonaScraperStrategy;
use App\Services\Scrapers\Europeo\TeruelScraperStrategy;
use App\Services\Scrapers\Europeo\ToledoScraperStrategy;
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
            case ScrapingService::BOLETIN_A_CORUNA:
                return new ACorunaScraperStrategy();
            case ScrapingService::BOLETIN_TERRITORIO_HISTORICO_DE_ALAVA:
                return new AlavaScraperStrategy();
            case ScrapingService::BOLETIN_ALBACETE:
                return new AlbaceteScraperStrategy();
            case ScrapingService::BOLETIN_ALICANTE:
                return new AlicanteScraperStrategy();
            case ScrapingService::BOLETIN_ALMERIA:
                return new AlmeriaScraperStrategy();
            case ScrapingService::BOLETIN_AVILA:
                return new AvilaScraperStrategy();
	        case ScrapingService::BOLETIN_BADAJOZ:
	        	return new BadajozScraperStrategy();
	        case ScrapingService::BOLETIN_BARCELONA:
	        	return new BarcelonaScraperStrategy();
	        case ScrapingService::BOLETIN_BURGOS:
	        	return new BurgosScraperStrategy();
	        case ScrapingService::BOLETIN_CACERES:
	        	return new CaceresScraperStrategy();
	        case ScrapingService::BOLETIN_CADIZ:
	        	return new CadizScraperStrategy();
	        case ScrapingService::BOLETIN_CASTELLON:
	        	return new CastellonScraperStrategy();
	        case ScrapingService::BOLETIN_CIUDAD_REAL:
	        	return new CiudadRealScraperStrategy();
	        case ScrapingService::BOLETIN_CORDOBA:
	        	return new CordobaScraperStrategy();
	        case ScrapingService::BOLETIN_CUENCA:
	        	return new CuencaScraperStrategy();
	        case ScrapingService::BOLETIN_GIRONA:
	        	return new GironaScraperStrategy();
	        case ScrapingService::BOLETIN_GRANADA:
	        	return new GranadaScraperStrategy();
            case ScrapingService::BOLETIN_GUADALAJARA:
                return new GuadalajaraScraperStrategy();
            case ScrapingService::BOLETIN_GUIPUZKOA:
                return new GipuzkoaScraperStrategy();
            case ScrapingService::BOLETIN_HUELVA:
                return new HuelvaScraperStrategy();
            case ScrapingService::BOLETIN_HUESCA:
                return new HuescaScraperStrategy();
            case ScrapingService::BOLETIN_JAEN:
                return new JaenScraperStrategy();
            case ScrapingService::BOLETIN_LAS_PALMAS:
                return new LasPalmasScraperStrategy();
            case ScrapingService::BOLETIN_LEON:
                return new LeonScraperStrategy();
            case ScrapingService::BOLETIN_LLEIDA:
                return new LleidaScraperStrategy();
            case ScrapingService::BOLETIN_LUGO:
                return new LugoScraperStrategy();
            case ScrapingService::BOLETIN_MALAGA:
                return new MalagaScraperStrategy();
	        case ScrapingService::BOLETIN_OURENSE:
	        	return new OurenseScraperStrategy();
	        case ScrapingService::BOLETIN_PALENCIA:
	        	return new PalenciaScraperStrategy();
	        case ScrapingService::BOLETIN_PONTEVEDRA:
	        	return new PontevedraScraperStrategy();
	        case ScrapingService::BOLETIN_SALAMANCA:
	        	return new SalamancaScraperStrategy();
	        case ScrapingService::BOLETIN_SANTA_CRUZ_DE_TENERIFE:
	        	return new SantaCruzDeTenerifeScraperStrategy();
	        case ScrapingService::BOLETIN_SEGOVIA:
	        	return new SegoviaScraperStrategy();
	        case ScrapingService::BOLETIN_SEVILLA:
	        	return new SevillaScraperStrategy();
	        case ScrapingService::BOLETIN_SORIA:
	        	return new SoriaScraperStrategy();
	        case ScrapingService::BOLETIN_TARRAGONA:
	        	return new TarragonaScraperStrategy();
	        case ScrapingService::BOLETIN_TERUEL:
	        	return new TeruelScraperStrategy();
	        case ScrapingService::BOLETIN_TOLEDO:
	        	return new ToledoScraperStrategy();
	        default:
	        	return null;
        }
    }
}
