<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApiStatesCitiesToLockdownRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lockdown_requests', function (Blueprint $table) {
            $table->string('api_state')->after('street')->nullable();
            $table->string('api_city')->after('api_state')->nullable();
            $table->string('api_delivery_town')->after('api_city')->nullable();
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
          $table->dropColumn('api_state');
          $table->dropColumn('api_city');
          $table->dropColumn('api_delivery_town');
        });
    }
}
