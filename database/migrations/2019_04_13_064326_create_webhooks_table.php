<?php

use App\Webhook;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebhooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webhooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();

            $table->string('url', 512);
            $table->enum('status', [Webhook::STATUS_OK, Webhook::STATUS_WARNING, Webhook::STATUS_ERROR])->default
            (Webhook::STATUS_OK);

            $table->dateTime('last_request_at')->nullable();
            $table->integer('last_request_code')->nullable();
            $table->text('last_request_response')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webhooks');
    }
}
