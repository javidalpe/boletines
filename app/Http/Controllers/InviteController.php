<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteRequest;
use App\Invite;
use App\Notifications\YouHaveBeenInvitedNotification;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Notification;

class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InviteRequest $request)
    {
        $emails = json_decode($request->emails);
        $user = Auth::user();

        $numberOfInvites = 0;
        foreach ($emails as $email) {
            if (User::where('email', $email)->first()) continue;

            if ($user->invites()->where('email', $email)->first()) continue;

            $user->invites()->save(new Invite(['email' => $email]));

	        $numberOfInvites++;
            Notification::route('mail', $email)
                ->notify(new YouHaveBeenInvitedNotification($user));
        }

        if ($numberOfInvites) {
	        flash("Invitaciones enviadas")->success();
        } else {
	        flash("Los emails que has introducido ya han sido invitados o han sido utilizado para crear una cuenta.")->error();
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function show(Invite $invite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function edit(Invite $invite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invite $invite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invite $invite)
    {
        //
    }
}
