<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class LeonScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://www.dipuleon.es/bopSearchAction/Ciudadanos/Boletin_Oficial_Provincia/")
            ->getLinks("/\/file;jsessionid\=\w+\/\w+/", null, 1);
    }
}