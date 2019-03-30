<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class GuadalajaraScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://boletin.dguadalajara.es/boletin/")
            ->forEachLink("/\/boletin\/index\.php\/\d+\-general\/\d+\-Boletín\-Oficial\-de\-la\-Provincia\-de\-Guadalajara\-núm\-\d+\-[^\"]+/", 3)
            ->navigate()
            ->getLinks("/http\:\/\/boletin\.dguadalajara\.es\/boletin\/pdf\/BOP\d+\.pdf/");
    }
}
