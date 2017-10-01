<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Storage;

class ComunidadDeMadridScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/cmadrid";

	public function downloadFilesFromInternet()
	{
		FileDownloaderScraper::create("http://www.bocm.es/bocm/Satellite?language=es&pagename=Boletin/Page/BOCM_home")
			->forEachLink ("/\/boletin\/CM_Boletin_BOCM\/\d+\/\d+\/\d+\/\d+.PDF/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}