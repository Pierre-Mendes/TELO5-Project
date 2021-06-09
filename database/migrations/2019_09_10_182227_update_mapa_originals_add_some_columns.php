<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMapaOriginalsAddSomeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mapa_originals', function (Blueprint $table) {
            $table->float('area_aspersor',10,4);
            $table->float('area_acumulada',10,4);
            $table->float('vazao_spray_requerida',10,4);
            $table->float('q_bocal_1',10,4);
            $table->float('q_bocal_2',10,4);
            $table->float('comprimento',10,4);
            $table->float('q_max_valvula',10,4);
            $table->float('vazao_sprays_teorica',10,4);
            $table->float('vazao_sprays_real',10,4);
            $table->float('velocidade',10,4);
            $table->float('perda_carga_teorica',10,4);
            $table->float('perda_carga_real',10,4);
            $table->float('perda_pressao_acumulada_real',10,4);
            $table->float('pressao_saida',10,4);
            $table->float('aai',10,4);
            $table->float('si',10,4);
            $table->float('li',10,4);
            $table->float('li_si',10,4);
            $table->float('desvios',10,4);
            $table->float('si_desvios',10,4);
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
            $table->dropColumn('area_aspersor');
            $table->dropColumn('area_acumulada');
            $table->dropColumn('vazao_spray_requerida');
            $table->dropColumn('q_bocal_1');
            $table->dropColumn('q_bocal_2');
            $table->dropColumn('comprimento');
            $table->dropColumn('q_max_valvula');
            $table->dropColumn('vazao_sprays_teorica');
            $table->dropColumn('vazao_sprays_real');
            $table->dropColumn('velocidade');
            $table->dropColumn('perda_carga_teorica');
            $table->dropColumn('perda_carga_real');
            $table->dropColumn('perda_pressao_acumulada_real');
            $table->dropColumn('pressao_saida');
            $table->dropColumn('aai');
            $table->dropColumn('si');
            $table->dropColumn('li');
            $table->dropColumn('li_si');
            $table->dropColumn('desvios');
            $table->dropColumn('si_desvios');
        });
    }
}
