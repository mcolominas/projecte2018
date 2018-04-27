<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogrosObtenidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logros_obtenidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_logro')->unsigned();
            $table->timestamps();

            $table->index('id_usuario');
            $table->index('id_logro');

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_logro')->references('id')->on('logros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logros_obtenidos');
    }
}
