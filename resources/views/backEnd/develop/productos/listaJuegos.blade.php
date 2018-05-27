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
	<div class="col-12 mt-3 col-md-10 offset-md-1">

    @if(count($juegos)>0)
    <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
      <thead class="thead-dark">
        <tr>
          <th>Nombre</th>
          <th>Fecha de Creación</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($juegos as $juego)
        <tr>
          <td>{{ $juego->nombre }}</td>
          <td>{{ $juego->created_at }}</td>
          <td><a id="edit" href="{{route('desarrollador.verProductos',['slugJuego' => $juego->slug])}}">Ir <i class="fas fa-arrow-alt-circle-right"></i></a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
      <p class="text-center">No tienes juegos, clica <a href="{{route('desarrollador.crearJuego')}}">aquí</a> para crear uno.</p>
    @endif
  </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
  $("#dataTable").DataTable();
</script>
@stop