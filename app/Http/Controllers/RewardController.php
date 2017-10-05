<?php

namespace App\Http\Controllers;

use App\Notifications\YouHaveBeenInvitedNotification;
use App\Services\Invitations\InvitationService;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Notification;

class RewardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $service = new InvitationService();
        $url = $service->getInvitationUrl($user);
        $data = [
            'user' => $user,
            'url' => $url,
            'invitees' => $user->invitees
        ];

        return view('dashboard.rewards', $data);
    }

    public function store(Request $request)
    {
        $emails = json_decode($request->emails);
        $user = Auth::user();

        foreach ($emails as $email) {
            if (User::where('email', $email)->first()) continue;

            Notification::route('mail', $email)
                ->notify(new YouHaveBeenInvitedNotification($user));
        }

        flash("Invitaciones enviadas")->success();
        return back();
    }
}
