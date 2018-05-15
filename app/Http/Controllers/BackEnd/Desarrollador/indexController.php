<?php

namespace App\Http\Controllers\BackEnd\Desarrollador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    protected function index(){
    	return view('backEnd/Develop/index');
    }
}
