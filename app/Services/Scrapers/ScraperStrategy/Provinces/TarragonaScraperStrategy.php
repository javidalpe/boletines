<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;

class TarragonaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
    	$date = Carbon::now()->format('Y');
        return HTMLScraper::create("https://www.diputaciodetarragona.cat/ebop/index.php?op=sumari&ebop_any=$date&pagok=0")
            ->getLinks("/index\.php\?op\=dwn&tipus\=i&data\=\d+&anyp\=\d+&num\=\d+&v\=i/");
    }
}
