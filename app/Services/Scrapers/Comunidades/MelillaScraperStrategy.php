<?php


namespace App\Services\Scrapers\Comunidades;

use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class MelillaScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "melilla";

	public function downloadFilesFromInternet()
	{
		FileDownloaderScraper::create("http://www.melilla.es/melillaportal/contenedor.jsp?seccion=bome.jsp&language=es&codResi=1&layout=contenedor.jsp&codAdirecto=15")
			->forEachLink ("/contenedor\.jsp\?seccion=ficha_bome\.jsp&dboidboletin=23\d+/")
			->navigate()
			->forEachLink("/http:\/\/www\.melilla\.es\/mandar\.php\/\w+\/\d+\/\d+\/\w+\.pdf/")
			->download(storage_path('app/public/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}