<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
	public function welcome()
	{
		return view('landing.welcome');
	}

	public function pricing()
	{
		return view('landing.pricing');
	}
}
