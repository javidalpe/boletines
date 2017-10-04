<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class PaisVascoScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/paisvasco";
    const MAX_NUMBER_OF_PUBLICATIONS = 5;

	public function downloadFilesFromInternet()
	{
		FileDownloaderScraper::create("https://www.euskadi.eus/r48-bopv2/es/bopv2/datos/Ultimo.shtml")
			->forEachLink ("/\d+\/\d+\/\w+\.shtml/", self::MAX_NUMBER_OF_PUBLICATIONS)
			->navigate()
			->forEachLink("/\w+\.pdf/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}