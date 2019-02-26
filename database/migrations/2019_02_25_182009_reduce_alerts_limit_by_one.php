<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReduceAlertsLimitByOne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::where('id','>',0)->update(['alerts_limit' => DB::raw('alerts_limit-1')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    User::where('id','>',0)->update(['alerts_limit' => DB::raw('alerts_limit+1')]);
    }
}
