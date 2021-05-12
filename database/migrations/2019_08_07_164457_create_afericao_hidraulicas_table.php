<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfericaoHidraulicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afericao_hidraulicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_afericao');
            $table->float('pressao_centro');
            $table->float('pressao_ponta');
            $table->float('rugosidade');
            $table->integer('altitude_centro');
            $table->integer('altitude_mais_alto');
            $table->float('latitude', 10,6);
            $table->float('longitude', 10,6);
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
        Schema::dropIfExists('afericao_hidraulicas');
    }
}
