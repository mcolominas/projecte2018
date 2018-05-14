<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Juego;
use App\Models\User;

class MainController extends Controller
{
    protected function index(){
    	//Test relaciones
    	//$l = Juego::where("id", "1")->firstOrFail()->addComentarios();

    	/*$l = User::where("id", 1)->firstOrFail()->logros->each(function ($model){
    		$model->juego->desarrollador;
    		$model->juego->categorias;
    		$model->juego->plataformas;
    		$model->juego->addComentarios();
    	});*/
    	//die(json_encode($l));
        return view('backEnd/Develop/panelDevelop');
    }

}
