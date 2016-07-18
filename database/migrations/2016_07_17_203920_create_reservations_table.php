<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('start');
            $table->integer('end');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('stablishment_id')->unsigned();
            $table->foreign('stablishment_id')->references('id')->on('stablishments');
            $table->integer('commodity_id')->unsigned();
            $table->foreign('commodity_id')->references('id')->on('commodities');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('reservations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
