<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_locations', function (Blueprint $table) {
            $table->id();
            $table->integer('request_id')->nullable();
            $table->integer('provider_id')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->string('api_state')->nullable();
            $table->string('api_city')->nullable();
            $table->string('api_delivery_town')->nullable();
            $table->string('providerAddress')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_locations');
    }
}
