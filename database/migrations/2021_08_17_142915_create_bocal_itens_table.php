<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBocalItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bocal_itens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_bocal')->foreign('id_bocal')->references('id')->on('bocal');
            $table->string('nome');
            $table->double('vazao', 8, 2);
            $table->double('intervalo_trabalho', 8, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bocal_itens');
    }
}
