<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMakeIdAutoincrementCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
                if (Schema::hasColumn('categories', 'id'))
            {
            Schema::table('categories', function (Blueprint $table)
            {
               $table->dropColumn('id');
            });
        }
              $table->bigIncrements('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
             Schema::dropIfExists('categories');
        });
    }
}
