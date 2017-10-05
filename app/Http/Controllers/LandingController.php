<?php

namespace App\Http\Controllers;

use App\Services\Search\SearchConfigService;
use Illuminate\Http\Request;

class LandingController extends Controller
{
	public function welcome(Request $request)
	{
	    if ($request->token) {
	        session(['token'=> $request->token]);
        }

		return view('landing.welcome');
	}

    public function demo()
    {
        $service = new SearchConfigService();
        $data = [
            'config' => json_encode($service->createForDemo())
        ];
        return view('landing.demo', $data);
    }

	public function pricing()
	{
		return view('landing.pricing');
	}
}
