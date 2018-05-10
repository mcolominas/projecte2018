<?php

namespace App\Http\Controllers;

class Paginado extends Controller
{
	public static function generar(&$consulta, $ruta, $maxElementos, $pagActual, $cantPaginado){
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
					 "url" => route($ruta, ['pag' => 1]),
					 "desactivado" => ($pagActual <= 1)],
				  "anterior" =>
				  	 ["signo" => "<",
					 "url" => route($ruta, ['pag' => $anteriorPag]),
					 "desactivado" => !$activeAnteriorPag ], 
				  "paginas" => [],
				  "siguiente" =>
				  	 ["signo" => ">",
					 "url" => route($ruta, ['pag' => $siguientePag]),
					 "desactivado" => !$activeSiguientePag ],
				  "ultima" => 
					["signo" => ">>", 
					 "url" => route($ruta, ['pag' => $ultimaPag]),
					 "desactivado" => ($pagActual >= $ultimaPag)]];
		$a = "";
		for($i = $minPag; $i <= $maxPag; $i++){
			$a .= "a";
			$datos["paginas"][] = [ "signo" => $i, 
									"url" => route($ruta, ['pag' => $i]), 
									"activo" => $i == $pagActual];
		}
		
		return $datos;
	}
}
