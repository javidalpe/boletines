<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class ComunidadValencianaScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "cmadrid";

	public function downloadFilesFromInternet()
	{
		$now = Carbon::now();
		$initialUrl = sprintf("http://www.dogv.gva.es/datos/%s/PortalCAS.html", $now->format("Y/m/d"));

		FileDownloaderScraper::create($initialUrl)
			->forEachLink ("/pdf\/docv_\d+\.pdf/")
			->download(storage_path('app/public/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}