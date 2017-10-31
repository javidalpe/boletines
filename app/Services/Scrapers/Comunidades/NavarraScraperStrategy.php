<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class NavarraScraperStrategy implements IBoletinScraperStrategy
{


	public function downloadFilesFromInternet()
	{
		return FileDownloaderScraper::create("http://www.navarra.es/home_es/Actualidad/BON/")
			->getLinks ("/\/home_es\/Actualidad\/BON\/Boletines\/\d+\/\d+\/boletin.pdf/");
	}

	public function hasEachDocumentUniqueUrl()
	{
		return true;
	}
}