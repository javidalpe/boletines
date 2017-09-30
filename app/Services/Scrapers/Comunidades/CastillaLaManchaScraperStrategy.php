<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CastillaLaManchaScraperStrategy implements IBoletinScraperStrategy
{

	const DIRECTORY_FILES = "lamancha";

	public function downloadFilesFromInternet()
	{
		$now = Carbon::now();
		$fileName = sprintf("%s.pdf", $now->format("Y-m-d"));

		FileDownloaderScraper::create("http://docm.jccm.es/portaldocm/")
			->forEachLink ("/descargarArchivo\.do\?ruta=\d+\/\d+\/\d+\/pdf\/docm_\d+\.pdf&tipo=rutaDocm/")
			->download(storage_path('app/public/' . self::DIRECTORY_FILES. '/'), $fileName);
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}