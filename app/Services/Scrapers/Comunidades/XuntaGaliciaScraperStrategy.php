<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class XuntaGaliciaScraperStrategy implements IBoletinScraperStrategy
{

    const MAX_NUMBER_OF_PUBLICATIONS = 5;

	public function downloadFilesFromInternet()
	{
		return FileDownloaderScraper::create("http://www.xunta.es/doga/index.htm?lang=es")
			->forEachLink ("/mostrarContenido\.do\?paginaCompleta=false&idEstado=\d+&rutaRelativa=true&ruta=\/\d+\/\d+\/Secciones\w+\.html/", self::MAX_NUMBER_OF_PUBLICATIONS)
			->navigate()
			->getLinks("/\/dog\/Publicados\/\d+\/\d+\/\w+-\w+-\w+\.pdf/");
	}

	public function hasEachDocumentUniqueUrl()
	{
		return true;
	}
}