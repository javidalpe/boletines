<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class AlmeriaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://www.dipalme.org/Servicios/cmsdipro/index.nsf/bop_view.xsp?p=dipalme")
            ->getLinks("/\/Servicios\/Boletin\/bopanexos\.nsf\/fecha\/\w+\/\\\$File\/\d+\.pdf/");
    }
}