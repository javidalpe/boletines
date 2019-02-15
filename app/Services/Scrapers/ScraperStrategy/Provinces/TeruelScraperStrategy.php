<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\Http\Request;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;

class TeruelScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
	    Carbon::setLocale('es');
	    $now = Carbon::now();
	    $month = $now->formatLocalized('%B');
	    $date = $now->format("Y/d");

	    return [new Request("https://236ws.dpteruel.es/estatico/boletines/$date$month.pdf", 'GET', [])];
    }
}
