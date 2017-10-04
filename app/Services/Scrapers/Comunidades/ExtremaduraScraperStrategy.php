<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class ExtremaduraScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/extremadura";
    const MAX_NUMBER_OF_PUBLICATIONS = 5;

	public function downloadFilesFromInternet()
    {
	    FileDownloaderScraper::create("http://doe.gobex.es/busquedas/bus_calendario.php")
		    ->forEachLink ("/\/ultimosdoe\/mostrardoe\.php\?fecha=\d+/", self::MAX_NUMBER_OF_PUBLICATIONS)
		    ->navigate()
		    ->forEachLink("/\/pdfs\/doe\/\d+\/\d+o\/\d+o\.pdf/")
		    ->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
    }

    public function getFiles()
    {
	    return Storage::files(self::DIRECTORY_FILES);
    }
}