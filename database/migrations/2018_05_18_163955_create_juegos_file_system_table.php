<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuegosFileSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juegos_file_system', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_juego')->unsigned();
            $table->string('nombre');
            $table->string('ruta');
            $table->string('rutaMin')->nullable();
            $table->enum('tipo', ['html','css','js']);
            $table->integer('order')->unsigned();
            $table->timestamps();
            
            $table->index('id_juego');

            $table->foreign('id_juego')->references('id')->on('juegos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('juegos_file_system');
    }
}
