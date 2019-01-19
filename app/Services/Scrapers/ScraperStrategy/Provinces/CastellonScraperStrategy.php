<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class CastellonScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://bop.dipcas.es/PortalBOP/boletin.do#")
            ->getLinks("/\/PortalBOP\/obtenerPdfAnuncio\.do;jsessionid\=\w+\?idAnuncio\=\d+/");
    }
}
