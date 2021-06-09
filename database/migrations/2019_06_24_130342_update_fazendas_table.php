<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFazendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fazendas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_proprietario');
            $table->unsignedBigInteger('id_consultor');
            $table->foreign('id_proprietario')->references('id')->on('proprietarios');
            $table->foreign('id_consultor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fazendas', function (Blueprint $table) {
            $table->dropForeign(['id_proprietario']);
            $table->dropForeign(['id_consultor']);
        }); 
    }
}
