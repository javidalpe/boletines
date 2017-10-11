<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserRegistered' => [
            'App\Listeners\UserRegisteredEventListener',
        ],
        'Illuminate\Auth\Events\PasswordReset' => [
            'App\Listeners\PasswordResetEventListener',
        ],
        'App\Events\AlertCreated' => [
            'App\Listeners\AlertCreatedEventListener',
        ],
        'App\Events\AlertDeleted' => [
            'App\Listeners\AlertDeletedEventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
