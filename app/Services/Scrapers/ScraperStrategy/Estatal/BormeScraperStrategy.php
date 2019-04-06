<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class BormeScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        $actosInscritos =  HTMLScraper::create("https://www.boe.es/diario_borme/")
            ->forEachLink("/\/borme\/dias\/\d+\/\d+\/\d+\//", 3, true)
            ->navigate()
            ->getLinks("/\/borme\/dias\/\d+\/\d+\/\d+\/pdfs\/BORME\-A\-\d+\-\d+\-\d+\.pdf/");

        $otrosActos = HTMLScraper::create("https://www.boe.es/diario_borme/")
	        ->forEachLink("/\/borme\/dias\/\d+\/\d+\/\d+\//", 3, true)
            ->navigate()
            ->forEachLink('/index\.php\?d\=\d+&s\=B/')
	        ->navigate()
            ->getLinks('/\/borme\/dias\/\d+\/\d+\/\d+\/pdfs\/BORME\-B\-\d+\-\d+\-\d+\.pdf/');

        $anuncios = HTMLScraper::create("https://www.boe.es/diario_borme/")
	        ->forEachLink("/\/borme\/dias\/\d+\/\d+\/\d+\//", 3, true)
            ->navigate()
	        ->forEachLink('/index\.php\?d\=\d+&s\=C/')
	        ->navigate()
	        ->getLinks('/\/borme\/dias\/\d+\/\d+\/\d+\/pdfs\/BORME\-C\-\d+\-\d+\.pdf/');

        return array_merge($actosInscritos, $otrosActos, $anuncios);
    }
}
