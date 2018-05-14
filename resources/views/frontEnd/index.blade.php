@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/frontEnd/paginaPrincipal.css') }}" rel="stylesheet" type="text/css" />
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

<!-- Contiene los juegos -->
<div class="row" id="juegos">
	<!-- Empieza Juego -->

	@foreach ($juegos as $juego)

	<div class="col-6 col-md-3">
		<a href="{{ $juego->url }}" target="_blank">
			<div>
				<h3 class="mt-card-name">{{ $juego->nombre }}</h3>
			</div>
			<div class="desc">
				<img class="w-100" src='{{ asset("img/juegos/portada/$juego->img") }}' />
				<div>
					{{ $juego->descripcion }}
				</div>
			</div>
			
		</a>   
	</div>
	<!-- Acaba juego -->
	@endforeach

</div>

<!-- paginación -->
<div class="row my-5">
	<div class="col-12" id="paginado">
		<ul class="pagination mx-auto">
			<li class="page-item {{$paginado['primera']['desactivado'] ? 'disabled' : null}}">
				<a class="page-link" href="{{$paginado['primera']['url']}}">{{$paginado['primera']['signo']}}</a>
			</li>
			<li class="page-item {{$paginado['anterior']['desactivado'] ? 'disabled' : null}}">
				<a class="page-link" href="{{$paginado['anterior']['url']}}">{{$paginado['anterior']['signo']}}</a>
			</li>
			@foreach($paginado['paginas'] as $pag)
			<li class="page-item {{$pag['activo'] ? 'active' : null}}" ><a class="page-link" href="{{$pag['url']}}">{{$pag['signo']}}</a></li>
			@endforeach
			<li class="page-item {{$paginado['siguiente']['desactivado'] ? 'disabled' : null}}">
				<a class="page-link" href="{{$paginado['siguiente']['url']}}">{{$paginado['siguiente']['signo']}}</a>
			</li>
			<li class="page-item {{$paginado['ultima']['desactivado'] ? 'disabled' : null}}">
				<a class="page-link" href="{{$paginado['ultima']['url']}}">{{$paginado['ultima']['signo']}}</a>
			</li>

		</ul>
	</div>
</div>

<!-- PUBLICIDAD -->
<div class="row">
	<div class="col-12">
		<div style="border: 1px solid; text-align: center;height: 90px; margin: 5px">
			PUBLICIDAD
		</div>
	</div>
</div>
@stop