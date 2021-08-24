<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBalancoFichaTecnica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ficha_tecnica', function (Blueprint $table) {
            $table->double('balanco', 8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ficha_tecnica', function (Blueprint $table) {
            $table->double('balanco', 8,2)->nullable();
        });
    }
}
