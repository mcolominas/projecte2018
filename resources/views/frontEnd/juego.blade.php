@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/frontEnd/paginaJuego.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('title')
{{ config('app.name', 'Game World') }} - Inicio
@stop


@section('content')


<!-- PUBLICIDAD -->
<div class="row">
	<div class="col-12">
		<div style="border: 1px solid; text-align: center;height: 90px; margin: 5px">
			PUBLICIDAD
		</div>
	</div>
</div>


<div class="row">
	<div class="col-12">
		<h2 class="col-12 offset-md-2">Titulo</h2>
		<iframe class="col-md-12 "  src="http://google.com/" style="border: 1px solid black; border-radius: 20px 20px 0 0; text-align: center; height: 500px; margin: 5px ;">
		</iframe>
		<div class="col-md-12 " style="border: 1px solid #404a54; top: -20px;border-radius: 0 0 20px 20px; text-align: center; height: 100px; margin: 5px;background-color: #404a54;color: white">
			DESC
		</div>
	</div>
</div>


@stop