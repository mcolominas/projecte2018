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

<form method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="row">
		<h3>CREA UN PRODUCTO PARA LA TIENDA</h3>
		<div class="col-12 text-center" id="formulario">
			<div class="row">
				<div class="col-5">
					<div class="w-100" >
						<h4><b>	Imagen del producto </b></h4>

						<div class="input-group " style="background-image: url({{$producto->img}})">
							<div id="image-preview">
								<label for="img" id="image-label">Escoger imagen</label>
								<input type="file" class="custom-file-input" name="img" id="img" required/>
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

				<!-- Linea vertical para separar -->
				<div id="vertialLine" class="col-1" ></div>


				<div class=" col-5">
					<div class="w-100 mb-3"> 
						<label>Nombre del producto:</label>
						<input  name="nombre" placeholder="Nombre " value="{{$producto->nombre}}" required>
					</div>
					<div class="w-100 mb-3">
						<label>Descripción del producto:</label>
						<textarea class="w-100 d-block" rows="5" placeholder="Una breve descripción del producto a vender ... " required>{{$producto->descripcion}}</textarea>
					</div>
					<div class="w-100 mb-3">
						<label>Coste del producto:</label>
						<input type="number" id="coins" name="coins" value="{{$producto->coste}}" min="0" required>
					</div>

					<input type="submit" class="btn btn-outline-success btn-lg btn-block">
				</div>
			</div>
		</div>

	</div>
</form>

@stop

@section('scripts')

<script type="text/javascript" src="{{asset('js/jquery.uploadPreview.min.js') }}"></script>
@stop