<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class NavarraScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/navarra";

	public function downloadFilesFromInternet()
	{
		FileDownloaderScraper::create("http://www.navarra.es/home_es/Actualidad/BON/")
			->forEachLink ("/\/home_es\/Actualidad\/BON\/Boletines\/\d+\/\d+\/boletin.pdf/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}