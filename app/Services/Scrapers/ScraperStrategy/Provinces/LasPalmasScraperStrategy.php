<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class LasPalmasScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://www.boplaspalmas.net/nbop2/main1.php")
            ->getLinks("/\.\.\/boletines\/\d+\/\d+\-\d+\-\d+\/\d+\-\d+\-\d+\.pdf/");
    }
}