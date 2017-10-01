<?php


namespace App\Services\Scrapers\Estatal;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class BoeScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/boe";

	public function downloadFilesFromInternet()
	{
		FileDownloaderScraper::create("https://www.boe.es/diario_boe/ultimo.php")
			->forEachLink ("/\/boe\/dias\/\d+\/\d+\/\d+\/pdfs\/[^\.]+\.pdf/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'))
			->forEachLink ("/\/boe\/dias\/\d+\/\d+\/\d+\/index.php\?d=\d+&s=\d+/")
			->navigate()
			->forEachLink ("/\/boe\/dias\/\d+\/\d+\/\d+\/pdfs\/[^\.]+\.pdf/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}