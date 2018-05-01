<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuegosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juegos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_creador')->unsigned();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->string('url');
            $table->longText('descripcion');
            $table->timestamps();

            $table->index('id_creador');

            $table->foreign('id_creador')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('juegos');
    }

    public function juegos(){
        return $this->hasMany('App\Juego');
    }
}
