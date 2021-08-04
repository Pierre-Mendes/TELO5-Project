<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichaTecnicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_tecnica', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_afericao')->foreing('id_afericao')->references('id')->on('afericoes_pivos_centrais');
            $table->text('txt_observacoes');
            $table->text('txt_uniformidade');
            $table->text('txt_teste_velocidade');
            $table->text('txt_conclusao');
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
        Schema::dropIfExists('ficha_tecnica');
    }
}
