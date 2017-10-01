<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\ScrapingService;
use Carbon\Carbon;
use Storage;

class CanariasScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/canarias";

	public function downloadFilesFromInternet()
	{
		FileDownloaderScraper::create("http://www.gobiernodecanarias.org/boc/")
			->forEachLink ("/\/boc\/\d+\/\d+\//")
			->navigate()
			->forEachLink ("/http:\/\/sede\.gobcan\.es\/boc\/boc-a-\d+-\w+-\w+\.pdf/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}