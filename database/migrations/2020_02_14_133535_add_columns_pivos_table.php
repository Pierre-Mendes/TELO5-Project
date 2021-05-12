<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsPivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pivos', function (Blueprint $table) {
            $table->float('saida_1_inicial', 10,4);
            $table->float('saida_2_inicial', 10,4);
            $table->float('saida_3_inicial', 10,4);
            $table->float('saida_1_intermediario', 10,4);
            $table->float('saida_2_intermediario', 10,4);
            $table->float('saida_3_intermediario', 10,4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pivos', function($table) {
            $table->dropColumn('saida_1_inicial');
            $table->dropColumn('saida_2_inicial');
            $table->dropColumn('saida_3_inicial');
            $table->dropColumn('saida_1_intermediario');
            $table->dropColumn('saida_2_intermediario');
            $table->dropColumn('saida_3_intermediario');
        });
    }
}
