<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Chunk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function search()
    {
    	return view('dashboard.search');
    }

    public function report(Request $request)
    {
    	$alert = Alert::find($request->id);

    	if (!$alert) return redirect()->route('home');

    	$chunks = Chunk::search($alert->query)
		    //->where('day', $request->day)
		    ->get();

    	$data = [
    		'chunks' => $chunks
	    ];

    	return view('dashboard.report', $data);
    }
}
