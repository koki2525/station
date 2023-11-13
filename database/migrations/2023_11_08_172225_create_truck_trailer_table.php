<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckTrailerTable extends Migration
{
    public function up()
    {
        Schema::create('truck_trailers', function (Blueprint $table) {
            $table->id();
            $table->integer('truck');
            $table->integer('comp1');
            $table->integer('comp2');
            $table->integer('comp3');
            $table->integer('comp4');
            $table->integer('comp5');
            $table->integer('comp6');
            $table->integer('comp7');
            $table->integer('total');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('truck_trailers');
    }
}
