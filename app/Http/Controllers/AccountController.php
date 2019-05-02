<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Notifications\AccountDeletedNotification;
use App\Services\Rewards\RewardsService;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Stripe\Invoice;

class AccountController extends Controller
{

    private $rewardService;

    /**
     * AccountController constructor.
     * @param RewardsService $rewardService
     */
    public function __construct(RewardsService $rewardService)
    {
        $this->rewardService = $rewardService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.account.show');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.account.delete');
    }

    /**
     * @param StoreUserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUserRequest $request, $id)
    {
        $user = Auth::user();
        $user->update($request->all());
        flash("Gracias por enviarnos tus comentarios.")->success();
        $this->rewardService->rewardUser($user, RewardsService::FEEDBACK_REWARD);
        return redirect()->route('rewards');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id != $id) {
            return back();
        }
        $user = User::find($id);

        if ($user->subscribed('main')) {
            $user->subscription('main')->cancelNow();
        }

        $user->notify(new AccountDeletedNotification());

        $user->alerts()->delete();
        $user->delete();

        Auth::logout();
        flash("Tu cuenta y todas sus alertas han sido borradas.")->success();
        return redirect()->route('welcome');
    }
}
