<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class LleidaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://bop.diputaciolleida.cat/faces/consultaF/mostrarUltim.jsp")
            ->getLinks("/servlets\/donarEdicte\/\?id\=\d+_\d+_\d+/");
    }
}