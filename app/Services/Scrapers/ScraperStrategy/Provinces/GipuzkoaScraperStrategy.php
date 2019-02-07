<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class GipuzkoaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://egoitza.gipuzkoa.eus/es/bog")
            ->forEachLink("/https\:\/\/egoitza\.gipuzkoa\.eus\/gao\-bog\/castell\/bog\/\d+\/\d+\/\d+\/bc\d+\.htm/")
            ->navigate()
            ->getLinks("/\.\.\/\.\.\/\.\.\/\.\.\/\.\.\/castell\/bog\/\d+\/\d+\/\d+\/c\d+\.pdf/");
    }
}