@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/backEnd/Develop/crearProducto.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/backEnd/Develop/application.css') }}" rel="stylesheet" type="text/css" />

@stop

@section('title')
{{ config('app.name', 'Game World') }} - Inicio
@stop


@section('content')
<div class="row mb-3" style="background-color: transparent;">
	<div class="col-md-12">
		<a href="{{ route('desarrollador.verProductos',['slugJuego' => request()->route()->parameters['slugJuego']]) }}" class="btn btn-secondary"><= Volver</a>
	</div>
</div>

<form method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="row text-center mb-4">
		<div class="col-12"><h3>CREA UN PRODUCTO PARA EL JUEGO</h3></div>
	</div>
	<div class="row">
		<div class="col-12 text-center mt-4" id="formulario">
			<div class="row">
				<div class=" col-8">
					<div class="w-100 mb-3"> 
						<label>Nombre del producto:</label>
						<input  name="nombre" placeholder="Nombre " required>
					</div>
					<div class="w-100 mb-3">
						<label>Descripción del producto:</label>
						<textarea class="w-100 d-block" rows="5" name="descripcion"  placeholder="Una breve descripción del producto a vender ... " required></textarea>
					</div>
					<div class="w-100 mb-3">
						<label>Coste del producto:</label>
						<input type="number" id="coins" name="coste" value="0" min="0" required>
					</div>

				</div>


				<div class="col-4">
					<div class="w-100" >
						<h4><b>	Imagen del producto </b></h4>

						<div class="input-group ">
							<div id="image-preview">
								<label for="img" id="image-label">Escoger imagen</label>
								<input type="file" class="custom-file-input" name="imagen" id="img" required/>
							</div>
							<script type="text/javascript">
								$(document).ready(function() {
									$.uploadPreview({
							    input_field: "#img", // Default: .image-upload
							    preview_box: "#image-preview",  // Default: .image-preview
							    label_field: "#image-label",    // Default: .image-label
							    label_default: "Escoger imagen",   // Default: Choose File
							    label_selected: "Cambiar",  // Default: Change File
							    no_label: false                 // Default: false
							});
								});
							</script>
						</div>
					</div>
				</div>

				<input type="submit" value="Crear" class="btn btn-outline-success btn-lg btn-block w-50 mx-auto mt-4">
			</div>
		</div>

	</div>
</form>

@stop

@section('scripts')

<script type="text/javascript" src="{{asset('js/jquery.uploadPreview.min.js') }}"></script>
@stop