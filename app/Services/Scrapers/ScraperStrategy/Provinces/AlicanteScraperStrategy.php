<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class AlicanteScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        $firstLinks =  HTMLScraper::create("http://sede.diputacionalicante.es/consultas-bop/")
            ->forEachLink("/\.\/\.\.\/legal-content\/ES\/TXT\/\?uri=OJ:L:2019:\d+:TOC/")
            ->navigate()
            ->getLinks('/\.\/\.\.\/\.\.\/\.\.\/legal-content\/ES\/TXT\/PDF\/\?uri=OJ:L:2019:\d+:FULL&from=ES/');


        $secondLinks =  HTMLScraper::create("https://eur-lex.europa.eu/oj/direct-access.html?locale=es")
            ->forEachLink("/\.\/\.\.\/legal-content\/ES\/TXT\/\?uri=OJ:C:2019:\d+:TOC/")
            ->navigate()
            ->getLinks('/\.\/\.\.\/\.\.\/\.\.\/legal-content\/ES\/TXT\/PDF\/\?uri=OJ:C:2019:\d+:FULL&from=ES/');

        return array_merge($firstLinks, $secondLinks);
    }
}