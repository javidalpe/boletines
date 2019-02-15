<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class ValenciaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://bop.dival.es/bop/drvisapi.dll")
            ->getLinks("/\/bop\/drvisapi\.dll\?LO\=\w+&type\=application\/pdf/");
    }
}
