<?php

namespace App\Services\Scrapers\Europeo;

use App\Services\Scrapers\HTMLScraper;
use App\Services\Scrapers\IBoletinScraperStrategy;

class HuescaScraperStrategy implements IBoletinScraperStrategy
{

    public function downloadFilesFromInternet()
    {
        return HTMLScraper::create("http://bop.dphuesca.es/index.php/mod.menus/mem.detalle/idmenu.50003/chk.8b6c14323b2b2646096ff665f91d80d6.html")
            ->forEachLink("/\/index\.php\/mod\.menus\/mem\.detalle\/idmenu\.\d+\/chk\.\w+.html/")
            ->navigate()
            ->getLinks("/\/index\.php\/mod\.bopanuncios\/mem\.visualizarpdf\/relcategoria\.\d+\/idbopanuncio\.\d+\/seccion\.portal\/chk\.\w+.html/");
    }
}