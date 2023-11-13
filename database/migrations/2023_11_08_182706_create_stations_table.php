<?php

// database/migrations/2023_11_02_create_stations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationsTable extends Migration
{
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->integer('ulp93_capacity');
            $table->integer('ulp95_capacity');
            $table->integer('diesel_capacity');
            $table->integer('ulp93_demand');
            $table->integer('ulp95_demand');
            $table->integer('diesel_demand');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stations');
    }
}
