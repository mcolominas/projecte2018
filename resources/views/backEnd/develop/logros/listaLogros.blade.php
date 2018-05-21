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
	<div class="col-12">
		<a href="{{ route('desarrollador.crearLogro', ['slugJuego', $slugJuego]) }}" class="btn btn-dark ml-3" type="button">Añadir Logro Nuevo</a>
	</div>
	<div class="col-12 mt-3 col-md-10 offset-md-1">
    @if(count($logros)>0)
    <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
      <thead class="thead-dark">
        <tr>
          <th>Nombre</th>
          <th>Fecha de Creación</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($logros as $logro)
        <tr>
          <td>{{ $logro->nombre }}</td>
          <td>{{ $logro->created_at }}</td>
          <td>
            <a id="edit" href="{{route('desarrollador.editarLogro', ['slugLogro' => $logro->slug])}}">Editar <i class="far fa-edit"></i></a>
             | 
             <a id="drop" href="{{route('desarrollador.eliminarLogro', ['slugLogro' => $logro->slug])}}">Eliminar <i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
      <p class="text-center">No tienes logros.</p>
    @endif
  </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
  $("#dataTable").DataTable();
</script>
@stop