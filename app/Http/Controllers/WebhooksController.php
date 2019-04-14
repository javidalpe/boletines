<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Http\Requests\StoreWebhookRequest;
use App\Services\Webhooks\WebhookService;
use App\Webhook;
use Auth;
use Illuminate\Http\Request;

class WebhooksController extends Controller
{

    private $webhookService;

    /**
     * WebhooksController constructor.
     * @param $webhookService
     */
    public function __construct(WebhookService $webhookService)
    {
        $this->authorizeResource(Webhook::class, 'webhook');
        $this->webhookService = $webhookService;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.webhooks.index', ['webhooks' => $user->webhooks]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.webhooks.create');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(Webhook $webhook)
    {
        $results = [[
            'query' => 'oposiciones técnico auxiliar',
            'fragments' => '34',
            'frequency' => Alert::FREQUENCY_DAILY,
            'report' => 'https://www.example.com'
        ]];

        $content = json_encode([
            'alerts' => $results
        ]);

        $this->webhookService->sendToWebhook($webhook, $content);

        flash("Se ha enviado una petición de prueba al webhook.")->success();

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWebhookRequest $request)
    {
        $user = Auth::user();
        $user->webhooks()->create([
            'url' => $request->input('url'),
        ]);

        flash("Webhook registrado correctamente.")->success();

        return redirect()->route('account.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Webhook  $webhook
     * @return \Illuminate\Http\Response
     */
    public function show(Webhook $webhook)
    {
        return view('dashboard.webhooks.show', ['webhook' => $webhook]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Webhook  $webhook
     * @return \Illuminate\Http\Response
     */
    public function edit(Webhook $webhook)
    {
        return view('dashboard.webhooks.edit', ['webhook' => $webhook]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Webhook  $webhook
     * @return \Illuminate\Http\Response
     */
    public function update(StoreWebhookRequest $request, Webhook $webhook)
    {
        $webhook->update(['url' => $request->input('url')]);

        flash("Webhook actualizado correctamente.")->success();

        return redirect()->route('account.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Webhook  $webhook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Webhook $webhook)
    {
        $webhook->delete();

        flash("Webhook borrado correctamente.")->success();

        return redirect()->route('account.index');
    }
}
