<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsToShipmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipment_items', function (Blueprint $table) {
            $table->integer('request_id')->after('pickupRequest_id')->nullable();
            $table->integer('provider_id')->after('request_id')->nullable();
            $table->integer('receiver_id')->after('provider_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipment_items', function (Blueprint $table) {
            $table->integer('request_id');
            $table->integer('provider_id');
            $table->integer('receiver_id');
        });
    }
}
