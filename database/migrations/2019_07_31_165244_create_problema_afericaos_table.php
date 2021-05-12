<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemaAfericaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problemas_afericoes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('id_afericao');
            $table->string('problema_torre_central')->nullable();
            $table->string('problema_valvula_psi')->nullable();
            $table->string('problema_parte_aerea')->nullable();
            $table->string('problema_canhao_final')->nullable();
            $table->string('problema_casa_bomba')->nullable();
            $table->string('problema_adutora')->nullable();
            $table->string('problema_chave_partida')->nullable();
            $table->string('problema_succao')->nullable();
            $table->string('problema_motor_principal')->nullable();
            $table->string('problema_bomba_principal')->nullable();
            $table->string('problema_motor_auxiliar')->nullable();
            $table->string('problema_bomba_auxiliar')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problemas_afericoes');
    }
}
