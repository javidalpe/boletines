<?php


namespace App\Http\Controllers;

use Auth;

class SubscriptionsController extends Controller
{

	public function index()
	{
		// Authenticate your user.
		$session = \Stripe\BillingPortal\Session::create([
			'customer' => Auth::user()->stripe_id
		]);

		// Redirect to the customer portal.
		return redirect($session->url);
	}
}
