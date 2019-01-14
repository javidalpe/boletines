<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\ScrapingService;
use Carbon\Carbon;
use Storage;

class CanariasScraperStrategy implements IBoletinScraperStrategy
{


    const MAX_NUMBER_OF_PUBLICATIONS = 5;

    public function downloadFilesFromInternet()
	{
		return HTMLScraper::create("http://www.gobiernodecanarias.org/boc/")
			->forEachLink ("/\/boc\/\d+\/\d+\//", self::MAX_NUMBER_OF_PUBLICATIONS)
			->navigate()
			->getLinks ("/http:\/\/sede\.gobcan\.es\/boc\/boc-a-\d+-\w+-\w+\.pdf/");
	}


}