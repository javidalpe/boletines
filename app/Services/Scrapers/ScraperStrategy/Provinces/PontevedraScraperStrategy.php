<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class PontevedraScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://boppo.depo.gal/")
            ->getLinks("/\/web\/boppo\/detalle\/\-\/boppo\/\d+\/\d+\/\d+\/\d+\/an\.bop\.PONTEVEDRA\.\d+\.\d+\.pdf/");
    }
}
