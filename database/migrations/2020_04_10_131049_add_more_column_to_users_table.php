<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->after('name')->nullable();
            $table->string('phone')->after('last_name')->nullable();
            $table->string('username')->after('phone')->nullable();
            $table->integer('country_id')->after('username')->nullable();
            $table->integer('state_id')->after('country_id')->nullable();
            $table->integer('city_id')->after('state_id')->nullable();
            $table->string('street')->after('city_id')->nullable();
            $table->string('company_name')->after('street')->nullable();
            $table->string('website')->after('company_name')->nullable();
            $table->integer('user_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('username');
            $table->dropColumn('country_id');
            $table->dropColumn('state_id');
            $table->dropColumn('city_id');
            $table->dropColumn('street');
            $table->dropColumn('company_name');
            $table->dropColumn('website');
            $table->dropColumn('user_type');
        });
    }
}
