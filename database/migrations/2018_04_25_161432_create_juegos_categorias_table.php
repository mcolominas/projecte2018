<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuegosCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juegos_categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_juego')->unsigned();
            $table->integer('id_categoria')->unsigned();
            $table->timestamps();

            $table->index('id_juego');
            $table->index('id_categoria');

            $table->foreign('id_juego')->references('id')->on('juegos');
            $table->foreign('id_categoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('juegos_categorias');
    }
}
