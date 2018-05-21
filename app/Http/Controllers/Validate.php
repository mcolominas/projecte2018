<?php

namespace App\Http\Controllers;

class Validate
{
	public static function validate($var, $name, $validateParams, &$errors){
		if($var !== null && is_array($var)){
			foreach ($var as $value) {
				Validate::validate($value, $name, $validateParams, $errors);
			}
		}else{
			$validateParams = explode(",", $validateParams);
			foreach ($validateParams as $value) {
				$value = explode(":", $value);
				switch ($value[0]) {
					case 'required':
					if($var === null || $var === "") $errors[$name][] = "El campo es obligatorio.";
					break;
					case 'maxLength':
					if($var === null) break;
					if(strlen($var) > $value[1]) $errors[$name][] = "El texto es muy largo, el maximo es: ". $value[1];
					break;
					case 'isNumeric':
					if($var === null) break;
					if(!is_numeric($var)) $errors[$name][] = "El valor no es numerico.";
					break;
					case 'isBool':
					if($var === null) break;
					if(!is_bool($var)) $errors[$name][] = "El valor no es boleano.";
					break;
					case 'imgValidFormat':
					if($var === null) break;
					$e = strtolower($var->extension());
					if($e != "png" && $e != "jpg" && $e != "jpeg") $errors[$name][] = "Solo se aceptan los formatos: png, jpg, jpeg.";
					break;
				}
			}
		}
	}
}