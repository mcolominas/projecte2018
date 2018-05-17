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
		<a href="{{ route('desarrollador.crearJuego') }}" class="btn btn-dark ml-3" type="button"> Añadir Juego Nuevo</a>
	</div>
	<div id="tabla" class="col-12 mt-3">

    @if(count($juegos)>0)
    <table class="table table-bordered" id="dataTable" cellspacing="0">
      <thead class="thead-dark">
        <tr>
          <th>Titulo</th>
          <th>Fecha de Creación</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($juegos as $juego)
        <tr>
          <td>{{ $juego->nombre }}</td>
          <td>{{ $juego->created_at }}</td>
          <td><a id="edit" href="#">Editar <i class="far fa-edit"></i></a> | <a  id="drop" href="#">Eliminar <i class="fas fa-trash-alt"></i></a></td>

        </tr>
        @endforeach
      </tbody>
    </table>
    @else
      <p class="text-center">No tienes juegos.</p>
    @endif
  </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
  $("#dataTable").DataTable();
</script>
@stop