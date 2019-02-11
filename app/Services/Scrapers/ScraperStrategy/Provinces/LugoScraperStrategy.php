<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class LugoScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://www.deputacionlugo.gal/boletin-oficial-da-provincia-de-lugo/ultimo-bop")
            ->getLinks("/\/sites\/deputacionlugo\.org\/files\/inline\-files\/\d+\-\d+\-\d+\.pdf/");
    }
}