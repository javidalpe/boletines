<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class IslasBalearesScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "baleares";

	public function downloadFilesFromInternet()
	{
		$now = Carbon::now();
		$fileName = sprintf("%s.pdf", $now->format("Y-m-d"));

		FileDownloaderScraper::create("http://www.caib.es/eboibfront/?lang=es")
			->forEachLink ("/\/eboibfront\/es\/\d+\/\d+/")
			->navigate()
			->forEachLink("/\/eboibfront\/pdf\/VisPdf\?action=VisEdicte&idDocument=\w+&lang=es/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'), $fileName);
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}