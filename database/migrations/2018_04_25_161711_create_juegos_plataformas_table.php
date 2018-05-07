<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuegosPlataformasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juegos_plataformas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_juego')->unsigned();
            $table->integer('id_plataforma')->unsigned();

            $table->index('id_juego');
            $table->index('id_plataforma');

            $table->foreign('id_juego')->references('id')->on('juegos');
            $table->foreign('id_plataforma')->references('id')->on('plataformas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('juegos_plataformas');
    }
}
