<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichaTecnicaFuncioPivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_tecnica_funcio_pivo', function (Blueprint $table) {
            $table->unsignedBigInteger('velocidade');
            $table->unsignedBigInteger('id_ficha_tecnica')->foreing('id_ficha_tecnica')->references('id')->on('ficha_tecnica');
            $table->string('volta', 255)->nullable();
            $table->string('volta_1_meio', 255)->nullable();
            $table->string('volta_1_quarto', 255)->nullable();
            $table->double('lamina', 8,2)->nullable();
            $table->double('estimativa_custo_eletrico', 8,2)->nullable();
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
        Schema::dropIfExists('ficha_tecnica_funcio_pivo');
    }
}
