<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmissorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emissores', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('numero');
            $table->float('saida_1');
            $table->float('saida_2');
            $table->float('espacamento');
            $table->float('diametro');
            $table->string('emissor');
            $table->string('tipo_valvula');
            $table->integer('psi');
            $table->bigInteger('id_lance')->foreign('id_lance')->references('id')->on('lances');

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
        Schema::dropIfExists('emissores');
    }
}
