<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComposicaoParteAereaFichaTecnica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ficha_tecnica', function (Blueprint $table) {
            $table->string('composicao_parte_aerea', 255)->nullable();
            $table->double('area_total', 10,2)->nullable();
            $table->double('raio_irrigado', 8,2)->nullable();
            $table->double('vazao_total', 8,2)->nullable();
            $table->double('uniformidade_aplicacao', 8,2)->nullable();
            $table->double('raio_ultima_torre', 8,2)->nullable();
            $table->double('tamanho_balanco', 8,2)->nullable();
            $table->double('velocidade_a_100', 8,2)->nullable();
            $table->double('tempo_a_100', 8,2)->nullable();
            $table->double('alcance_canhao', 8,2)->nullable();
            $table->double('altura_emissores', 8,2)->nullable();
            $table->double('lamina_anual', 8,2)->nullable();
            $table->double('lamina_diaria', 8,2)->nullable();
            $table->double('lamina_conjugada', 8,2)->nullable();
            $table->double('desnivel_centro_ao_ponto_mais_alto', 8,2)->nullable();
            $table->double('perda_carga_parte_aerea', 8,2)->nullable();
            $table->double('desnivel_motobomba', 8,2)->nullable();
            $table->double('perda_carga_total_adutora', 8,2)->nullable();
            $table->double('pressao_ponta', 8,2)->nullable();
            $table->double('altura_manometrica', 8,2)->nullable();
            $table->double('potencia_total_sistema', 8,2)->nullable();
            $table->double('consumo_eletrico_anual', 8,2)->nullable();
            $table->double('custo_eletrico', 12,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ficha_tecnica', function (Blueprint $table) {
            $table->string('composicao_parte_aerea', 255)->nullable();
            $table->double('area_total', 10,2)->nullable();
            $table->double('raio_irrigado', 8,2)->nullable();
            $table->double('vazao_total', 8,2)->nullable();
            $table->double('uniformidade_aplicacao', 8,2)->nullable();
            $table->double('raio_ultima_torre', 8,2)->nullable();
            $table->double('tamanho_balanco', 8,2)->nullable();
            $table->double('velocidade_a_100', 8,2)->nullable();
            $table->double('tempo_a_100', 8,2)->nullable();
            $table->double('alcance_canhao', 8,2)->nullable();
            $table->double('altura_emissores', 8,2)->nullable();
            $table->double('lamina_anual', 8,2)->nullable();
            $table->double('lamina_diaria', 8,2)->nullable();
            $table->double('lamina_conjugada', 8,2)->nullable();
            $table->double('desnivel_centro_ao_ponto_mais_alto', 8,2)->nullable();
            $table->double('perda_carga_parte_aerea', 8,2)->nullable();
            $table->double('desnivel_motobomba', 8,2)->nullable();
            $table->double('perda_carga_total_adutora', 8,2)->nullable();
            $table->double('pressao_ponta', 8,2)->nullable();
            $table->double('altura_manometrica', 8,2)->nullable();
            $table->double('potencia_total_sistema', 8,2)->nullable();
            $table->double('consumo_eletrico_anual', 8,2)->nullable();
            $table->double('custo_eletrico', 12,2)->nullable();
        });
    }
}
