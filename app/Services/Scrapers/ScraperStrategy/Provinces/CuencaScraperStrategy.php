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
	        ///documents/12423/9935369/2020-12-02-firmado.pdf/5cd73dda-a7bd-4943-9451-63fe5b97b9b8
	        ->getLinks('/\/documents\/\d+\/\d+\/\d+\-\d+\-\d+\-firmado\.pdf\/\w+\-\w+\-\w+\-\w+\-\w+/');
    }
}
