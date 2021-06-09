<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnBombeamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bombeamentos', function (Blueprint $table) {
            $table->renameColumn('id_adutora', 'id_bombeamento');
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
            $table->renameColumn('id_bombeamento', 'id_adutora');
        });
    }
}
