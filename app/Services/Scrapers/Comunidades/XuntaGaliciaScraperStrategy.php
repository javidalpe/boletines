<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class XuntaGaliciaScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/galicia";
    const MAX_NUMBER_OF_PUBLICATIONS = 5;

	public function downloadFilesFromInternet()
	{
		FileDownloaderScraper::create("http://www.xunta.es/doga/index.htm")
			->forEachLink ("/mostrarContenido\.do\?paginaCompleta=false&idEstado=\d+&rutaRelativa=true&ruta=\/\d+\/\d+\/Secciones\w+\.html/", self::MAX_NUMBER_OF_PUBLICATIONS)
			->navigate()
			->forEachLink("/\/dog\/Publicados\/\d+\/\d+\/\w+-\w+-\w+\.pdf/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}