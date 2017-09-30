<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CeutaScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "ceuta";

	public function downloadFilesFromInternet()
	{
		$now = Carbon::now();
		$fileName = sprintf("%s.pdf", $now->format("Y-m-d"));
		FileDownloaderScraper::create("http://www.ceuta.es/ceuta/documentos/")
			->forEachLink ("/\/ceuta\/component\/jdownloads\/viewdownload\/\d+\/\d+/")
			->navigate()
			->forEachLink("/\/ceuta\/component\/jdownloads\/finish\/\d+-\w+\/[^\"]+/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'), $fileName);
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}