@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/backEnd/Develop/crearLogro.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/backEnd/Develop/application.css') }}" rel="stylesheet" type="text/css" />

@stop

@section('title')
{{ config('app.name', 'Game World') }} - Inicio
@stop


@section('content')

<form method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="row text-center mb-4">
		<div class="col-12"><h3>CREA TU LOGRO</h3></div>
	</div>
	<div class="row">
		<div class="col-8 text-center offset-2 mb-2" id="formulario">
			<div class="w-100 mb-2"> 
				<label>Nombre del Logro:</label>
				<input  name="nombre" placeholder="Nombre " required>
			</div>
			<div class="w-100 mb-2">
				<label>Descripción del Logro:</label>
				<textarea class="w-100 d-block" rows="5" name="descripcion" placeholder="Escriba aquí la descripción del logro  por ejemplo: 5 saltos seguidos" required></textarea>
			</div>
			<div class="w-100 mb-2">
				<label>Cantidad de monedas que da:</label>
				<input type="number" name="coins" value="0" min="0" max="50">
			</div>
			<div class="w-100 mb-2">
				<p>*Indique aquí <b>EN SEGUNDOS</b> el tiempo  mínimo y máximo que considere que se puede tardar en conseguir el logro*</p>
				<label>Tiempo mínimo:</label>
				<input type="number" min="0" value="0" name="tiempoMinimo" required>
				<label>Tiempo máximo:</label>
				<input type="number" min="0" value="0" name="tiempoMaximo" required>
			</div>
			<div class="w-100 mb-2" >
				<h4><b>	Imagen del logro </b></h4>

				<div class="input-group ">
					<div id="image-preview">
						<label for="img" id="image-label">Escoger portada</label>
						<input type="file" class="custom-file-input" name="imagen" id="img" required/>
					</div>
					<script type="text/javascript">
						$(document).ready(function() {
							$.uploadPreview({
							    input_field: "#img", // Default: .image-upload
							    preview_box: "#image-preview",  // Default: .image-preview
							    label_field: "#image-label",    // Default: .image-label
							    label_default: "Escoger portada",   // Default: Choose File
							    label_selected: "Cambiar",  // Default: Change File
							    no_label: false                 // Default: false
							});
						});
					</script>
				</div>
			</div>

			<input type="submit" value="Crear" class="btn btn-outline-success btn-lg btn-block">
		</div>

	</div>
</form>

@stop

@section('scripts')

<script type="text/javascript" src="{{asset('js/jquery.uploadPreview.min.js') }}"></script>
@stop