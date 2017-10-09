<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CastillaLaManchaScraperStrategy implements IBoletinScraperStrategy
{

	const DIRECTORY_FILES = "public/lamancha";

	public function downloadFilesFromInternet()
	{
        return FileDownloaderScraper::create("http://docm.jccm.es/portaldocm/")
			->getLinks ("/descargarArchivo\.do\?ruta=\d+\/\d+\/\d+\/pdf\/docm_\d+\.pdf&tipo=rutaDocm/");
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}