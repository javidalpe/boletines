<?php

namespace App\Http\Controllers;

use App\Chunk;
use App\Mothers\SearchConfigMother;
use App\Publication;
use App\Services\ScrapingService;
use App\Services\Seo\SeoService;
use Auth;
use Illuminate\Http\Request;

class LandingController extends Controller
{
	public function welcome()
	{
		$service = new SearchConfigMother();
		$searchConfig = $service->createForSearch();
		$termPages = SeoService::getSeoPagesForAllTerms();
		$publicationsPages = SeoService::getSeoPagesForAllPublications();
		$suggestion = SeoService::getSearchSuggestionForPublication('');

		$data = [
			'config' => json_encode($searchConfig),
			'termPages'  => $termPages,
			'publicationsPages' => $publicationsPages,
			'suggestion' => $suggestion,
		];

		return view('landing.welcome', $data);
	}

	public function search(Request $request)
    {
        $service = new SearchConfigMother();
        $searchConfig = $service->createForPredefinedSearch($request->get('q', ''));

        $data = [
            'config' => json_encode($searchConfig)
        ];

        return view('landing.search', $data);
    }

	public function how()
	{
		return view('landing.how');
	}

	public function bye()
	{
		return view('landing.bye');
	}

	public function view($id)
	{
		$chunk = Chunk::findOrFail($id);
		return redirect($chunk->url);
	}

	public function alerts(Request $request)
	{
		if (!$request->has('query') && Auth::guest()) {
			return view('landing.alerts');
		}

		if ($request->has('query')) {
			session()->put('query', $request->query('query'));
		}

		if (Auth::check()) {
			return redirect()->route('alerts.create');
		} else {
			return redirect()->route('alerts');
		}
	}

	public function status()
	{
		$data = [
			'publications1' => Publication::whereIn('priority',
				[ScrapingService::PRIORITY_NATIONAL,
					ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1])->get(),
			'publications2' => Publication::whereIn('priority',
				[ScrapingService::PRIORITY_PROVINCE])->get(),
		];

		return view('landing.status', $data);
	}

	public function about()
	{
		return view('landing.about');
	}

	public function privacy()
	{
		return view('landing.privacy');
	}

	public function cookies()
	{
		return view('landing.cookies');
	}

	public function contact()
	{
		return view('landing.contact');
	}

    public function developers()
    {
        return view('landing.developers');
    }
}
