<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnsInCanhaoFinalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('canhoes_finais', function (Blueprint $table) {
            $table->float('potencia_canhao_final')->nullable()->change();
            $table->float('bocais_canhao_final')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('canhoes_finais', function (Blueprint $table) {
            $table->float('potencia_canhao_final')->change();
            $table->float('bocais_canhao_final')->change();
        });
    }
}
