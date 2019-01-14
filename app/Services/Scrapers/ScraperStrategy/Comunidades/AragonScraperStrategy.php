<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\HttpService;
use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\ScrapingService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AragonScraperStrategy implements IBoletinScraperStrategy
{


	public function downloadFilesFromInternet()
	{
		$now = Carbon::now();
		$initialUrl = sprintf("http://www.boa.aragon.es/cgi-bin/EBOA/BRSCGI?CMD=VERLST&SEC=ULTBOL&DOCS=1-1&BASE=BCOM&SEPARADOR&TBOL-C=BOLE&@PUBL-E=%s", $now->format("Ymd"));

		return HTMLScraper::create($initialUrl)
			->getLinks("/BRSCGI\?CMD=VEROBJ&MLKOB=\w+/");
	}


}