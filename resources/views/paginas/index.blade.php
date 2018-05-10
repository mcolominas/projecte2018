@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/paginaPrincipal.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('title')
{{ config('app.name', 'Game World') }} - Inicio
@stop

@section('content')
<!-- PUBLICIDAD -->
<div style="border: 1px solid; text-align: center;height: 90px; margin: 5px">
	PUBLICIDAD
</div>


<!-- Contiene los juegos -->
<div class="mt-element-card mt-element-overlay">
	<div class="row">
		<!-- Empieza Juego -->

		@foreach ($juegos as $juego)

		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<a href="{{ $juego->url }}" target="_blank">
				<div class="mt-card-item">
					<div class="mt-card-content">
						<h3 class="mt-card-name">{{ $juego->nombre }}</h3>  
					</div>
					<div class="mt-card-avatar mt-overlay-1">
						<img src='{{ asset("img/juegos/portada/$juego->nombre") }}' />
						<div class="mt-overlay">
							<ul class="juego-info">
								<span>{{$juego->descripcion}}</span>
							</ul> 
						</div>
					</div>
				</div>
			</a>   
		</div>
		<!-- Acaba juego -->
		@endforeach

	</div>
</div>
<!--
	<?= json_encode($juegos) ?> _____
	<?= json_encode($paginado) ?>
-->
<!-- paginación -->
<div class="centrar">
	<ul class="pagination">
		<li class="{{$paginado['primera']['desactivado'] ? 'disabled' : null}}">
			<a href="{{$paginado['primera']['url']}}">{{$paginado['primera']['signo']}}</a>
		</li>
		<li class="{{$paginado['anterior']['desactivado'] ? 'disabled' : null}}">
			<a href="{{$paginado['anterior']['url']}}">{{$paginado['anterior']['signo']}}</a>
		</li>
		@foreach($paginado['paginas'] as $pag)
		<li class="{{$pag['activo'] ? 'active' : null}}" ><a href="{{$pag['url']}}">{{$pag['signo']}}</a></li>
		@endforeach
		<li class="{{$paginado['siguiente']['desactivado'] ? 'disabled' : null}}">
			<a href="{{$paginado['siguiente']['url']}}">{{$paginado['siguiente']['signo']}}</a>
		</li>
		<li class="{{$paginado['ultima']['desactivado'] ? 'disabled' : null}}">
			<a href="{{$paginado['ultima']['url']}}">{{$paginado['ultima']['signo']}}</a>
		</li>

	</ul>
</div>
<!-- PUBLICIDAD -->
<div style="border: 1px solid; text-align: center;height: 90px; margin: 5px">
	PUBLICIDAD
</div>
@stop