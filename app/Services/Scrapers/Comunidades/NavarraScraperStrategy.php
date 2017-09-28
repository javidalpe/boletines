<?php


namespace App\Services\Scrapers\Comunidades;


use App\Services\Scrapers\IBoletinScraperStrategy;
use File;
use Storage;

class NavarraScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        exec("wget --reject-regex \"/*Anuncio-*\" --recursive -H --accept-regex \"/home_es/Actualidad/BON/Boletines/*\" -A \"*boletin.pdf\" pdf --timeout=4 -N --tries=2 -l 3 -e robots=off -P storage/app/navarra --domains www.navarra.es http://www.navarra.es/home_es/Actualidad/BON/Boletines/");
    }

    public function getFiles()
    {
        return Storage::allFiles('/navarra/www.navarra.es/home_es/Actualidad/BON/Boletines/');
    }
}