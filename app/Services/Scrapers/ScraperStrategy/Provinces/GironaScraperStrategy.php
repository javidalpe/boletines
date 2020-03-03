<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class GironaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://www.ddgi.cat/bop/")
            ->getLinks("/https\:\/\/ssl\d+\.ddgi\.cat\/bopV1\/pdf\/\d+\/\d+\/\d+\.pdf/");
    }
}
