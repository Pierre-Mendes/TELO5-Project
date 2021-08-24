<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichaTecnicaRedimenPercTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_tecnica_redimen_perc', function (Blueprint $table) {
            $table->unsignedBigInteger('percentimetro');
            $table->unsignedBigInteger('id_ficha_tecnica')->foreing('id_ficha_tecnica')->references('id')->on('ficha_tecnica');
            $table->double('projeto', 8,2)->nullable();
            $table->double('medida', 8,2)->nullable();
            $table->double('variacao', 8,2)->nullable();
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
        Schema::dropIfExists('ficha_tecnica_redimen_perc');
    }
}
