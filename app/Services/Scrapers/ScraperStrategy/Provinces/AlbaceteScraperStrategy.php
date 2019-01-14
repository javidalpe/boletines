<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\FileDownloaderScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;

class AlbaceteScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;

        return FileDownloaderScraper::create("http://www.dipualba.es/WebBop/ajaxpro/WebBop.Servidor,WebBop.ashx", "POST",
            ['headers' => ['X-AjaxPro-Method' => 'dameSumarioDia'], 'body' => "{\"año\":$year,\"mes\":$month,\"dia\":$day}"])
            ->getLinks("/http\:\/\/www\.dipualba\.es\/bop\/ficheros\/\d+\/\d+\/BOP \d+\-\d+\-P\.PDF/");
    }
}