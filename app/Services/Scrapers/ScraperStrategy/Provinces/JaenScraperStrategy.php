<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class JaenScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://bop.dipujaen.es/")
            ->getLinks("/https\:\/\/bop\.dipujaen\.es\/descargarws\.dip\?fechaBoletin\=\d+\-\d+\-\d+&numeroEdicto\=\d+&ejercicioBop\=\d+&tipo\=bop&anioExpedienteEdicto\=\d+/");
    }
}