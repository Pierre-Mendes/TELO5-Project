<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregaTecnica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrega_tecnica', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_tecnico')->foreing('id_tecnico')->references('id')->on('users');
            $table->bigInteger('id_fazenda')->foreign('id_fazenda')->references('id')->on('fazendas');
            $table->bigInteger('id_revenda')->foreign('id_revenda')->references('id')->on('revendas');
            $table->string('numero_pedido', 10)->nullable();
            $table->string('numero_serie', 20)->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
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
        Schema::dropIfExists('entrega_tecnica');
    }
}
