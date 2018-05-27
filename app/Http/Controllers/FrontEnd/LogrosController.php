<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogrosController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    protected function index(Request $request){
    	$user = Auth::user();
    	$logros = $user->logros;
    	$logros->each(function($model){
    		$model->juego;
    	});
    	
    	return  view('frontEnd/logros', ["logros" => $logros]);
    }
}
