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
        exec("wget --no-directories --recursive -H -A pdf --accept-regex \"boja/*\" --timeout=4 -N --tries=2 -l 2 -e robots=off -P storage/app/junta --domains www.juntadeandalucia.es http://www.juntadeandalucia.es/boja");
        #wget --secure-protocol TLSv1 --no-check-certificate --no-directories --recursive -H -A pdf  --timeout=4 -N --tries=2 -l 2 -e robots=off https://bop.dival.es/bop/drvisapi.dll/
        #wget --no-directories --recursive -H -A pdf  --timeout=4 -N --tries=2 -l 2 -e robots=off http://www.dogv.gva.es/va/inici#IniciUltimDogv
        #Murcia wget --no-directories --recursive -H --timeout=4 -N --tries=2 -l 2 -e robots=off https://www.borm.es/borm/vista/principal/inicio.jsf
        #Asturias wget --no-directories --recursive -H -A pdf  --timeout=4 -N --tries=2 -l 2 -e robots=off -P storage/app/asturias --domains sede.asturias.es https://www.asturias.es/bopa
        #Baleares wget --no-directories --recursive -H --timeout=4 -N --tries=2 -l 4 -erobots=off -P storage/app/ibalears --domains www.caib.es http://www.caib.es/boib/
        #Canarias wget --no-directories --recursive -H -A pdf --accept-regex "boc/*" --timeout=4 -N --tries=2 -l 2 -e robots=off -P storage/app/canarias --domains sede.gobcan.es,www.gobiernodecanarias.org http://www.gobiernodecanarias.org/boc/
        #Melilla wget --no-directories --recursive -H -A pdf --timeout=4 -N --tries=2 -l 3 -erobots=off -P storage/app/melilla --domains www.melilla.es http://www.melilla.es/melillaportal/contenedor.jsp?seccion=bome.jsp
        #LaRioja

    }

    public function getFiles()
    {
        return Storage::files('junta');
    }
}