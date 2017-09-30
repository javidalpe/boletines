<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CastillaYLeonScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "castillayleon";

	public function downloadFilesFromInternet()
	{
		FileDownloaderScraper::create("http://bocyl.jcyl.es/")
			->forEachLink("/boletin\.do\?fechaBoletin=\d+\/\d+\/\d+/")
			->navigate()
			->forEachLink("/http:\/\/bocyl\.jcyl\.es\/boletines\/\d+\/\d+\/\d+\/pdf\/BOCYL\-D\-\d+-\d+\.pdf/")
			->download(storage_path('app/public/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}