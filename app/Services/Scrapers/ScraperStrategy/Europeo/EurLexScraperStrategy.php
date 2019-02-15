<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;

class EurLexScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
	    $date = Carbon::now()->format('Y');

        $firstLinks =  HTMLScraper::create("https://eur-lex.europa.eu/oj/direct-access.html?locale=es")
            ->forEachLink("/\.\/\.\.\/legal-content\/ES\/TXT\/\?uri=OJ:L:$date:\d+:TOC/")
            ->navigate()
            ->getLinks("/\.\/\.\.\/\.\.\/\.\.\/legal-content\/ES\/TXT\/PDF\/\?uri=OJ:L:$date:\d+:FULL&from=ES/");


        $secondLinks =  HTMLScraper::create("https://eur-lex.europa.eu/oj/direct-access.html?locale=es")
            ->forEachLink("/\.\/\.\.\/legal-content\/ES\/TXT\/\?uri=OJ:C:$date:\d+:TOC/")
            ->navigate()
            ->getLinks("/\.\/\.\.\/\.\.\/\.\.\/legal-content\/ES\/TXT\/PDF\/\?uri=OJ:C:$date:\d+:FULL&from=ES/");

        return array_merge($firstLinks, $secondLinks);
    }
}
