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

        $service = new SearchConfigService();

        $data = [
            'config' => json_encode($service->createForSearch())
        ];

		return view('landing.welcome',$data);
	}
}
