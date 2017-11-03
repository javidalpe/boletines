<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteRequest;
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
            'invitees' => $user->invitees,
            'invites' => $user->invites()->pending()->get()
        ];

        return view('dashboard.rewards', $data);
    }
}
