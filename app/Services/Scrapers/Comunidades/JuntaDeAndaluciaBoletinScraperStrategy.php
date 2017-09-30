<?php


namespace App\Services\Scrapers\Comunidades;

use App\Services\Scrapers\IBoletinScraperStrategy;
use App\Services\ScrapingService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class JuntaDeAndaluciaBoletinScraperStrategy implements IBoletinScraperStrategy
{


    public function downloadFilesFromInternet()
    {
        exec("wget --no-directories --recursive -H -A pdf --accept-regex \"boja/*\" --timeout=4 -N --tries=2 -l 2 -e robots=off -P storage/app/public/junta --domains www.juntadeandalucia.es http://www.juntadeandalucia.es/boja");
    }

    public function getFiles()
    {
        return Storage::files('junta');
    }
}