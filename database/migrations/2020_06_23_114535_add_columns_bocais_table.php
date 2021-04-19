<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsBocaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bocais', function (Blueprint $table) {
            $table->integer('id_fabricante')->constrained('fabricante_bocal');
            $table->integer('plug');
            $table->tinyInteger('tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bocais', function($table) {
            $table->dropColumn('id_fabricante');
            $table->dropColumn('plug');
            $table->dropColumn('tipo');
        });
    }
}
