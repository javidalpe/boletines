<?php


namespace App\Services\Scrapers\Comunidades;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RegionDeMurciaBoletinScraperStrategy implements IBoletinScraperStrategy
{
    public function downloadFilesFromInternet()
    {
	    $date = Carbon::now()->format('d-m-Y');
        return HTMLScraper::create("https://www.borm.es/services/boletin/fecha/$date/sumario")
	        ->getLinksFromJson(function($json) {
		        return array_map(function ($j) {
		        	///services/anuncio/ano/2019/numero/1861/pdf?id=775837
			        $id = $j['id'];
			        $number = $j['numero'];
			        $year = $j['ano'];
			        return "/services/anuncio/ano/$year/numero/$number/pdf?id=$id";
		        }, $json['anunciosBoletin']);
	        });
    }
}
