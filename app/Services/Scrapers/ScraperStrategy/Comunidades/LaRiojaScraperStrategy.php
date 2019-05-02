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
		/*$url = 'https://iqadi.larioja.org/apps/ckan-client/public/bor/getBors';
		$now = Carbon::now();
		$response = HttpService::post($url, [
			'form_params' => [
				'getDetalleBOR' => true,
				'date' => $now->format('D M d Y H:i:s e')
			]
		]);
		$body = $response->getBody()->getContents();
		$parsed = json_decode($body, true);
		$html = $parsed['data']['bor'];
		$cleanHtml = str_replace("\n", "", $html);

		JSONScraper*/

		$now = Carbon::now();
		return HTMLScraper::create("https://iqadi.larioja.org/apps/ckan-client/public/bor/getBors", 'POST', [
			'form_params' => [
				'getDetalleBOR' => true,
				'date' => $now->format('D M d Y H:i:s e')
			]
		])->getContentFromJson(function($json) {
			$bor = $json['data']['bor'];
			return str_replace("\n", "", $bor);
		})->getLinks ("/http:\/\/ias1\.larioja\.org\/boletin\/Bor_Boletin_visor_Servlet\?referencia=[^\"]+/");
	}


}
