<?php

namespace App\Http\Controllers\BackEnd\Desarrollador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Juego;

class JuegosController extends Controller
{
    protected function getList(Request $request){
    	$user = Auth::user();
    	$juegos = Juego::where("id_creador", $user->id)->orderBy("created_at")->get();
    	return view('backEnd/develop/juegos/lista', ["juegos" => $juegos]);
    }

    protected function getCrear(Request $request){
    	return view('backEnd/develop/juegos/edicion');
    }

    protected function postCrear(Request $request){
    	return view('backEnd/develop/juegos/edicion');
    }

    protected function getEditar(Request $request){
    	return view('backEnd/develop/juegos/edicion');
    }

    protected function putEditar(Request $request){
    	return view('backEnd/develop/juegos/edicion');
    }

    protected function deleteJuego(Request $request){
    	return view('backEnd/develop/juegos/edicion');
    }

}
