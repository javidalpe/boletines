<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CatalunyaScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "catalunya";

	public function downloadFilesFromInternet()
	{
		$now = Carbon::now();
		$fileName = sprintf("%s.pdf", $now->format("Y-m-d"));

		FileDownloaderScraper::create("http://dogc.gencat.cat/es/index.html?newLang=es_ES&language=es_ES")
			->forEachLink ("/http:\/\/portaldogc\.gencat\.cat\/utilsEADOP\/dogc\d*\/dogc_es\.pdf/")
			->download(storage_path('app/public/' . self::DIRECTORY_FILES. '/'), $fileName);
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}