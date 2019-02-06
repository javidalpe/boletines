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
