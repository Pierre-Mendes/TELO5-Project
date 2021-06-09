<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBombeamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bombeamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            
            $table->unsignedBigInteger('id_adutora')->foreign('id_afericao')->references('id')->on('adutoras');            
            $table->double('comprimento_succao', 8,2);
            $table->double('diametro_succao', 8,2);
            $table->string('marca');
            $table->string('modelo');
            $table->integer('numero_rotores');
            $table->double('diametro_rotor', 8,2);
            $table->integer('material_succao');
            $table->integer('rendimento_bomba');
            $table->double('shutoff', 8,2);
            $table->integer('rotacao');
            $table->double('pressao_bomba', 8,2);
            $table->string('tipo_motor');
            $table->string('modelo_motor');
            $table->double('potencia', 8,2);
            $table->integer('numero_motores');
            $table->integer('chave_partida');
            $table->double('fator_servico', 8,4);
            $table->double('corrente_nominal', 8,2);
            $table->integer('rendimento');
            $table->double('tensao_nominal');
            $table->integer('frequencia');
            $table->double('corrente_leitura_1_fase_1', 8,2);
            $table->double('corrente_leitura_1_fase_2', 8,2);
            $table->double('corrente_leitura_1_fase_3', 8,2);
            $table->double('corrente_leitura_2_fase_1', 8,2)->nullable();
            $table->double('corrente_leitura_2_fase_2', 8,2)->nullable();
            $table->double('corrente_leitura_2_fase_3', 8,2)->nullable();
            $table->double('tensao_leitura_1_fase_1', 8,2);
            $table->double('tensao_leitura_1_fase_2', 8,2);
            $table->double('tensao_leitura_1_fase_3', 8,2);
            $table->double('tensao_leitura_2_fase_1', 8,2)->nullable();
            $table->double('tensao_leitura_2_fase_2', 8,2)->nullable();
            $table->double('tensao_leitura_2_fase_3', 8,2)->nullable();
            
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
        Schema::dropIfExists('bombeamentos');
    }
}
