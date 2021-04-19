<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsMapaOriginals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mapa_originals', function (Blueprint $table) {
            $table->unsignedBigInteger('id_afericao');
            $table->unsignedBigInteger('id_emissor')->foreign('id_emissor')->references('id')->on('emissores');
            $table->unsignedBigInteger('id_usuario')->foreign('id_usuario')->references('id')->on('users');
            $table->integer('posicao_emissor');
            $table->float('vazao_aspersor', 10,4);
            $table->float('vazao_liberada', 10,4);
            $table->float('pressao_entrada', 10, 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mapa_originals', function (Blueprint $table) {
            $table->dropColumn('numero_lance');
            $table->dropColumn('id_emisssor');
            $table->dropColumn('posicao_emissor');
            $table->dropColumn('vazao_aspersor');
            $table->dropColumn('vazao_liberada');
            $table->dropColumn('pressao_entrada');
            $table->dropForeign(['id_usuario']);
            $table->dropForeign(['id_emissor']);
        });
    }
}
