<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class BadajozScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://www.dip-badajoz.es/bop", "GET", [
        	"headers" => [
		        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
		        'Accept-Encoding' => 'gzip, deflate, br',
	        ]
        ])
            ->getLinks("/ventana_anuncio\.php\?id_anuncio\=\d+&FechaSolicitada\=\d+\-\d+\-\d+/");
    }
}
