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
		<!-- El titulo del juego -->
		<h2 class="col-12 offset-md-1">{{$juego["nombre"]}}</h2>
		
		<!-- el IFRAME del JUEGO -->
		<iframe id="juego" class="col-md-12 "  src="{{$juego['url']}}" >
		</iframe>



		<!-- Aquí va la descripción -->
		<div id="descrip" class="row col-md-12 ">
			<span class="col-md-9 ">
				{{$juego["descripcion"]}}
			</span>
			<div class="col-md-3">
				<a href="#" data-toggle="tooltip" data-placement="top" title="Reportar!"> 
					<i id="reportar" class="fas fa-ban"></i> 
				</a>
				<!--
				<a  href="#" data-toggle="tooltip" data-placement="top" title="No Me Gusta"> 
					<i id="noMeGusta" class="far fa-thumbs-down"></i> 
				</a>
				<a  href="#" data-toggle="tooltip" data-placement="top" title="Me Gusta"> 
					<i id="meGusta" class="far fa-thumbs-up"></i> 
				</a>
			-->
		</div>
	</div>
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



<!-- Comentarios -->
<div class="row">
	<div id="comentar" class="col-10 offset-1 text-center">
		<h5><b>Escribe tu comentario!</b> <i class="fas fa-pencil-alt"></i></h5>
		<form>
			<textarea class="w-100" rows="5" placeholder="Escribe un comentario...." ></textarea>
			<button class="btn btn-outline-primary " type="submit"> Comentar </button>
		</form>
	</div>
</div>


<div class="row">
	<div id="comentarios" class="col-md-12">
		@foreach ($juego["comentarios"] as $comentarios)
		@include('frontEnd.comentario', $comentarios)
		@endforeach
	</div>
</div>


@stop

@section("modals")
<div class="modal fade" id="addComentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Escribe tu comentario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<input id="idComentario" type="hidden" name="id">
					<input value="{{$juego['slug']}}" type="hidden" name="slug">
					<div class="form-group">
						<label for="message-text" class="col-form-label">Comentario:</label>
						<textarea class="form-control" id="message-text" name="mensaje"></textarea>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary">Enviar</button>
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>
@stop

@section("scripts")
<script type="text/javascript" src="{{asset('js/enviarComentario.js')}}"></script>
@endSection