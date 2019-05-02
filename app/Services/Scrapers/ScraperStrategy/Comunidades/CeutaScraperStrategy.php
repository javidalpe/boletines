<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CeutaScraperStrategy implements IBoletinScraperStrategy
{

    const MAX_NUMBER_OF_PUBLICATIONS = 5;

	public function downloadFilesFromInternet()
	{
		return HTMLScraper::create("http://www.ceuta.es/ceuta/documentos/")
			->forEachLink ("/\/ceuta\/component\/jdownloads\/viewdownload\/\d+\/\d+/", self::MAX_NUMBER_OF_PUBLICATIONS, false)
			->navigate()
			->getLinks("/\/ceuta\/component\/jdownloads\/finish\/\d+-\w+\/[^\"]+/");
	}


}
