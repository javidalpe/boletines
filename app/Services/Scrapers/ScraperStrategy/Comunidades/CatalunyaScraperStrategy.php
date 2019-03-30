<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class CatalunyaScraperStrategy implements IBoletinScraperStrategy
{


	public function downloadFilesFromInternet()
	{
		$links = HTMLScraper::create("http://dogc.gencat.cat/es/index.html?newLang=es_ES&language=es_ES")
			->getLinks ("/https\:\/\/portaldogc\.gencat\.cat\/utilsEADOP\/dogc\d+\/dogc_es\.pdf/");
		return $links;
	}

}
