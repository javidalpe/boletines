<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\Http\HttpService;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Storage;

class LaRiojaScraperStrategy implements IBoletinScraperStrategy
{


	public function downloadFilesFromInternet()
	{
		$now = Carbon::now();
		return HTMLScraper::create("https://web.larioja.org/apps/ckan-client/public/bor/getBors", 'POST', [
			'form_params' => [
				'getDetalleBOR' => true,
				'date' => $now->format('D M d Y H:i:s e')
			]
		])->getContentFromJson(function($json) {
			$bor = $json['data']['bor'];
			return preg_replace( "/\r|\n/", "", $bor );
		})->getLinks("/http\:\/\/ias1\.larioja\.org\/boletin\/Bor_Boletin_visor_Servlet\?referencia\=[0-9\-]+PDF+[^\"]+/");
	}


}
