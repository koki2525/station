<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelStationTable extends Migration
{
    public function up()
    {
        Schema::create('fuel_stations', function (Blueprint $table) {
            $table->id();
            $table->string('scenario');
            $table->integer('ulp93_tank');
            $table->integer('ulp95_tank');
            $table->integer('diesel_tank');
            $table->integer('ulp93_demand');
            $table->integer('ulp95_demand');
            $table->integer('diesel_demand');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fuel_stations');
    }
}
