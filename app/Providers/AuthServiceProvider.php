<?php

namespace App\Providers;

use App\Alert;
use App\Policies\AlertPolicy;
use App\Policies\WebhookPolicy;
use App\Webhook;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Alert::class => AlertPolicy::class,
        Webhook::class => WebhookPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
