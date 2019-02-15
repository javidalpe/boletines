<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class SegoviaScraperStrategy implements IBoletinScraperStrategy
{

	public function downloadFilesFromInternet()
	{
		return HTMLScraper::create("https://www.dipsegovia.es/bop")
			->getLinks("/\/documents\/\d+\/\w+\-\w+\-\w+\-\w+\-\w+/");
	}
}
