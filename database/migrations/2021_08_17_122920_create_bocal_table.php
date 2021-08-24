<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBocalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bocal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('marca');
            $table->string('modelo');
            $table->integer('plug');
            $table->tinyInteger('tipo');
            $table->integer('pressao_psi');
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
        Schema::dropIfExists('bocal');
    }
}
