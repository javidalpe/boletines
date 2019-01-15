<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class BarcelonaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://bop.diba.cat/default.asp?C=recerca.sumari_institucions")
            ->forEachLink("/\/default\.asp\?C\=recerca\.sumari_institucions&f1\=\d+\/\d+\/\d+&f2\=\d+\/\d+\/\d+&sl\=\d+&o\=\d+&p\=\d+/")
	        ->getLinks("/https\:\/\/bop\.diba\.cat\/scripts\/ftpisa\.aspx\?fnew\?\w+&\d+\/\d+\.pdf&1/");
    }
}
