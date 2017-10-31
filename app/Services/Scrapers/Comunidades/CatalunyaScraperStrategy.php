<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CatalunyaScraperStrategy implements IBoletinScraperStrategy
{


	public function downloadFilesFromInternet()
	{
		$links = FileDownloaderScraper::create("http://dogc.gencat.cat/es/index.html?newLang=es_ES&language=es_ES")
			->getLinks ("/http:\/\/portaldogc\.gencat\.cat\/utilsEADOP\/dogc\d*\/dogc_es\.pdf/");
		return $links;
	}

    public function hasEachDocumentUniqueUrl()
    {
        return false;
    }
}