<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichaTecnicaAdutoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_tecnica_adutora', function (Blueprint $table) {
            $table->unsignedBigInteger('trecho_adutora');
            $table->unsignedBigInteger('id_ficha_tecnica')->foreing('id_ficha_tecnica')->references('id')->on('ficha_tecnica');
            $table->double('coeficiente_hf', 8,2)->nullable();
            $table->double('velocidade', 8,2)->nullable();
            $table->double('pressao_inicial', 8,2)->nullable();
            $table->double('pressao_final', 8,2)->nullable();
            $table->double('diametro', 8,2)->nullable();
            $table->double('comprimento', 8,2)->nullable();
            $table->string('material', 255)->nullable();
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
        Schema::dropIfExists('ficha_tecnica_adutora');
    }
}
