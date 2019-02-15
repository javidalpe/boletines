<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\Http\HttpService;
use App\Services\Scrapers\IBoletinScraperStrategy;

class SegoviaScraperStrategy implements IBoletinScraperStrategy
{

	public function downloadFilesFromInternet()
	{
		return HTMLScraper::create("https://www.dipsegovia.es/bop", 'GET', [
			'headers' => HttpService::CHROME_HEADERS
		])
			->getLinks("/\/documents\/\d+\/\w+\-\w+\-\w+\-\w+\-\w+/", null, PHP_INT_MAX, [
				'headers' => HttpService::CHROME_HEADERS
			]);
	}
}
