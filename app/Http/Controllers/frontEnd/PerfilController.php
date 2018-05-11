<?php

namespace App\Http\Controllers\frontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\samePassword;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function getPerfil(){
        return view('frontEnd/perfil');
    }

    protected function putDevelop(Request $request){

    }

    protected function postCorreo(Request $request){
    	$this->validate(request(), [
	        'nuevoMail' => 'required|email',
	        'confirmPwd' => ['required', new samePassword],
	    ]);

	    $user = Auth::user();
	    $user->email = $request->input("nuevoMail");
	    $user->save();

		return redirect()->back()->with("success","El correo se ha cambiado con exito.");
    }

    protected function postPsw(Request $request){
		$this->validate(request(), [
	        'currentPassword' => ['required', new samePassword],
	        'newPassword' => 'required',
	        'newPassword_confirmation' => 'confirmed',
	    ]);

		$user = Auth::user();
	    $user->bcrypt($request->get('newPassword'));
	    $user->save();

	    return redirect()->back()->with("success","La contraseña se ha cambiado con exito.");
    }
}
