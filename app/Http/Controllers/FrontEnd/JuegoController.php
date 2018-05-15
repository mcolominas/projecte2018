<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JuegoController extends Controller
{
    //
    protected function index(){
    	return view('frontEnd/juego');
    }

    protected function crear(){
    	return view('frontEnd/juego');
    }
}
