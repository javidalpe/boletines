<?php

namespace App\Services\Seo;

use Illuminate\Support\Str;
use App\Publication;
use App\SeoPage;
use App\Services\ScrapingService;

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
	    self::BOLETIN_OFICIAL_DEL_ESTADO,
	    self::DIARIO_OFICIAL_DE_LA_UNION_EUROPEA,
	    self::BOLETIN_OFICIAL_DEL_REGISTRO_MERCANTIL,
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

        "Oposiciones a técnico de auditoría y contabilidad",
        "Oposiciones a técnico de administración general",
        "Oposiciones a técnico de aduanas",
        "Oposiciones a técnico de anatomía patológica",
        "Oposiciones a técnico de ayuntamiento",
        "Oposiciones a técnico de biblioteca",
        "Oposiciones a técnico de Banco de España",
        "Oposiciones a técnico de comunicación",
        "Oposiciones a técnico de consumo",
        "Oposiciones a técnico de cultura",
        "Oposiciones a técnico de catastro",
        "Oposiciones a técnico de comercio",
        "Oposiciones a técnico de cooperación",
        "Oposiciones a técnico de calidad",
        "Oposiciones a técnico de Tribunal de Cuentas",
        "Oposiciones a técnico de deportes",
        "Oposiciones a técnico de documentación sanitaria",
        "Oposiciones a técnico de dietética",
        "Oposiciones a técnico de empleo",
        "Oposiciones a técnico de emergencias",
        "Oposiciones a técnico en educación infantil",
        "Oposiciones a técnico de farmacia",
        "Oposiciones a técnico forestal",
        "Oposiciones a técnico fotógrafo",
        "Oposiciones a técnico forense",
        "Oposiciones a técnico de gestión",
        "Oposiciones a técnico de Hacienda",
        "Oposiciones a técnico de investigación",
        "Oposiciones a técnico de igualdad",
        "Oposiciones a técnico de inspección",
        "Oposiciones a técnico de inserción laboral",
        "Oposiciones a técnico de imagen para el diagnóstico",
        "Oposiciones a técnico de informática",
        "Oposiciones a técnico de integración social",
        "Oposiciones a técnico de jardín de infancia",
        "Oposiciones a técnico de justicia",
        "Oposiciones a técnico de juventud",
        "Oposiciones a técnico jurídico",
        "Oposiciones a técnico de laboratorio",
        "Oposiciones a técnico de medio ambiente",
        "Oposiciones a técnico de mantenimiento",
        "Oposiciones a técnico de museos",
        "Oposiciones a técnico de marketing",
        "Oposiciones a técnico de movilidad",
        "Oposiciones a técnico de orientación laboral",
        "Oposiciones a técnico en operaciones de vuelo ",
        "Oposiciones a técnico de obras públicas",
        "Oposiciones a técnico de prevención",
        "Oposiciones a técnico de peluquería",
        "Oposiciones a técnico de protocolo",
        "Oposiciones a técnico de prisiones",
        "Oposiciones a técnico de patrimonio",
        "Oposiciones a técnico de Protección Civil",
        "Oposiciones a técnico de pesca",
        "Oposiciones a técnico de rayos",
        "Oposiciones a técnico de radiodiagnóstico",
        "Oposiciones a técnico de recursos humanos",
        "Oposiciones a técnico de riesgos laborales",
        "Oposiciones a técnico de seguridad social",
        "Oposiciones a técnico de sonido",
        "Oposiciones a técnico de salud ambiental",
        "Oposiciones a técnico de salud pública",
        "Oposiciones a técnico de soporte informático",
        "Oposiciones a técnico de sanidad y consumo",
        "Oposiciones a técnico de sistemas informáticos",
        "Oposiciones a técnico superior de laboratorio",
        "Oposiciones a técnico superior en educación infantil",
        "Oposiciones a técnico superior de actividades técnicas y profesionales ",
        "Oposiciones a técnico superior de la Seguridad Social",
        "Oposiciones a técnico superior de gestión y servicios comunes",
        "Oposiciones a técnico superior de salud pública",
        "Oposiciones a técnico superior de instituciones penitenciarias",
        "Oposiciones a técnico superior en informática",
        "Oposiciones a técnico de turismo",
        "Oposiciones a técnico de Tráfico",
        "Oposiciones a técnico de trabajo",
        "Oposiciones a técnico de telecomunicaciones",
        "Oposiciones a técnico de urbanismo",

        "Oposiciones a bombero",
        "Oposiciones a agente forestal",
        "Oposiciones a correos",
        "Oposiciones a auxiliar administrativo",
        "Oposiciones a Hacienda",
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

	public const BOLETIN_OFICIAL_DEL_ESTADO = "Boletín Oficial del Estado";
	public const DIARIO_OFICIAL_DE_LA_UNION_EUROPEA = "Diario Oficial de la Unión Europea";
	public const BOLETIN_OFICIAL_DEL_REGISTRO_MERCANTIL = "Boletín Oficial del Registro Mercantil";

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
	    $noPrepositions = str_replace(self::PREPOSITIONS, " ", $term);
        $slugged = Str::slug($noPrepositions, '-', 'es');
        return $slugged;
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

	/**
	 * @param string $publicationName
	 *
	 * @return string
	 */
	public static function getSearchSuggestionForPublication($publicationName)
	{
		switch ($publicationName)
		{
			case self::BOLETIN_OFICIAL_DEL_REGISTRO_MERCANTIL:
				return "Puedes buscar un nombre de empresa, un CIF, un teléfono de empresa. También nombramientos, juntas generales, ampliaciones de capital, actos inscritos, ...";
			case self::BOLETIN_OFICIAL_DEL_ESTADO:
				return "Puedes buscar oposiciones, ayudas, concursos, licitaciones, subastas, multas, nombres de personas. Ejemplo: \"ayudas al alquiler\", \"Maria Peña\", \"paternidad\", ...";
			case self::DIARIO_OFICIAL_DE_LA_UNION_EUROPEA:
				return "Puedes buscar nuevas licitaciones, anuncios de información previa DOUE, normas armonizasas, partidas arancelarias, código intrastat, siglas, ...";
			default:
				return "Puedes buscar oposiciones, nombres, direcciones, empresas. Ejemplo: 75714470, \"Maria Peña\", \"energias renovables\", ...";
		}
	}
}
