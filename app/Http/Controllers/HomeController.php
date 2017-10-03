<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Chunk;
use App\Services\Search\SearchConfigService;
use Carbon\Carbon;
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
        $service = new SearchConfigService();
        $data = [
            'config' => json_encode($service->createForSearch())
        ];
    	return view('dashboard.search', $data);
    }

    public function report($id, $timestamp)
    {
    	$alert = Alert::find($id);

    	if (!$alert) return redirect()->route('home');

        $service = new SearchConfigService();
        $date = Carbon::createFromTimestamp($timestamp);

        $data = [
            'config' => json_encode($service->createForAlert($alert, $date))
        ];

        return view('dashboard.search', $data);
    }
}
