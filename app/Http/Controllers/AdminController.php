<?php

namespace App\Http\Controllers;

use App\Publication;
use App\Run;
use Illuminate\Http\Request;

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

    public function regex()
    {
        return view('admin.regex');
    }

    public function regexStore(Request $request)
    {
        $input = $request->input('link');
        $input = preg_quote($input);
        $input = str_replace("/", "\/", $input);
        $withoutNumber = preg_replace("(\d+)", "\d+", $input);
        return view('admin.regex', ['regex' => $withoutNumber]);
    }
}
