<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestBiddersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_bidders', function (Blueprint $table) {
            $table->id();
            $table->integer('request_id')->nullable();
            $table->integer('requester_id')->nullable();
            $table->integer('bidder_id')->nullable();
            $table->integer('logistic_partner_id')->nullable();
            $table->string('request_type')->nullable();
            $table->string('status')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->decimal('delievery_cost',20,2)->nullable();
            $table->text('comment')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('request_bidders');
    }
}
