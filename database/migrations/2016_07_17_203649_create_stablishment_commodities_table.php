<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStablishmentCommoditiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stablishment_commodities', function (Blueprint $table) {
          $table->integer('stablishment_id')->unsigned();
          $table->foreign('stablishment_id')->references('id')->on('stablishments')->onDelete('cascade');
          $table->integer('commodity_id')->unsigned();
          $table->foreign('commodity_id')->references('id')->on('commodities')->onDelete('cascade');
          $table->integer('slots');
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
        Schema::drop('stablishment_commodities');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
