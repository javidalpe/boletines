<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class ZamoraScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://www.diputaciondezamora.es/index.asp?MP=8&MS=14&MN=2")
            ->forEachLink("/index\.asp\?MP\=\d+&MS\=\d+&MN\=\d+&idboletin\=\d+/")
	        ->navigate()
	        ->getLinks('/\/recursos\/BOP\/anuncios\/\d+\\\\\d+\\\\\d+\.pdf/');
    }
}
