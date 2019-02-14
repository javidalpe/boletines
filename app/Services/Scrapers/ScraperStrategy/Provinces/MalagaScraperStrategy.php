<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class MalagaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://www.bopmalaga.es/")
            ->getLinks("/\/descarga\.php\?archivo\=\d+\-\d+\-\d+\-\d+\.pdf/", null, PHP_INT_MAX, [
                'headers' => [
                    "Host" => "www.bopmalaga.es",
                    "Connection" => "keep-alive",
                    "Pragma" => "no-cache",
                    "Cache-Control" => "no-cache",
                    "Upgrade-Insecure-Requests" => "1",
                    "User-Agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36",
                    "Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
                    "Referer" => "https://www.bopmalaga.es/",
                    "Accept-Encoding" => "gzip, deflate, br",
                    "Accept-Language" => "es-ES,es;q=0.9,en;q=0.8,ca;q=0.7",
                ]
            ]);
    }
}