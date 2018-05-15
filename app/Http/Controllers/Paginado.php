<?php

namespace App\Http\Controllers;

class Paginado extends Controller
{
	public static function generar(&$consulta, $maxElementos, $pagActual, $cantPaginado, $url = []){
		$pagActual = (int) $pagActual;

		$cantElementos = $consulta->count();
		$ultimaPag = ceil($cantElementos/$maxElementos);

		if($pagActual < 1) $pagActual = 1;
		if($pagActual > $ultimaPag) $pagActual = $ultimaPag;

		$minPag = $pagActual - $cantPaginado;
		if($minPag < 1){
			$cantPaginado += abs($pagActual - $cantPaginado) + 1;
			$minPag = 1;
		}

		$activeAnteriorPag = $pagActual > 1;
		$anteriorPag = $activeAnteriorPag ? $pagActual - 1 : 1;

		$maxPag = $pagActual + $cantPaginado;
		if($maxPag > $ultimaPag){
			$maxPag = $ultimaPag;
		}

		$activeSiguientePag = $pagActual < $ultimaPag;
		$siguientePag = $activeSiguientePag ? $pagActual + 1 : $ultimaPag;

		$consulta->skip(($pagActual - 1) * $maxElementos)->take($maxElementos);

		$datos = ["primera" => 
					["signo" => "<<", 
					 "url" => call_user_func_array($url, [1]),
					 "desactivado" => ($pagActual <= 1)],
				  "anterior" =>
				  	 ["signo" => "<",
					 "url" => call_user_func_array($url, [$anteriorPag]),
					 "desactivado" => !$activeAnteriorPag ], 
				  "paginas" => [],
				  "siguiente" =>
				  	 ["signo" => ">",
					 "url" => call_user_func_array($url, [$siguientePag]),
					 "desactivado" => !$activeSiguientePag ],
				  "ultima" => 
					["signo" => ">>", 
					 "url" => call_user_func_array($url, [$ultimaPag]),
					 "desactivado" => ($pagActual >= $ultimaPag)]];
		
		for($i = $minPag; $i <= $maxPag; $i++){
			$datos["paginas"][] = [ "signo" => $i, 
									"url" => call_user_func_array($url, [$i]), 
									"activo" => $i == $pagActual];
		}
		
		return $datos;
	}
}
