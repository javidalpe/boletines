<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;

class ACorunaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return  HTMLScraper::create("http://bop.dicoruna.es/bopportal/ultimoBoletin.do")
            ->getLinks("/\d+_\d+.pdf/", function($link) {
                $now = Carbon::now();
                return 'publicado/'. $now->format('Y/m/d') . '/'. $link;
            });
    }
}