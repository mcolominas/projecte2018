<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Juego;

class JuegoController extends Controller
{
    protected function index(Request $request, $slug){
    	$juego = Juego::where("slug", $slug)->firstOrFail()->getComentarios()->toArray();
    	return view('frontEnd/juego', ["juego" => $juego]);
    }
}
