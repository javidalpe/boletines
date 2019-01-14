<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class AlicanteScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://sede.diputacionalicante.es/wp-content/themes/Desarrollo-Diputacion/wseConsultaAjax.php?nemo=BOP_CON&param=%3Craiz%3E%3Centrada%3E%3Cregistro%3E%3CfechaPub%3E%3C%2FfechaPub%3E%3Ctipoorganismo%3E%3C%2Ftipoorganismo%3E%3C%2Fregistro%3E%3C%2Fentrada%3E%3C%2Fraiz%3E&usuario=-")
            ->getLinksFromJson(function($json) {
                return array_map(function ($j) {
                    return $j['ubicacion'][0];
                }, $json['boletin']['bop'][0]['registro']);
            });
    }
}