<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class CiudadRealScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://bop.sede.dipucr.es/")
            ->getLinks("/http\:\/\/se1\.dipucr\.es\:8080\/SIGEM_BuscadorDocsWeb\/getDocument\.do\?entidad\=005&doc\=\d+/");
    }
}
