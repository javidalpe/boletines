<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [
            'user' => $user,
            'invitees' => $user->invitees
        ];

        return view('dashboard.rewards', $data);
    }
}
