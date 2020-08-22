<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickup_requests', function (Blueprint $table) {
            $table->id();
            $table->string('TransStatus')->nullable();
            $table->string('TransStatusDetails')->nullable();
            $table->string('OrderNo')->nullable();
            $table->string('WaybillNumber')->nullable();
            $table->string('DeliveryFee')->nullable();
            $table->string('VatAmount')->nullable();
            $table->string('TotalAmount')->nullable();
            $table->string('Description')->nullable();
            $table->string('Weight')->nullable();
            $table->string('SenderName')->nullable();
            $table->string('SenderCity')->nullable();
            $table->string('SenderTownID')->nullable();
            $table->string('SenderAddress')->nullable();
            $table->string('SenderPhone')->nullable();
            $table->string('SenderEmail')->nullable();
            $table->string('RecipientName')->nullable();
            $table->string('RecipientCity')->nullable();
            $table->string('RecipientTownID')->nullable();
            $table->string('RecipientAddress')->nullable();
            $table->string('RecipientPhone')->nullable();
            $table->string('RecipientEmail')->nullable();
            $table->string('PaymentType')->nullable();
            $table->string('DeliveryType')->nullable();
            $table->integer('request_id')->nullable();
            $table->integer('provider_id')->nullable();
            $table->integer('receiver_id')->nullable();
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
        Schema::dropIfExists('pickup_requests');
    }
}
