<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class LaRiojaScraperStrategy implements IBoletinScraperStrategy
{


	public function downloadFilesFromInternet()
	{
		return HTMLScraper::create("http://www.larioja.org/bor/es")
			->getLinks ("/http:\/\/ias1\.larioja\.org\/boletin\/Bor_Boletin_visor_Servlet\?referencia=[^\"]+/");
	}


}