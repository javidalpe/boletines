<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class IslasBalearesScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/baleares";
    const MAX_NUMBER_OF_PUBLICATIONS = 5;

	public function downloadFilesFromInternet()
	{
		FileDownloaderScraper::create("http://www.caib.es/eboibfront/?lang=es")
			->forEachLink ("/\/eboibfront\/es\/\d+\/\d+/", self::MAX_NUMBER_OF_PUBLICATIONS)
			->navigate()
			->forEachLink("/\/eboibfront\/pdf\/VisPdf\?action=VisEdicte&idDocument=\w+&lang=es/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}