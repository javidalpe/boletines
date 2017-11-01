<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CantabriaScraperStrategy implements IBoletinScraperStrategy
{



	public function downloadFilesFromInternet()
	{
		return FileDownloaderScraper::create("https://boc.cantabria.es/boces/boletines.do?boton=UltimoBOCPublicado")
			->getLinks ("/verPdfAction\.do\?idBlob=\d+&tipoPdf=0/");
	}


}