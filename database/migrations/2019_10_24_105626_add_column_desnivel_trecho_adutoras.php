<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDesnivelTrechoAdutoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trechos_adutoras', function (Blueprint $table) {
            $table->double('desnivel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('trechos_adutoras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();

            $table->unsignedBigInteger('id_adutora')->foreign('id_afericao')->references('id')->on('adutoras');            
            $table->integer('tipo_cano');
            $table->double('diametro', 10,4);
            $table->double('coeficiente_hw', 8,2);
            $table->integer('numero_canos');
            $table->double('comprimento', 8,2);
            $table->integer('altitude');
            $table->double('latitude', 8,6);
            $table->double('longitude', 8,6);

            $table->timestamps();
        });
    }
}
