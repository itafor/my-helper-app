<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApiDeliveryTownIdToLockdownRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lockdown_requests', function (Blueprint $table) {
            $table->integer('api_delivery_town_id')->after('api_delivery_town')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lockdown_requests', function (Blueprint $table) {
            $table->integer('api_delivery_town_id');
        });
    }
}
