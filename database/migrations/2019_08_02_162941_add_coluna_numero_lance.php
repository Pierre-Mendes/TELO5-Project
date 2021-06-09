<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColunaNumeroLance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lances', function (Blueprint $table) {
            $table->integer('numero_lance');
            $table->unsignedBigInteger('id_afericao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lances', function (Blueprint $table) {
            $table->dropColumn('numero_lance');
            $table->dropColumn('id_afericao');
        });
    }
}
