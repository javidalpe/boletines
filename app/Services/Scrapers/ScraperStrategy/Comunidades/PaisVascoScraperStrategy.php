<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class PaisVascoScraperStrategy implements IBoletinScraperStrategy
{

    const MAX_NUMBER_OF_PUBLICATIONS = 5;

	public function downloadFilesFromInternet()
	{
		return FileDownloaderScraper::create("https://www.euskadi.eus/r48-bopv2/es/bopv2/datos/Ultimo.shtml")
			->forEachLink ("/\d+\/\d+\/\w+\.shtml/")
			->navigate()
			->getLinks("/\w+\.pdf/");
	}


}