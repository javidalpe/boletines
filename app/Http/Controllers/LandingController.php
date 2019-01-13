<?php

namespace App\Http\Controllers;

use App\Mothers\SearchConfigMother;
use App\Publication;
use App\Services\ScrapingService;
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
            'config' => json_encode($service->createForSearch())
        ];

		return view('landing.welcome',$data);
	}

	public function how()
    {
        return view('landing.how');
    }

    public function status()
    {
        $data = [
            'publications1' => Publication::whereIn('priority',
                [ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1,
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
