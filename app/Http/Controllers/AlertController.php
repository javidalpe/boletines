<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Http\Requests\StoreAlertRequest;
use Auth;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = [
            'alerts' => $user->alerts
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
        return view('dashboard.alerts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAlertRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlertRequest $request)
    {
        Auth::user()->alerts()->create($request->all());
        return redirect()->route('alerts.index');
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
        $alert->delete();
        return redirect()->route('alerts.index');
    }
}
