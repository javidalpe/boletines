<?php

namespace App\Http\Controllers;

use App\Mothers\SearchConfigMother;
use App\Services\Seo\SeoService;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function globalQueryTerm(Request $request)
    {
	    $pages = SeoService::getPagesConfigForSeo();
	    $slug = $request->segments()[0];
	    $page = $pages[$slug];
	    $service = new SearchConfigMother();
	    $searchConfig = $service->createForPredefinedSearch($page->query);

	    $data = [
		    'page'   => $page,
		    'config' => json_encode($searchConfig)
	    ];

	    return view('landing.seo.global', $data);
    }
}
