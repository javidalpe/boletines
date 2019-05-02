<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Events\AlertCreated;
use App\Events\AlertDeleted;
use App\Http\Requests\StoreAlertRequest;
use App\Services\Billing\BillingService;
use Auth;
use Illuminate\Http\Request;

class AlertController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Alert::class, 'alert');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = [
            'alerts' => $user->alerts,
            'user' => $user
        ];

        return view('dashboard.alerts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('create', Alert::class)) {
            flash("Has superado el límite de alertas permitido.")->warning();
            return back();
        }

        $user = Auth::user();
        $alertCount = $user->alerts()->count();
        $data = [
        	'shouldPay' => BillingService::shouldUserPayForNewAlert($user),
	        'alertsCount' => $alertCount
        ];
        return view('dashboard.alerts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAlertRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlertRequest $request)
    {
        $user = Auth::user();

        $shouldUserPayForNewAlert = BillingService::shouldUserPayForNewAlert($user);
        $alert = $user->alerts()->create($request->all());

	    if ($shouldUserPayForNewAlert) {
	        if ($user->subscribed('main')) {
		        $user->subscription('main')->updateQuantity(BillingService::billableAlertsCount($user));
	        } else {
		        $user->newSubscription('main', config('services.stripe.alert-id'))
			        ->quantity(1)
			        ->create($request->stripeToken);
	        }
        }


        event(new AlertCreated($alert));
        flash('Alerta creada satisfactoriamente.')->success();
        return redirect()->route('alerts.index', ['created' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function show(Alert $alert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function edit(Alert $alert)
    {
        $data = [
            'alert' => $alert
        ];
        return view('dashboard.alerts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreAlertRequest  $request
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAlertRequest $request, Alert $alert)
    {
        $alert->update($request->all());
        flash('Alerta actualizada.')->success();
        return redirect()->route('alerts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alert $alert)
    {
        event(new AlertDeleted($alert));
        $alert->delete();
        $user = Auth::user();
        if ($user->subscribed('main')) {
            $user->subscription('main')->updateQuantity(BillingService::billableAlertsCount($user));
        }
        flash('Alerta borrada.')->success();
        return redirect()->route('alerts.index');
    }
}
