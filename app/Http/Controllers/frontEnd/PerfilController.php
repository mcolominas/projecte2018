<?php

namespace App\Http\Controllers\frontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\samePassword;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getPerfil(){
        return view('paginas/perfil');
    }

    protected function putDevelop(Request $request){

    }

    protected function postCorreo(Request $request){
    	$this->validate(request(), [
	        'nuevoMail' => 'required|email',
	        'confirmPwd' => ['required', new samePassword],
	    ]);
	    die("as");
    }

    protected function postPsw(Request $request){

    }
}
