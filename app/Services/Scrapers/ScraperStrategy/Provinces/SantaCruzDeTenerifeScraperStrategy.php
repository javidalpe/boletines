<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class SantaCruzDeTenerifeScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://www.bopsantacruzdetenerife.org/")
	        ->forEachLink('/\/\d+\/\d+\/\d+\//', PHP_INT_MAX, true, function($link) {
	        	return $link . "descargar/";
	        })
	        ->navigate()
            ->getLinks("/\/descargar\/\d+\/\d+\/\d+\/Bop\d+\-\d+\.pdf/");
    }
}
