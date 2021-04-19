<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdutorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adutoras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->unsignedBigInteger('id_usuario')->foreign('id_usuario')->references('id')->on('users');
            $table->unsignedBigInteger('id_afericao')->foreign('id_afericao')->references('id')->on('afericoes');
            $table->integer('altitude_nivel_agua');
            $table->integer('pendente')->default(1);
            $table->integer('altitude_casa_bomba');
            $table->integer('tipo_instalacao');
            $table->integer('posicionamento_bombeamento');
            $table->integer('captacao');
            $table->integer('numero_bombas');
            $table->double('latitude', 8,6);
            $table->double('longitude', 8,6);
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
        Schema::dropIfExists('adutoras');
    }
}
