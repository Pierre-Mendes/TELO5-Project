<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanhaoFinalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canhoes_finais', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('id_afericao');
            $table->string('marca_canhao_final')->nullable();
            $table->float('potencia_canhao_final');
            $table->float('vazao_canhao_final');
            $table->string('modelo_canhao_final')->nullable();
            $table->string('bomba_canhao_final')->nullable();
            $table->float('bocais_canhao_final');
            $table->float('alcance_canhao_final');
            $table->string('motor_canhao_final')->nullable();
            $table->string('valv_reguladora_canhao_final');

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
        Schema::dropIfExists('canhoes_finais');
    }
}
