<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivoConjugadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivos_conjugados', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('id_afericao');
            $table->float('area_pivo_01')->nullable();
            $table->float('area_pivo_02')->nullable();
            $table->float('area_pivo_03')->nullable();
            $table->float('area_pivo_04')->nullable();
            $table->float('vazao_pivo_01')->nullable();
            $table->float('vazao_pivo_02')->nullable();
            $table->float('vazao_pivo_03')->nullable();
            $table->float('vazao_pivo_04')->nullable();

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
        Schema::dropIfExists('pivos_conjugados');
    }
}
