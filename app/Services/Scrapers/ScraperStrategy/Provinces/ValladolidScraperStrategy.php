<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class ValladolidScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://bop.sede.diputaciondevalladolid.es/?bop=ultimo")
            ->getLinks("/\/boletines\/\d+\/febrero\/\d+\/BOPVA\-A\-\d+\-\d+\.pdf/");
    }
}
