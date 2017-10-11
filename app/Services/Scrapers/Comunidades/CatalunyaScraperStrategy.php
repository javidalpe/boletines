<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CatalunyaScraperStrategy implements IBoletinScraperStrategy
{
	const DIRECTORY_FILES = "public/catalunya";

	public function downloadFilesFromInternet()
	{
		$links = FileDownloaderScraper::create("http://dogc.gencat.cat/es/index.html?newLang=es_ES&language=es_ES")
			->getLinks ("/http:\/\/portaldogc\.gencat\.cat\/utilsEADOP\/dogc\d*\/dogc_es\.pdf/");
		$linksWithDates = [];
		$dateString = (Carbon::now())->format('Ymd');
		foreach ($links as $link) {
			array_push($linksWithDates, sprintf('%s?d=%s', $link, $dateString));
		}
		return $linksWithDates;
	}

	public function getFiles()
	{
		return Storage::files(self::DIRECTORY_FILES);
	}
}