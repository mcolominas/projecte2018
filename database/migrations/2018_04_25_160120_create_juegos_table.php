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
            $table->string('nombre', 30);
            $table->longText('descripcion');
            $table->string('img')->nullable();
            $table->string('slug', 30)->unique();
            $table->string('url')->nullable();
            $table->boolean('visible');
            $table->integer('visitas')->unsigned()->default(0);
            $table->string('hash', 32)->unique();
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
