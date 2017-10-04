<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CantabriaScraperStrategy implements IBoletinScraperStrategy
{

	const DIRECTORY_FILES = "public/cantabria";

	public function downloadFilesFromInternet()
	{
		FileDownloaderScraper::create("https://boc.cantabria.es/boces/boletines.do?boton=UltimoBOCPublicado")
			->forEachLink ("/verPdfAction\.do\?idBlob=\d+&tipoPdf=0/")
			->download(storage_path('app/' . self::DIRECTORY_FILES. '/'));
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}