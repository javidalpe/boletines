<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class ExtremaduraScraperStrategy implements IBoletinScraperStrategy
{

    const MAX_NUMBER_OF_PUBLICATIONS = 5;

	public function downloadFilesFromInternet()
    {
	    return FileDownloaderScraper::create("http://doe.gobex.es/busquedas/bus_calendario.php")
		    ->forEachLink ("/\/ultimosdoe\/mostrardoe\.php\?fecha=\d+/", self::MAX_NUMBER_OF_PUBLICATIONS)
		    ->navigate()
		    ->getLinks("/\/pdfs\/doe\/\d+\/\d+o\/\d+o\.pdf/");
    }

    public function hasEachDocumentUniqueUrl()
    {
	    return true;
    }
}