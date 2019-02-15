<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class BizkaiaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://apps.bizkaia.eus/BT00/")
            ->forEachLink("/SumarioUltimoServlet\?fecha\=\d+&numero\=\d+&primero\=\d+&referenciaBoletin\=BOB\-\d+a\d+\.pdf&sumarioBoletin\=BOB\-\d+a\d+\.pdf&impresion\=\d+&idi\=es&origen\=ultimo/")
	        ->navigate()
	        ->getLinks('/http\:\/\/www\.bizkaia\.eus\/lehendakaritza\/Bao_bob\/[a-zA-Z0-9_\-\/\\\]+.pdf/');
    }
}
