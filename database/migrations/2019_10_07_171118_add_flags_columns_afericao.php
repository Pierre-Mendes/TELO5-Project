<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlagsColumnsAfericao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afericoes_pivos_centrais', function (Blueprint $table) {
            $table->dropColumn('pendente');
            $table->integer('mapa_bocais_pendente')->default(1);
            $table->integer('adutora_pendente')->default(1);
            $table->integer('bombeamento_pendente')->default(1);
            $table->integer('velocidade_pendente')->default(1);
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
            $table->integer('pendente');
            $table->dropColumn('mapa_bocais_pendente');
            $table->dropColumn('adutora_pendente');
            $table->dropColumn('bombeamento_pendente');
            $table->dropColumn('velocidade_pendente');
        });
    }
}
