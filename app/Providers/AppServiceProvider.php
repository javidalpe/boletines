<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Schema;
use Stripe\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        set_time_limit(3600 * 3);
        Schema::defaultStringLength(191);
        setlocale(LC_TIME, 'es_ES.utf8');
        setlocale(LC_MONETARY, 'es_ES.utf8');
        Stripe::setApiKey(config('services.stripe.secret'));

	    if($this->app->environment('production')) {
		    \URL::forceScheme('https');
	    }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    Cashier::ignoreMigrations();
    }
}
