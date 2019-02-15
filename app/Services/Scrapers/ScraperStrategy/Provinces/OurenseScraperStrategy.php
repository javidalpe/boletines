<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\Http\HttpService;
use App\Services\Scrapers\IBoletinScraperStrategy;

class OurenseScraperStrategy implements IBoletinScraperStrategy
{

	public function downloadFilesFromInternet()
	{
		return HTMLScraper::create("https://bop.depourense.es/portal/", 'GET', [
			'headers' => HttpService::CHROME_HEADERS
		])
			->getLinks("/descargarPdf\.do\?numBoletin\=\d+&fecha\=\d+/", null, PHP_INT_MAX, [
				'headers' => HttpService::CHROME_HEADERS
			]);
	}
}
