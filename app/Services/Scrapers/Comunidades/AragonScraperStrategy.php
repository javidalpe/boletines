<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\HttpService;
use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\ScrapingService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AragonScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/aragon";

	public function downloadFilesFromInternet()
	{
		$now = Carbon::now();
		$initialUrl = sprintf("http://www.boa.aragon.es/cgi-bin/EBOA/BRSCGI?CMD=VERLST&SEC=ULTBOL&DOCS=1-1&BASE=BCOM&SEPARADOR&TBOL-C=BOLE&@PUBL-E=%s", $now->format("Ymd"));
		$fileName = sprintf("%s.pdf", $now->format("Y-m-d"));

		FileDownloaderScraper::create($initialUrl)
			->forEachLink ("/BRSCGI\?CMD=VEROBJ&MLKOB=\w+/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'), $fileName);
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}