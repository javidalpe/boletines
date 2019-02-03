<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryEloquent;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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
		$data = Socialite::driver('google')->user();
		$email = $data->email;

		$user = $this->getUser($email, $data);

		Auth::login($user);

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
				'password' => str_random(6)
			]);
		}

		return $user;
	}
}
