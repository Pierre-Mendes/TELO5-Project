<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVelocidadeAfericaoPercentimetro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('velocidade_afericao_percentimetro', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_afericao');
            $table->integer('tipo_movimento');
            $table->integer('minuto_perc_01')->nullable();
            $table->double('segundo_perc_01')->nullable();
            $table->double('distancia_perc_01')->nullable();
            $table->integer('minuto_perc_02')->nullable();
            $table->double('segundo_perc_02')->nullable();
            $table->double('distancia_perc_02')->nullable();
            $table->integer('minuto_perc_03')->nullable();
            $table->double('segundo_perc_03')->nullable();
            $table->double('distancia_perc_03')->nullable();
            $table->integer('minuto_perc_04')->nullable();
            $table->double('segundo_perc_04')->nullable();
            $table->double('distancia_perc_04')->nullable();
            $table->integer('minuto_movi_01')->nullable();
            $table->double('segundo_movi_01')->nullable();
            $table->integer('minuto_parado_01')->nullable();
            $table->double('segundo_parado_01')->nullable();
            $table->integer('minuto_movi_02')->nullable();
            $table->double('segundo_movi_02')->nullable();
            $table->integer('minuto_parado_02')->nullable();
            $table->double('segundo_parado_02')->nullable();
            $table->integer('minuto_movi_03')->nullable();
            $table->double('segundo_movi_03')->nullable();
            $table->integer('minuto_parado_03')->nullable();
            $table->double('segundo_parado_03')->nullable();
            $table->integer('minuto_movi_04')->nullable();
            $table->double('segundo_movi_04')->nullable();
            $table->integer('minuto_parado_04')->nullable();
            $table->double('segundo_parado_04')->nullable();


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
        Schema::dropIfExists('velocidade_afericao_percentimetro');
    }
}
