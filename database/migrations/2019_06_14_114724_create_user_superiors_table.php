<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSuperiorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_superiores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

           

        });
        Schema::table('usuario_superiores', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_superior');
            $table->foreign('id_superior')->references('id')->on('users');
            $table->foreign('id_usuario')->references('id')->on('users');
        });
  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_superiores', function (Blueprint $table) {
            $table->dropForeign(['id_superior']);
            $table->dropForeign(['id_usuario']);
        });  
        Schema::dropIfExists('usuario_superiores');
    }
}
