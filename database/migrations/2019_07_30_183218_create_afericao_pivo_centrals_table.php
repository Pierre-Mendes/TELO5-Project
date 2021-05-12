<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfericaoPivoCentralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afericoes_pivos_centrais', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('id_fazenda')->foreign('id_fazenda')->references('id')->on('fazendas');
            $table->date('data_afericao');
            $table->float('tempo_funcionamento');
            $table->string('horimetro')->nullable();
            $table->bigInteger('marca_modelo_pivo');
            $table->string('ano_montagem')->nullable();
            $table->integer('giro_equipamento');
            $table->string('tipo_painel')->nullable();
            $table->float('lamina_anual');
            $table->float('custo_medio');
            $table->string('marca_modelo_emissores');
            $table->string('rodado');
            $table->string('revestimento');
            $table->string('pendural')->nullable();
            $table->string('modelo_equipamento')->nullable();
            $table->string('defletor')->nullable();
            $table->float('altura_pivo');
            $table->string('valv_reguladoras');
            $table->float('altura_emissores');
            $table->integer('numero_lances');
            
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
        Schema::dropIfExists('afericoes_pivos_centrais');
    }
}
