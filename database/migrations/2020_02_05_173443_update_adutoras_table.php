<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAdutorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adutoras', function (Blueprint $table) {
            $table->renameColumn('id_adutora', 'id_afericao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adutoras', function (Blueprint $table) {
            $table->renameColumn('id_afericao', 'id_adutora');
        });
    }
}
