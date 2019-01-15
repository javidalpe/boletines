<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class BurgosScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://bopbur.diputaciondeburgos.es/bopbur-ultimo")
            ->getLinks("/https\:\/\/bopbur\.diputaciondeburgos\.es\/sites\/default\/files\/private\/publicado\/bopbur\-\d+\-\d+\/bopbur\-\d+\-\d+\-anuncio\-\d+\.pdf/");
    }
}
