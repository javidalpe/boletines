<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class LaRiojaScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "larioja";

	public function downloadFilesFromInternet()
	{
		$now = Carbon::now();
		$fileName = sprintf("%s.pdf", $now->format("Y-m-d"));

		FileDownloaderScraper::create("http://www.larioja.org/bor/es")
			->forEachLink ("/http:\/\/ias1\.larioja\.org\/boletin\/Bor_Boletin_visor_Servlet\?referencia=[^\"]+/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'), $fileName);
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}