<?php

namespace App\Http\Controllers;

use App\Mothers\SearchConfigMother;
use App\Publication;
use App\Services\ScrapingService;
use App\Services\Seo\SeoService;
use Auth;
use Illuminate\Http\Request;

class LandingController extends Controller
{
	public function welcome(Request $request)
	{
	    if ($request->token) {
	        session(['token'=> $request->token]);
        }

        $service = new SearchConfigMother();

        $data = [
            'config' => json_encode($service->createForSearch()),
            'pages' => SeoService::getPagesConfigForSeo()
        ];

		return view('landing.welcome',$data);
	}

    public function page(Request $request)
    {
        $pages = SeoService::getPagesConfigForSeo();
        dd($request->id);
        return view('landing.how');
    }

	public function how()
    {
        return view('landing.how');
    }

	public function alerts(Request $request)
	{
		if (Auth::check()) {
			return redirect()->route('alerts.create', $request->query());
		}

		return view('landing.alerts');
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
}
