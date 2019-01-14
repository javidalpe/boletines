<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class IslasBalearesScraperStrategy implements IBoletinScraperStrategy
{

    const MAX_NUMBER_OF_PUBLICATIONS = 5;

	public function downloadFilesFromInternet()
	{
		return HTMLScraper::create("http://www.caib.es/eboibfront/?lang=es")
			->forEachLink ("/\/eboibfront\/es\/\d+\/\d+/", self::MAX_NUMBER_OF_PUBLICATIONS)
			->navigate()
			->getLinks("/\/eboibfront\/pdf\/VisPdf\?action=VisEdicte&idDocument=\w+&lang=es/");
	}


}