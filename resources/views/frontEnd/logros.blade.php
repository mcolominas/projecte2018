@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/frontEnd/perfil.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('title')
{{ config('app.name', 'Game World') }} - Perfil
@stop

@section('content')
<div class="row">
	<div class="col-12 mt-3 col-md-10 offset-md-1">

    @if(count($logros)>0)
    <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
      <thead class="thead-dark">
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Coins</th>
          <th>Conseguido</th>
          <th>Juego</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($logros as $logro)
        <tr>
          <td style="width: 100px"><img src="{{ $logro->img }}" alt="{{ $logro->nombre }}" class="w-100"/></td>
          <td>{{ $logro->nombre }}</td>
          <td>{{ $logro->descripcion }}</td>
          <td>{{ $logro->coins }}</td>
          <td>{{ $logro->created_at }}</td>
          <td>{{ $logro->juego->nombre }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
      <p class="text-center">Actualmente no dispones de ningún logro</p>
    @endif
  </div>
</div>

@stop

@section('scripts')
@parent
<script type="text/javascript">
  $("#dataTable").DataTable();
</script>
@stop