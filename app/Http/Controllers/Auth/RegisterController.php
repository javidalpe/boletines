<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    const USER_RANDOM_TOKEN = 4;
    const INITIAL_ALERTS = 1;
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/alerts';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $inviterId = $this->getInviterId();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => str_random(self::USER_RANDOM_TOKEN),
            'alerts_limit' => self::INITIAL_ALERTS,
            'user_id' => $inviterId
        ]);

        event(new UserRegistered($user));

        return $user;
    }

    /**
     * @return int|null
     */
    protected function getInviterId(): ?int
    {
        if (!session('token')) {
            return null;
        }

        $token = session('token');
        $otherUser = User::where('token', $token)->first();

        if (!$otherUser) {
            return null;
        }

        return  $otherUser->id;
    }
}
