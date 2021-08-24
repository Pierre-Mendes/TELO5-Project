<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlturaSuccaoBombeamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bombeamentos', function (Blueprint $table) {
            //
            $table->double('altura_succao', 8,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bombeamentos', function (Blueprint $table) {
            //
            $table->double('altura_succao', 8,2);
        });
    }
}
