<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\Http\HttpService;
use App\Services\Scrapers\IBoletinScraperStrategy;

class CaceresScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
    	$jsonBody = HttpService::json("https://bop.dip-caceres.es/bop/services/boletines/ultimoBop");
    	$id = $jsonBody['data']['idBoletin'];

        return HTMLScraper::create("https://bop.dip-caceres.es/bop/services/anuncios/anunciosAnunciantes?idBoletin=$id")
            ->getLinks("/contenidoPdfIdAnuncio\?csv\=BOP\-\d+\-\d+/");
    }
}
