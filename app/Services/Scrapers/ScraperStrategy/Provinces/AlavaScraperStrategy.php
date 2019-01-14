<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class AlavaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://www.araba.eus/botha/Inicio/SGBO5001.aspx")
            ->getLinks("/\.\.\/Boletines\/\d+\/\d+\/\d+_\d+_\d+_C\.pdf/");
    }
}