<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class PalenciaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://www.diputaciondepalencia.es/servicios/boletin-oficial-provincia")
            ->getLinks("/https\:\/\/www\.diputaciondepalencia\.es\/system\/files\/bop\/\d+\/\d+\-bop\-\d+\-ordinario\.pdf/");
    }
}
