<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class AvilaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://www.diputacionavila.es/boletin-oficial/")
            ->getLinks("/https\:\/\/www\.diputacionavila\.es\/bops\/\d+\/\d+\-\d+\-\d+\.pdf/");
    }
}