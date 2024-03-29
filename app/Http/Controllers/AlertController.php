<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Events\AlertCreated;
use App\Events\AlertDeleted;
use App\Http\Requests\StoreAlertRequest;
use App\Services\Alerts\AlertsCheckService;
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
            'alerts' => $user->alerts()->with('publication')->get(),
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
	    flash("No se permite crear nuevas alertas. Nuestro servicio de alertas dejará de estar disponible próximamente.")->warning();
	    return back();

        if (!Auth::user()->can('create', Alert::class)) {
            flash("Has superado el límite de alertas permitido.")->warning();
            return back();
        }

        $user = Auth::user();
        $alertCount = $user->alerts()->count();
	    $shouldUserPayForNewAlert = BillingService::shouldUserPayForNewAlert($user);
	    $publications = AlertsCheckService::getPublicationsSearchOptions();

	    $data = [
	    	'user'     => $user,
        	'shouldPay' => $shouldUserPayForNewAlert,
	        'intent' => $shouldUserPayForNewAlert ? $user->createSetupIntent():null,
	        'alertsCount' => $alertCount,
		    'publications' => $publications,
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
			        ->trialDays(30)
			        ->quantity(1)
			        ->create($request->paymentMethod);
	        }
        }


        event(new AlertCreated($alert));
        flash('Alerta creada satisfactoriamente.')->success();
        return redirect()->route('conversion');
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
	    $publications = AlertsCheckService::getPublicationsSearchOptions();
        $data = [
            'alert' => $alert,
	        'publications' => $publications
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
