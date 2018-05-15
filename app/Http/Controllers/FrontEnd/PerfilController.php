<?php

namespace App\Http\Controllers\FrontEnd;

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
			'tipo' => 'required'
		]);

		switch ($request->input('tipo')) {
			case 'correo':
			return $this->updadeCorreo($request);
			break;
			case 'pwd':
			return $this->updatePsw($request);
			break;
			case 'develop':
			return $this->updateDevelop($request);
			break;
			default:
			return redirect()->back();
			break;
		}
	}

	private function updadeCorreo(Request $request){
		$this->validate(request(), [
			'nuevoMail' => 'required|email',
			'confirmPwd' => ['required', new samePassword],
		]);

		$user = Auth::user();
		$user->email = $request->input("nuevoMail");
		$user->save();
		old('tipo', "correo");

		return redirect()->back()->with("success","El correo se ha cambiado con exito.")->withInput($request->old('tipo'));
	}

	private function updatePsw(Request $request){
		$this->validate(request(), [
			'currentPassword' => ['required', new samePassword],
			'newPassword' => 'required|confirmed',
		]);

		$user = Auth::user();
		$user->password = bcrypt($request->get('newPassword'));
		$user->save();

		return redirect()->back()->with("success","La contraseña se ha cambiado con exito.")->withInput($request->old('tipo'));
	}

	private function updateDevelop(Request $request){
		$user = Auth::user();
		if($user->isNormal()){
			$user->rol = "desarrollador";
			$user->save();
			return redirect()->back()->with("success","Has sido ascendido a desarrollador.");
		}
		return redirect()->back();
	}
}
