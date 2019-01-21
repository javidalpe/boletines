<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class CuencaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("https://www.dipucuenca.es/boletin-oficial-de-la-provincia")
            ->forEachLink("/https\:\/\/www\.dipucuenca\.es\/boletin\-oficial\-de\-la\-provincia\?p_p_id\=bulletins_WAR_bulletinsportlet&_bulletins_WAR_bulletinsportlet_action\=detail&_bulletins_WAR_bulletinsportlet_bulletinId\=\d+/")
	        ->navigate()
	        ->getLinks('/\/documents\/\d+\/\d+\/\d+\.pdf\/\w+\-\w+\-\w+\-\w+\-\w+/');
    }
}
