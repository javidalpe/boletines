<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class HuelvaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://sede.diphuelva.es/servicios/bop")
            ->getLinks('/%2Fportalweb%2Fbop%2Fboletines%2F\d+\-\d+\.pdf/');
    }
}
