<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsAfericaoPivoCentral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afericoes_pivos_centrais', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario')->foreign('id_usuario')->references('id')->on('users');
            $table->string('nome_pivo');
            $table->integer('ativa')->default(1);
            $table->integer('pendente')->default(1);
            $table->string('tem_balanco')->default('nao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('afericoes_pivos_centrais', function (Blueprint $table) {
            $table->dropColumn(['id_usuario']);
            $table->dropColumn('nome_pivo');
            $table->dropColumn('ativa');
            $table->dropColumn('pendente');
            $table->dropColumn('tem_balanco');
        });
    }
}
