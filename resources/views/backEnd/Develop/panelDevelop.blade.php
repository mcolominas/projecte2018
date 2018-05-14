@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/backEnd/Develop/develop.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('title')
{{ config('app.name', 'Game World') }} - Inicio
@stop


@section('content')

<div class="row">
	<div>
		<a href="#" class="btn btn-dark ml-3" type="button"> Añadir Juego Nuevo</a>
	</div>
	<div id="tabla" class="col-12 mt-3">
		<table class="table table-bordered" id="dataTable" cellspacing="0">
              <thead class="thead-dark">
                <tr>
                  <th>Titulo</th>
                  <th>Fecha de Creación</th>
                  <th>Acciones</th>
                </tr>
              </thead>
            
              <tbody>
                <tr>
                  <td>Tetris</td>
                  <td>1/1/1111</td>
                  <td><a id="edit" href="#">Editar <i class="far fa-edit"></i></a> | <a  id="drop" href="#">Eliminar <i class="fas fa-trash-alt"></i></a></td>
                  
                </tr>

                 <tr>
                  <td>Snake</td>
                  <td>2/2/2222</td>
                  <td><a id="edit" href="#">Editar <i class="far fa-edit"></i></a> | <a  id="drop" href="#">Eliminar <i class="fas fa-trash-alt"></i></a></td>
                  
                </tr>

                 <tr>
                  <td>Arkanoid</td>
                  <td>3/3/3333</td>
                  <td><a id="edit" href="#">Editar <i class="far fa-edit"></i></a> | <a  id="drop" href="#">Eliminar <i class="fas fa-trash-alt"></i></a></td>
                  
                </tr>

              </tbody>
            </table>
	</div>
</div>

@stop