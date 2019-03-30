<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;

class ValladolidScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
    	$now = Carbon::now();
    	$month = $now->formatLocalized('%B');
        return HTMLScraper::create("https://bop.sede.diputaciondevalladolid.es/?bop=ultimo")
            ->getLinks("/\/boletines\/\d+\/$month\/\d+\/BOPVA\-B\-\d+\-\d+\.pdf/");
    }
}
