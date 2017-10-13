<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use GuzzleHttp\Exception\BadResponseException;
use Storage;

class ComunidadValencianaScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/cmadrid";

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

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}