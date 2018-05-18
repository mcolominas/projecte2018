<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_juego')->unsigned();
            $table->string('nombre', 30);
            $table->string('descripcion');
            $table->string('img');
            $table->integer('coins')->default(0);
            $table->integer('tiempo_minimo')->unsigned();
            $table->integer('tiempo_maximo')->unsigned();
            $table->string('hash', 32)->unique();
            $table->enum('estado', ['pendiente','aceptado','rechazado'])->default("pendiente");
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
        Schema::dropIfExists('logros');
    }
}
