<?php

namespace App\Services\Seo;

use App\Publication;
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

    const PUBLICATIONS = [
        "Boletín Oficial del Estado",
	    "Diario Oficial de la Unión Europea",
        "Boletín Oficial de la Junta de Andalucía",
        "Boletín Oficial de Aragón",
        "Boletín Oficial del Principado de Asturias",
        "Boletín Oficial de Islas Baleares",
        "Boletín Oficial de Canarias",
        "Boletín Oficial de Cantabria",
        "Diario Oficial de Castilla-La Mancha",
        "Boletín Oficial de Castilla y León",
        "Diari Oficial de la Generalitat de Catalunya",
        "Diario Oficial de Extremadura",
        "Diario Oficial de Galicia",
        "Boletín Oficial de La Rioja",
        "Boletín Oficial de la Comunidad de Madrid",
        "Boletín Oficial de la Región de Murcia",
        "Boletín Oficial de Navarra",
        "Boletín Oficial del País Vasco",
        "Diari Oficial de la Comunitat Valenciana",
        "Boletín Oficial de la Ciudad Autónoma de Ceuta",
        "Boletín Oficial de la Ciudad Autónoma de Melilla",
	    "Boletín Oficial de A Coruña",
	    "Boletín Oificial del Territorio Histórico de Álava",
	    "Boletín Oficial de Albacete",
	    "Boletín Oficial de Alicante",
	    "Boletín Oficial de Almería",
	    "Boletín Oficial de Ávila",
	    "Boletín Oficial de Badajoz",
	    "Boletín Oficial de Barcelona",
	    "Boletín Oficial de Burgos",
	    "Boletín Oficial de Cáceres",
	    "Boletín Oficial de Cádiz",
	    "Boletín Oficial de Castellón",
	    "Boletín Oficial de Ciudad Real",
	    "Boletín Oficial de Córdoba",
	    "Boletín Oficial de Cuenca",
	    "Boletín Oficial de Girona",
	    "Boletín Oficial de Granada",
	    "Boletín Oficial de Guadalajara",
	    "Boletín Oficial de Guipuzkoa",
	    "Boletín Oficial de Huelva",
	    "Boletín Oficial de Huesca",
	    "Boletín Oficial de Jaén",
	    "Boletín Oficial de Las Palmas",
	    "Boletín Oficial de León",
	    "Boletín Oficial de Lleida",
	    "Boletín Oficial de Lugo",
	    "Boletín Oficial de Málaga",
	    "Boletín Oficial de Ourense",
	    "Boletín Oficial de Palencia",
	    "Boletín Oficial de Pontevedra",
	    "Boletín Oficial de Salamanca",
	    "Boletín Oficial de Santa Cruz de Tenerife",
	    "Boletín Oficial de Segovia",
	    "Boletín Oficial de Sevilla",
	    "Boletín Oficial de Soria",
	    "Boletín Oficial de Tarragona",
	    "Boletín Oficial de Teruel",
	    "Boletín Oficial de Toledo",
	    "Boletín Oficial de Valencia",
	    "Boletín Oficial de Valladolid",
	    "Boletín Oficial de Vizcaya",
	    "Boletín Oficial de Zamora",
	    "Boletín Oficial de Zaragoza",
    ];

    const TERMS = [
        "Oposiciones a celador",
        "Oposiciones a enfermería",
        "Oposiciones a auxiliar de enfermeria",
        "Oposiciones a educador social",
        "Oposiciones a educación infantil",
        "Oposiciones a técnico en educación infantil",
        "Oposiciones a bombero",
        "Oposiciones a agente forestal",
        "Oposiciones a correos",
        "Oposiciones a auxiliar administrativo",
        "Oposiciones a hacienda",
        "Oposiciones a justicia",
        "Oposiciones a policía nacional",
        "Oposiciones a policía municipal",
        "Oposiciones a guardia civil",
        "Oposiciones al ejército",

        "Becas mec",
        "Becas de bachillerato",
        "Becas de turespaña",
        "Becas para necesidades educativas especiales",
        "Becas de colaboración",
        "Becas para estudios de doctorado",
        "Becas de investigación",

        "Ofertas de empleo público",
        "Empleo jóven",

        "Subasta judicial concursal",
        "Subasta judicial voluntaria",

        "Concursos de acreedores",
        "Concursos de traslados",
        "Concursos de RTVE",
        "Concursos de administración de loterias",
        "Concursos de Euroconsult",

        "Ayudas a inmigrantes",
        "Ayudas al alquiler",
        "Ayudas coches eléctricos",
        "Ayudas abandono de actividad de transporte",
        "Ayudas para mayores de 55 años",
        "Ayudas a la vivienda",
        "Ayudas a compra de viviendas",
        "Ayudas para rehabilitación viviendas",
        "Ayudas a discapacitados",
        "Ayudas a autónomos",
        "Ayudas al autoempleo",
        "Ayudas a la contratación",
        "Ayudas a extranjeros",
        "Ayudas para libros de texto",
        "Ayudas para material escolar",
        "Ayudas a emprendedores",
        "Ayudas para educación especial",
        "Ayudas a parados de larga duración",
        "Ayudas para guardería",
        "Ayudas para jóven agricultor",
        "Ayudas a familias numerosas",
        "Ayudas por maternidad",
        "Ayudas para refugiados",

        "Premios nacionales fin de carrera",
        "Premios extraordinarios de la ESO",
        "Premios ejercito",
        "Premios nacionales",
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
        $slugged = str_slug($term, '-', 'es');
	    $noPrepositions = str_replace(self::PREPOSITIONS, " ", $slugged);
        return $noPrepositions;
    }

    public static function getQuery($term)
    {
        $noPrepositions = self::toLower($term);
        return $noPrepositions;
    }


    public static $pagesForTerms = null;

	/**
	 * @return SeoPage[]
	 */
    public static function getSeoPagesForAllTerms()
    {
    	if (!self::$pagesForTerms) {
		    $pages = [];
		    foreach (self::TERMS as $term) {
			    $slug = self::getTermSlug($term);
			    $pages[$slug] = new SeoPage($slug, self::getQuery($term), $term);
		    }
		    self::$pagesForTerms = $pages;
	    }

	    return self::$pagesForTerms;
    }

	public static $pagesForPublications = null;

    /**
     * @return SeoPage[]
     */
    public static function getSeoPagesForAllPublications()
    {
	    if (!self::$pagesForPublications) {
		    $pages = [];
		    foreach (self::PUBLICATIONS as $publication) {
			    $slug = self::getSlug($publication);
			    $pages[$slug] = new SeoPage($slug, null, null, $publication);
		    }
		    self::$pagesForPublications = $pages;
	    }

	    return self::$pagesForPublications;
    }

    /**
     * @return SeoPage[]
     */
    public static function getTermPagesForPublication($publicationSlug)
    {
        $pagesForPublications = self::getSeoPagesForAllPublications();
        $pageConfig = $pagesForPublications[$publicationSlug];
	    $pages = [];
        foreach (self::TERMS as $term) {
            $slug = self::getTermSlug($term) . '/' . $pageConfig->url;
            $pages[$slug] = new SeoPage($slug, self::getQuery($term), $term, $pageConfig->publicationName);
        }

        return $pages;
    }

    /**
     * @return SeoPage[]
     */
    public static function getPublicationsPagesForTerm($termSlug)
    {
        $pagesForTerms = self::getSeoPagesForAllTerms();
        $pageConfig = $pagesForTerms[$termSlug];
	    $pages = [];
        foreach (self::PUBLICATIONS as $publication) {
            $slug = $pageConfig->url . '/' . self::getSlug($publication);
            $pages[$slug] = new SeoPage($slug, self::getQuery($pageConfig->query), $pageConfig->termName, $publication);
        }

        return $pages;
    }

	/**
	 * @param $term
	 *
	 * @return string
	 */
	private static function getTermSlug($term): string
	{
		return 'alertas-' . self::getSlug($term);
}
}
