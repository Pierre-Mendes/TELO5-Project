<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoRedimensionamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_redimensionamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_afericao_original')->foreign('id_afericao')->references('id')->on('afericoes_pivos_centrais');            
            $table->unsignedBigInteger('id_afericao_redimensionamento')->foreign('id_redimensionamento')->references('id')->on('afericoes_pivos_centrais');            
            $table->float('vazao_total', 10,3);
            $table->integer('num_lances_c_plug');
            $table->integer('num_emissores_c_plug_inicio');
            $table->float('espacamento_maximo_plug', 6,3);
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
        Schema::dropIfExists('info_redimensionamentos');
    }
}
