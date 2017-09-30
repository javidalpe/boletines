<?php

namespace App\Http\Controllers;

use App\Publication;
use App\Run;

class AdminController extends Controller
{
    public function scrapers()
    {
        $publications = Publication::all();
        $runs = Run::with("publication")->orderBy('id', 'desc')->get();

        $data = [
            'publications' => $publications,
            'runs' => $runs
        ];

        return view('admin.scrapers', $data);
    }
}
