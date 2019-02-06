<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;
use Carbon\Carbon;

class GranadaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
    	$date = Carbon::now()->format('d/m/Y');
        return HTMLScraper::create("http://bop2.dipgra.es:8880/opencms/opencms/portal/index.jsp?opcion=listaEventos&fecha=$date")
            ->getLinks("/DescargaPDFBoletin\?fecha\=\d+\/\d+\/\d+/");
    }
}
