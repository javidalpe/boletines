<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CeutaScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/ceuta";
    const MAX_NUMBER_OF_PUBLICATIONS = 5;

	public function downloadFilesFromInternet()
	{
		FileDownloaderScraper::create("http://www.ceuta.es/ceuta/documentos/")
			->forEachLink ("/\/ceuta\/component\/jdownloads\/viewdownload\/\d+\/\d+/", self::MAX_NUMBER_OF_PUBLICATIONS)
			->navigate()
			->forEachLink("/\/ceuta\/component\/jdownloads\/finish\/\d+-\w+\/[^\"]+/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}