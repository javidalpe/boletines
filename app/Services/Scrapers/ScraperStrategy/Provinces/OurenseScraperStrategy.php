<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class OurenseScraperStrategy implements IBoletinScraperStrategy
{

	public function downloadFilesFromInternet()
	{
		return HTMLScraper::create("https://bop.depourense.es/portal/")
			->getLinks("/descargarPdf\.do\?numBoletin\=\d+&fecha\=\d+/");
	}
}
