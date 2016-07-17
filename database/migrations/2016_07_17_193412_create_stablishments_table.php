<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('stablishments', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('city');
          $table->string('address');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      Schema::drop('stablishments');
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
