<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnIdAfericaoVelocidadeAfericao100 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('velocidade_afericao_100', function($table) {
           $table->dropColumn('id_afericao');
        });
    }

    public function down()
    {
        Schema::table('velocidade_afericao_100', function($table) {
            $table->integer('id_afericao');
        });
    }
}
