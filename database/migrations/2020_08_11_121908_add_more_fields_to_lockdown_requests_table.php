<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsToLockdownRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lockdown_requests', function (Blueprint $table) {
            $table->string('status')->after('show_phone')->nullable();
            $table->string('delivery_cost_payer')->after('status')->nullable();
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
            $table->string('status');
            $table->string('delivery_cost_payer');
        });
    }
}
