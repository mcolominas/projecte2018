<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Juego;

class JuegoController extends Controller
{
    protected function index(Request $request, $slug){
    	$juego = Juego::where("slug", $slug)->where("visible", 1)->firstOrFail()->getComentarios();
    	$juego->setUrlImagePublic();
    	return view('frontEnd/juego', ["juego" => $juego]);
    }
}
