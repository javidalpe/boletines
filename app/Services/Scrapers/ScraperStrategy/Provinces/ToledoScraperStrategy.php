<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;

class ToledoScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
	    $now = Carbon::now();
	    $date = $now->format("d/m/Y");
        return HTMLScraper::create("https://bop.diputoledo.es/webEbop/ebopResumen.jsp?publication_date=$date")
            ->getLinks("/DocGet\?id\=\d+\|\d+&insert_number\=\d+&insert_year\=\d+/");
    }
}
