<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsToRequestBiddersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_bidders', function (Blueprint $table) {
            $table->string('payment_type')->after('pickup_status')->nullable();
            $table->string('weight')->after('payment_type')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_bidders', function (Blueprint $table) {
         Schema::dropIfExists('payment_type');
         Schema::dropIfExists('weight');
        });
    }
}
