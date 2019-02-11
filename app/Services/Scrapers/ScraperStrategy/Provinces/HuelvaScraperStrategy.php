<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class HuelvaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://sede.diphuelva.es/servicios/bop")
            ->getLinks('/\/portalweb\/bop\/boletines\/\d+\-\d+\.pdf/');
    }
}