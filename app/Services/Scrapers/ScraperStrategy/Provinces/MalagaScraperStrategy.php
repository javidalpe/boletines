<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\Http\HttpService;
use App\Services\Scrapers\IBoletinScraperStrategy;

class MalagaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://www.bopmalaga.es/")
            ->getLinks("/\/descarga\.php\?archivo\=\d+\-\d+\-\d+\-\d+\.pdf/", null, PHP_INT_MAX, [
                'headers' => HttpService::CHROME_HEADERS
            ]);
    }
}
