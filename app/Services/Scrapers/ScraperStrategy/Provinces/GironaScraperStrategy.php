<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class GironaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://www.ddgi.cat/bop/faces/consultaF/mostrarUltim.jsp")
            ->getLinks("/https\:\/\/ssl4\.ddgi\.cat\/bopV1\/pdf\/\d+\/\d+\/\d+\.pdf/");
    }
}
