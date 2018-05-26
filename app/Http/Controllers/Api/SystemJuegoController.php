<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Juego;
use App\Models\Logro;
use App\Models\Tienda;
use App\Models\UserJugando;
use App\Models\UserLogro;
use App\Models\TiendaUser;

class SystemJuegoController extends Controller
{
	/*
	@method getDatosUser = Obtener datos basicos del usuario que ha iniciado sesion en la pagina web
	@return Array
		opcion1: ["status": 0]
		opcion2: ["status": 1, "datos": ["nombre": String, "coins": Integer]]
	*/
	protected function getDatosUser(Request $request){
		if(!($user = $this->getUser())) return $this->returnError();

		$datos = ["nombre" => $user->name, "coins" => $user->coins];
		return response(json_encode(["status" => "1", "datos" => $datos]), 200)->header('Content-Type', 'application/json');
	}

	/*
	@method iniciarPartida = Inicia la partida de un jugador
	@params hash = String, Hash del juego
	@return Array
		opcion1: ["status": 0]
		opcion2: ["status": 1]
	*/
	protected function iniciarPartida(Request $request){
		if(!($user = $this->getUser())) return $this->returnError();
		
		$hash = $request->input("hash");
		$juego = Juego::where("hash", $hash)->first();

		if(count($juego) != 1) return $this->returnError();

		$partida = new UserJugando();
		$partida->id_usuario = $user->id;
		$partida->id_juego = $juego->id;
		$partida->save();

		return response(json_encode(["status" => "1"]), 200)->header('Content-Type', 'application/json');
	}

	/*
	@method finalizarPartida = Finaliza la partida de un jugador
	@params hash = String, Hash del juego
	@return Array
		opcion1: ["status": 0]
		opcion2: ["status": 1]
	*/
	protected function finalizarPartida(Request $request){
		if(!($user = $this->getUser())) return $this->returnError();
		
		$hash = $request->input("hash");
		$juego = Juego::where("hash", $hash)->first();

		if(count($juego) != 1) return $this->returnError();

		UserJugando::where("id_usuario", $user->id)->where("id_juego", $juego->id)->get()->delete();

		return response(json_encode(["status" => "1"]), 200)->header('Content-Type', 'application/json');
	}

	/*
	@method getLogros = Obtener todos los logros del juego
	@params hash = String, Hash del juego
	@return Array
		opcion1: ["status": 0]
		opcion2: ["status": 1, "logros": ["codigo": String, "consegido": Integer (0|1), "coins": Integer, "descripcion": String, "img": String, "nombre": String]]
	*/
	protected function getLogros(Request $request){
		$user = $this->getUser();
		
		$hash = $request->input("hash");
		$juego = Juego::where("hash", $hash)->first();

		if(count($juego) != 1) return $this->returnError();

		$logros = $juego->logros->where("estado", "aceptado")->each(function($model){
			unset($model->tiempo_minimo);
			unset($model->tiempo_maximo);
			unset($model->estado);
			unset($model->created_at);
			unset($model->updated_at);
			unset($model->hash);
			$model->setUrlImagePublic();
			$model->consegido = 0;
			$model->codigo = $model->slug;
			unset($model->slug);
		});

		if($user){
			$misLogros = Juego::where("hash", $hash)->first()->logros->where("estado", "aceptado");
			foreach ($misLogros as $value){
				if($value->users->where("id", $user->id)->count() == 1){
					foreach ($logros as $logro) {
						if($logro->codigo == $value->slug){
							$logro->consegido = 1;
							break;
						}
					}
				}
			}
		}

		return response(json_encode(["status" => "1", "logros" => $logros]), 200)->header('Content-Type', 'application/json');
	}

	/*
	@method addLogro = Añade 1 logro a un jugador
	@params hash = String, Hash del logro
	@return Array
		opcion1: ["status": 0]
		opcion2: ["status": 1, "codigo": String]
	*/
	protected function addLogro(Request $request){
		if(!($user = $this->getUser())) return $this->returnError();

		$hash = $request->input("hash");
		$logro = Logro::where("hash", $hash)->first();
		if(count($logro) != 1) return $this->returnError(); //Si existe el logro
		if(count(UserLogro::where("id_logro", $logro->id)->where("id_usuario", $user->id)->get()) > 0) return $this->returnError(); //Si no lo ha consegido

		//!!!Check restricciones
		if(!true) return $this->returnError();

		$userLogro = new UserLogro();
		$userLogro->id_usuario = $user->id;
		$userLogro->id_logro = $logro->id;
		$userLogro->save();

		return response(json_encode(["status" => "1", "codigo" => $logro->slug]), 200)->header('Content-Type', 'application/json');
	}

	/*
	@method getProductos = Obtener todos los productos del juego
	@params hash = String, Hash del juego
	@return Array
		opcion1: ["status": 0]
		opcion2: ["status": 1, "logros": ["hash": String, "codigo": String, "consegido": Integer (0|1), "coste": Integer, "descripcion": String, "img": String, "nombre": String]]
	*/
	protected function getProductos(Request $request){
		$user = $this->getUser();
		
		$hash = $request->input("hash");
		$juego = Juego::where("hash", $hash)->first();

		if(count($juego) != 1) return $this->returnError();

		$productos = $juego->productos->each(function($model){
			unset($model->created_at);
			unset($model->updated_at);
			$model->setUrlImagePublic();
			$model->consegido = 0;
			$model->codigo = $model->slug;
			unset($model->slug);
		});

		if($user){
			$misProductos = Juego::where("hash", $hash)->first()->productos;
			foreach ($misProductos as $value){
				if($value->users->where("id", $user->id)->count() == 1){
					foreach ($productos as $producto) {
						if($producto->codigo == $value->slug){
							$producto->consegido = 1;
							break;
						}
					}
				}
			}
		}

		return response(json_encode(["status" => "1", "productos" => $productos]), 200)->header('Content-Type', 'application/json');
	}

	/*
	@method comprar = Añade el producto comprado del jugador
	@params hash = String, Hash del producto
	@return Array
		opcion1: ["status": 0]
		opcion2: ["status": 1]
	*/
	protected function comprar(Request $request){
		if(!($user = $this->getUser())) return $this->returnError();

		$hash = $request->input("hash");
		$producto = Tienda::where("hash", $hash)->first();
		if(count($producto) != 1) return $this->returnError(); //Si existe el producto
		if(($user->coins - $producto->coste) < 0) return $this->returnError(); //Si no el tiene dinero
		if(count(TiendaUser::where("id_tienda", $producto->id)->where("id_user", $user->id)->get()) > 0) return $this->returnError(); //Si no lo tiene comprado
		
		$tiendaUser = new TiendaUser();
		$tiendaUser->id_user = $user->id;
		$tiendaUser->id_tienda = $producto->id;
		$tiendaUser->save();

		return response(json_encode(["status" => "1"]), 200)->header('Content-Type', 'application/json');
	}

	private function getUser(){
		if(!Auth::guest()) return Auth::user();
		return false;
	}

	private function returnError(){
		return response(json_encode(["status" => "0"]), 200)->header('Content-Type', 'application/json');
	}
}
