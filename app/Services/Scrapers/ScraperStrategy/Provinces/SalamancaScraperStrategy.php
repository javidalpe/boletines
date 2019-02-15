<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class SalamancaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://sede.diputaciondesalamanca.gob.es/BOP/")
            ->getLinks("/\/documentacion\/bop\/\d+\/\d+\/BOP\-SA\-\d+\-\d+\.pdf/");
    }
}
