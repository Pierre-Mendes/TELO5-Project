<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnsBombeamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bombeamentos', function (Blueprint $table) {
            $table->float('corrente_nominal')->nullable()->change();
            $table->float('tensao_nominal')->nullable()->change();
            $table->integer('frequencia')->nullable()->change();
            $table->float('corrente_leitura_1_fase_1')->nullable()->change();
            $table->float('corrente_leitura_1_fase_2')->nullable()->change();
            $table->float('corrente_leitura_1_fase_3')->nullable()->change();
            $table->float('tensao_leitura_1_fase_1')->nullable()->change();
            $table->float('tensao_leitura_1_fase_2')->nullable()->change();
            $table->float('tensao_leitura_1_fase_3')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bombeamentos', function (Blueprint $table) {
            $table->float('corrente_nominal')->change();
            $table->float('tensao_nominal')->change();
            $table->integer('frequencia')->change();
            $table->float('corrente_leitura_1_fase_1')->change();
            $table->float('corrente_leitura_1_fase_2')->change();
            $table->float('corrente_leitura_1_fase_3')->change();
            $table->float('tensao_leitura_1_fase_1')->change();
            $table->float('tensao_leitura_1_fase_2')->change();
            $table->float('tensao_leitura_1_fase_3')->change();
        });
    }
}
