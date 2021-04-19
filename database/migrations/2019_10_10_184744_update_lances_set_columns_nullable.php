<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLancesSetColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lances', function (Blueprint $table) {
            $table->integer('numero_tubos')->nullable()->change();
            $table->integer('numero_emissores')->nullable()->change();
            $table->float('diametro')->nullable()->change();
            $table->integer('valvula_reguladora')->nullable()->change();
            $table->float('comprimento')->nullable()->change();
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
            $table->integer('numero_tubos')->change();
            $table->integer('numero_emissores')->change();
            $table->float('diametro')->change();
            $table->integer('valvula_reguladora')->change();
            $table->float('comprimento')->change();
        });
    }
}
