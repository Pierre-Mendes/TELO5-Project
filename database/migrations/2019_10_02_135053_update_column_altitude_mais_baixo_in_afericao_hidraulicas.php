<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnAltitudeMaisBaixoInAfericaoHidraulicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afericao_hidraulicas', function (Blueprint $table) {
            $table->integer('altitude_mais_baixo')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('afericao_hidraulicas', function (Blueprint $table) {
            $table->integer('altitude_mais_baixo')->change();
        });
    }
}
