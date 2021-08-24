<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumFazendasAltitudeLatitude extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fazendas', function (Blueprint $table) {
            $table->double('latitude', 12,8)->nullable();
            $table->double('longitude', 12,8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fazendas', function (Blueprint $table) {
            $table->double('latitude', 12,8)->nullable();
            $table->double('longitude', 12,8)->nullable();
        });
    }
}
