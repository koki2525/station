<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockToStationsTable extends Migration
{
    public function up()
    {
        Schema::table('stations', function (Blueprint $table) {
            $table->unsignedInteger('ulp93_stock')->default(0);
            $table->unsignedInteger('ulp95_stock')->default(0);
            $table->unsignedInteger('diesel_stock')->default(0);
            // Add other stock columns if necessary
        });
    }

    public function down()
    {
        Schema::table('stations', function (Blueprint $table) {
            $table->dropColumn(['ulp93_stock', 'ulp95_stock', 'diesel_stock']);
            // Drop other stock columns if added
        });
    }
}
