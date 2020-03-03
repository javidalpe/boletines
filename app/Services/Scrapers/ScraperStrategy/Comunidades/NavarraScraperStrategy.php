<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class NavarraScraperStrategy implements IBoletinScraperStrategy
{


	public function downloadFilesFromInternet()
	{
		return HTMLScraper::create("https://bon.navarra.es/es/inicio")
			->getLinks ("/https\:\/\/bon\.navarra\.es\/es\/inicio\?p_p_id\=es_navarra_bon_detalle_portlet_boletin_DetalleBoletinPortlet&p_p_lifecycle\=\d+&p_p_state\=normal&p_p_mode\=view&p_p_resource_id\=descargarArchivo&p_p_cacheability\=cacheLevelPage&_es_navarra_bon_detalle_portlet_boletin_DetalleBoletinPortlet_numero\=\d+&_es_navarra_bon_detalle_portlet_boletin_DetalleBoletinPortlet_idioma\=es_ES&_es_navarra_bon_detalle_portlet_boletin_DetalleBoletinPortlet_anyo\=\d+/");
	}


}
