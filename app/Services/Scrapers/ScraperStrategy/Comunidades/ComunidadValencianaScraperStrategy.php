<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use GuzzleHttp\Exception\BadResponseException;
use Storage;

class ComunidadValencianaScraperStrategy implements IBoletinScraperStrategy
{


	public function downloadFilesFromInternet()
	{
		$now = Carbon::now();
		$initialUrl = sprintf("http://www.dogv.gva.es/datos/%s/PortalCAS.html", $now->format("Y/m/d"));

        return HTMLScraper::create($initialUrl)
            ->getLinks("/pdf\/docv_\d+\.pdf/");
	}


}
