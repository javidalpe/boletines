<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
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

        try {
            return FileDownloaderScraper::create($initialUrl)
                ->getLinks("/pdf\/docv_\d+\.pdf/");
        } catch (BadResponseException $e) { //No publication returns 404
            return [];
        }
	}

	public function hasEachDocumentUniqueUrl()
	{
		return true;
	}
}