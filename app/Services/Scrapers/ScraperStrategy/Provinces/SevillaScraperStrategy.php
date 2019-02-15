<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class SevillaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://www.dipusevilla.es/bop/")
            ->getLinks("/\/system\/modules\/com\.saga\.sagasuite\.theme\.diputacion\.sevilla\.corporativo\/handlers\/download\-bop\.pdf\?id\=\w+\-\w+\-\w+\-\w+\-\w+/");
    }
}
