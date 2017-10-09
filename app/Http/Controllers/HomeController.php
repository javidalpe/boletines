<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Chunk;
use App\Services\Search\SearchConfigService;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function report($id, $timestamp)
    {
    	$alert = Alert::find($id);

    	if (!$alert) return redirect()->route('welcome');

        $service = new SearchConfigService();
        $date = Carbon::createFromTimestamp($timestamp);

        $data = [
            'config' => json_encode($service->createForAlert($alert, $date))
        ];

        return view('dashboard.search', $data);
    }
}
