<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsLaminaMapaOriginal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mapa_originals', function (Blueprint $table) {
            $table->float('lamina_aplicada', 10,4);
            $table->float('lamina_media', 10,4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mapa_originals', function (Blueprint $table) {
            $table->dropColumn('lamina_aplicada');
            $table->dropColumn('lamina_media');
        });
    }
}
