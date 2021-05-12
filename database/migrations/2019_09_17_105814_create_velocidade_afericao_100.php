<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVelocidadeAfericao100 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('velocidade_afericao_100', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_afericao');
            $table->integer('minuto01');
            $table->double('segundo01');
            $table->double('distancia01');
            $table->integer('minuto02');
            $table->double('segundo02');
            $table->double('distancia02');
            $table->integer('minuto03');
            $table->double('segundo03');
            $table->double('distancia03');
            $table->integer('minuto04')->nullable();
            $table->double('segundo04')->nullable();
            $table->double('distancia04')->nullable();
            $table->integer('nao_aferiu');

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
        Schema::dropIfExists('velocidade_afericao_100');
    }
}
