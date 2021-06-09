<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTipoProjetoTbAfericoesPivosCentrais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afericoes_pivos_centrais', function (Blueprint $table) {
            $table->String('tipo_projeto')->default("A");
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
            $table->dropColumn('tipo_projeto');
        });
    }
}
