<?php

namespace App\Services\Seo;

use App\SeoPage;

class SeoService
{
    const PREPOSITIONS = [
        ' a ',
        ' ante ',
        ' bajo ',
        ' cabe ',
        ' con ',
        ' contra ',
        ' de ',
        ' desde ',
        ' en ',
        ' entre ',
        ' hacia ',
        ' hasta ',
        ' para ',
        ' por ',
        ' según ',
        ' sin ',
        ' so ',
        ' sobre ',
        ' tras ',
    ];

    const TERMS = [
        'Oposiciones a celador',
        'Oposiciones a enfermería',
        'Oposiciones a auxiliar de enfermería',
        'Oposiciones a educador social',
        'Oposiciones a educación infantil',
        'Oposiciones a técnico en educación infantil',
        'Oposiciones a bombero',
        'Oposiciones a agente forestal',
        'Oposiciones a correos',
        'Oposiciones a auxiliar administrativo',
        'Oposiciones a hacienda',
        'Oposiciones a justicia',
        'Oposiciones a policía nacional',
        'Oposiciones a policía municipal',
        'Oposiciones a guardia civil',
        'Oposiciones al ejército',

        'Becas mec',
        'Becas de bachillerato',
        'Becas de turespaña',
        'Becas para necesidades educativas especiales',
        'Becas de colaboración',

        'Ofertas de empleo público',
        'Empleo jóven',

        'Subasta judicial',

        'Concursos de acreedores',
        'Concursos de traslados',
        'Concursos de RTVE',
        'Concursos de administración de loterias',
        'Concursos de Euroconsult',

        'Ayudas a inmigrantes',
        'Ayudas al alquiler',
        'Ayudas coches eléctricos',
        'Ayudas abandono de actividad de transporte',
        'Ayudas para mayores de 55 años',
        'Ayudas a la vivienda',
        'Ayudas a compra de viviendas',
        'Ayudas para rehabilitación viviendas',
        'Ayudas a discapacitados',
        'Ayudas a autónomos',
        'Ayudas a extranjeros',
        'Ayudas para libros de texto',
        'Ayudas para material escolar',
        'Ayudas a emprendedores',
        'Ayudas para educación especial',
        'Ayudas a parados de larga duración',
        'Ayudas para guardería',
        'Ayudas para jóven agricultor',
        'Ayudas a familias numerosas',
        'Ayudas por maternidad',
        'Ayudas para regugiados',

        'Premios nacionales fin de carrera',
        'Premios extraordinarios de la ESO',
        'Premios ejercito',
        'Premios nacionales',
    ];

    /**
     * @param $term
     * @return mixed
     */
    private static function toLower($term)
    {
        $lower = strtolower($term);
        $noPrepositions = str_replace(self::PREPOSITIONS, " ", $lower);
        return $noPrepositions;
    }

    public static function getSlug($term)
    {
        $noPrepositions = self::toLower($term);
        $slugged = str_slug($noPrepositions, '-');
        return 'alertas-' . $slugged;
    }

    public static function getQuery($term)
    {
        $noPrepositions = self::toLower($term);
        return $noPrepositions;
    }

	/**
	 * @return SeoPage[]
	 */
    public static function getPagesConfigForSeo()
    {
    	$pages = [];
    	foreach (self::TERMS as $term) {
		    $slug = self::getSlug($term);
		    $pages[$slug] = new SeoPage($slug, self::getQuery($term), $term);
	    }
	    return $pages;
    }

}
