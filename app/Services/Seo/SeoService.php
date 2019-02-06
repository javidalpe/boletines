<?php

namespace App\Services\Seo;

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

    public static function getIndex($term)
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

    public static function getDescription($term)
    {
        return "Busca en todos los boletines oficiales de España nuevas publicaciones sobre $term y crear alertas diarias.";
    }

    public static function getPagesConfigForSeo()
    {
        return array_map(function($term) {
            return [
                'term' => $term,
                'id' => self::getIndex($term),
                'query' => self::getQuery($term),
                'description' => self::getDescription($term)
            ];
        } ,self::TERMS);
    }

}