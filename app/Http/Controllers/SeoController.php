<?php

namespace App\Http\Controllers;

use App\Mothers\SearchConfigMother;
use App\Services\Seo\SeoService;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function globalQueryTerm(Request $request)
    {
	    $pages = SeoService::getSeoPagesForAllTerms();
	    $slug = $request->segments()[0];
	    $publicationsPages = SeoService::getPublicationsPagesForTerm($slug);
	    $page = $pages[$slug];

	    $service = new SearchConfigMother();
	    $searchConfig = $service->createForPredefinedSearch($page->query);

	    $data = [
		    'page'   => $page,
		    'publicationsPages' => $publicationsPages,
		    'config' => json_encode($searchConfig)
	    ];

	    return view('landing.seo.term', $data);
    }

	public function publication(Request $request)
	{
		$pages = SeoService::getSeoPagesForAllPublications();
		$slug = $request->segments()[0];
		$termPages = SeoService::getTermPagesForPublication($slug);
		$page = $pages[$slug];
		$service = new SearchConfigMother();
		$searchConfig = $service->createForPredefinedPublication($page->publicationName);
		$suggestion = SeoService::getSearchSuggestionForPublication($page->publicationName);

		$data = [
			'page'   => $page,
			'termPages' => $termPages,
			'suggestion' => $suggestion,
			'config' => json_encode($searchConfig)
		];

		return view('landing.seo.publication', $data);
	}

	public function publicationTerm(Request $request)
	{
		$termPages = SeoService::getSeoPagesForAllTerms();
		$slug = $request->segments()[0];
		$termPage = $termPages[$slug];

		$publicationsPages = SeoService::getSeoPagesForAllPublications();
		$slug = $request->segments()[1];
		$publicationPage = $publicationsPages[$slug];

		$service = new SearchConfigMother();
		$searchConfig = $service->createForPredefinedPublicationAndTerm($publicationPage->publicationName, $termPage->query);
		$suggestion = SeoService::getSearchSuggestionForPublication($publicationPage->publicationName);

		$data = [
			'termPage'   => $termPage,
			'publicationPage' => $publicationPage,
			'suggestion' => $suggestion,
			'config' => json_encode($searchConfig)
		];

		return view('landing.seo.publication-term', $data);
	}
}
