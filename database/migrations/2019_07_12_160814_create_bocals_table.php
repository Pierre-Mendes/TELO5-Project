<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bocais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fabricante');
            $table->string('nome');
            $table->float('vazao', 8, 2);
            $table->float('intervalo_trabalho', 8, 2);
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
        Schema::dropIfExists('bocais');
    }
}
