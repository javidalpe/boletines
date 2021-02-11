<?php

namespace App\Console\Commands;

use App\Services\Billing\BillingService;
use App\User;
use Illuminate\Console\Command;

class RemoveAlertsFromCanceledSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update users based on subscriptions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
	    /**
	     * @var $usersCancelled User[]
	     */
	    $usersCancelled = User::whereHas('subscriptions', function ($query) {
		    $query->where('stripe_status', '=', 'canceled');
	    })->get();

	    foreach ($usersCancelled as $user) {
	    	$billableAlertsCount = BillingService::billableAlertsCount($user);

	    	if ($billableAlertsCount > 0) {
			    $user->alerts()->take($billableAlertsCount)->delete();
		    }
	    }

        return 0;
    }
}
