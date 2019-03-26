<?php

namespace App\Repositories;

use App\Events\UserRegistered;
use App\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
	const USER_RANDOM_TOKEN = 4;
	const INITIAL_ALERTS = 0;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function registerUser($data)
    {
	    $inviterId = $this->getInviterId();

	    $user = $this->create([
		    'name' => $data['name'],
		    'email' => $data['email'],
		    'password' => bcrypt($data['password']),
		    'token' => str_random(self::USER_RANDOM_TOKEN),
		    'free_alerts' => self::INITIAL_ALERTS,
		    'user_id' => $inviterId
	    ]);

        $user->createAsStripeCustomer([
            'email' => $user->email,
            'description' => $user->name
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

		return $otherUser->id;
	}
}
