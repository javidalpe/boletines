<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class CordobaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://bop.dipucordoba.es/")
            ->getLinks("/\/uploads\/Bop\/\d+\/\d+.pdf\?\d+/");
    }
}
