<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CantabriaScraperStrategy implements IBoletinScraperStrategy
{

	const DIRECTORY_FILES = "cantabria";

	public function downloadFilesFromInternet()
	{
		$now = Carbon::now();
		$fileName = sprintf("%s.pdf", $now->format("Y-m-d"));

		FileDownloaderScraper::create("https://boc.cantabria.es/boces/boletines.do?boton=UltimoBOCPublicado")
			->forEachLink ("/verPdfAction\.do\?idBlob=\d+&tipoPdf=0/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'), $fileName);
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}