<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Juego;

class buscadorController extends Controller
{
    protected function index(Request $request){
    	return Juego::select("nombre", "img", "slug")->where("nombre", "like" ,"%".$request->input("query")."%")->get()->each(function($model){
    		$model->img->setUrlImagePublic();
    	})->toJson();
	}
}
