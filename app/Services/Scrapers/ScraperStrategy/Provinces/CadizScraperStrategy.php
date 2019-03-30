<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class CadizScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://www.bopcadiz.es/#start")
            ->forEachLink("/srch\.asp\?id\=\d+&anio\=\d+&start\=1&presenta\=0/", 3, true)
	        ->navigate()
	        ->getLinks('/BOP_PDF\/BOP\d+_\d+\-\d+\-\d+\.pdf/');
    }
}
