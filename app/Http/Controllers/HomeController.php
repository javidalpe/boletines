<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Chunk;
use App\Mothers\SearchConfigMother;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function report($id, $timestamp)
    {
    	$alert = Alert::find($id);

    	if (!$alert) return redirect()->route('welcome');

        $service = new SearchConfigMother();
        $date = Carbon::createFromTimestamp($timestamp);

        $data = [
            'config' => json_encode($service->createForAlert($alert, $date))
        ];

        return view('dashboard.search', $data);
    }
}
