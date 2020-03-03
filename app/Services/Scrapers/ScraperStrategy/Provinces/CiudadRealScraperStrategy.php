<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class CiudadRealScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://bop.sede.dipucr.es/")
            ->getLinks("/https\:\/\/se\d+\.dipucr\.es\:\d+\/SIGEM_BuscadorDocsWeb\/getDocument\.do\?entidad\=\d+&doc\=\d+/");
    }
}
