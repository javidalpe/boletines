<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryEloquent;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleLoginController extends Controller
{

	private $userRepository;

	/**
	 * GoogleLoginController constructor.
	 *
	 * @param $userRepository
	 */
	public function __construct(UserRepositoryEloquent $userRepository)
	{
		$this->userRepository = $userRepository;
	}


	/**
	 * Redirect the user to the GitHub authentication page.
	 *
	 * @return Response
	 */
	public function redirectToProvider()
	{
		return Socialite::driver('google')->redirect();
	}

	/**
	 * Obtain the user information from GitHub.
	 *
	 * @return Response
	 */
	public function handleProviderCallback()
	{
		$data = Socialite::driver('google')->stateless()->user();
		$email = $data->email;

		$user = $this->getUser($email, $data);

		Auth::login($user, true);

		return redirect()->intended(route('alerts.create'));
	}

	/**
	 * @param $email
	 * @param $data
	 *
	 * @return \Illuminate\Database\Eloquent\Model|mixed|null|static
	 */
	private function getUser($email, $data)
	{
		$user = User::where('email', $email)->first();

		if (!$user) {
			$user = $this->userRepository->registerUser([
				'name'     => $data->name,
				'email'    => $email,
				'password' => Str::random(6),
                'token'    => session('token'),
			]);
		}

		return $user;
	}
}
