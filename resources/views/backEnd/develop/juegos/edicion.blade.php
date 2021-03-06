@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/backEnd/Develop/crearJuego.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/backEnd/Develop/application.css') }}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{asset('js/app.js') }}"></script>
@stop

@section('title')
{{ config('app.name', 'Game World') }} - Inicio
@stop


@section('content')


<form method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="row">
		<div id="datosJuegos"  class="w-100 mb-2 form-group col-8 ">
			<div class="w-100">
				<h4><b>Datos del Juego</b></h4>
				<div class="card border-info mb-3 text-center">
					<div class="card-header">Hash</div>
					<div class="card-body text-info">
						<p class="card-text">{{$juego->hash}}</p>
					</div>
				</div>

				<label for="nombre" class="control-label">Nombre del juego</label>
				<input id="nombre" type="text" class="form-control color" name="nombre" value="{{ old('nombre')  == '' ?  $juego->nombre : old('nombre')  }}" required>
				@if ($errors->has('nombre'))
				<span class="help-block">
					<strong>{{ $errors->first('nombre') }}</strong>
				</span>
				@endif

				<label for="desc" class="control-label">Descripción del Juego</label>

				<textarea id="desc" class="w-100 color" rows="25" placeholder="Descripción del juego..." name="desc" value="{{ old('desc') }}"  required>{{$juego->descripcion}}</textarea>
				@if ($errors->has('desc'))
				<span class="help-block">
					<strong>{{ $errors->first('desc') }}</strong>
				</span>
				@endif
			</div>
			<div class="w-100"	>
				<p>¿Creará el juego utilizando esta página o mediante una URL? </p>
				<label>
					<input type="radio" name="tipo" value="url" {{ old('tipo') == "url" || old('tipo') == "" ? "checked" : null }} required>
					Por URL
				</label>

				<input id="urlExterna" type="text" class="form-control color w-75" placeholder="Indique la URL del juego" name="urlExterna" value="{{ old('urlExterna') == '' ? count($juego->files) == 0 ? $juego->url : '' : old('urlExterna') }}" required style="display: inline-block;  {{ old('tipo') == "url" || count($juego->files) > 0 ?  null : "display:none" }}">
				@if ($errors->has('urlExterna'))

				<span class="help-block">
					<strong>{{ $errors->first('urlExterna') }}</strong>
				</span>
				@endif
				<br/>
				<label>
					<input type="radio" name="tipo" value="creado" {{ old('tipo') == "creado" ? "checked" : null }} required>
					Creado desde la página
				</label>

				@if ($errors->has('tipo'))
				<span class="help-block">
					<strong>{{ $errors->first('tipo') }}</strong>
				</span>
				@endif
			</div>
			
		</div>

		<div class="col-4">
			<div class="w-100 mb-2" > 
				<h4><b>	Descargas </b></h4>
				<div>
					<b>Quieres utilizar nuestro sistema de logros y productos?</b><br>
					<ul>
						<li class="mt-1"><a class="btn btn-info px-2 py-0" href="{{ env('APP_URL') }}/documentacion/apiJuegoPorAjax" download>Descargar la guía AJAX.</a></li>
					</ul>
				</div>
				<div>
					<b>Si su juego admite JS puede descargar nuestra API de JS</b><br>
					<ul>
						<li class="mt-1"><a class="btn btn-info px-2 py-0" href="{{ env('APP_URL') }}/documentacion/apiJuegoPorJs" download>Descargar la guía.</a></li>
						<li class="mt-1"><button class="btn btn-info px-2 py-0" type="button" data-toggle="collapse" data-target="#importarJSApi" aria-expanded="false" aria-controls="importarJSApi">Importar</button> | <a class="btn btn-info px-2 py-0" href="{{ env('APP_URL') }}/js/apiJuego.js" download>Descargar la API.</a></li>
						<div class="collapse" id="importarJSApi">
							<div class="card card-body mt-2 p-3">
								&lt;script type="text/javascript" src="{{ env('APP_URL') }}/js/apiJuego.js"&gt;&lt;/script&gt;
							</div>
						</div>
					</ul>
				</div>
			</div>

			<div class="w-100 mb-2" > 
				<h4><b>	Información Básica </b></h4>
				<div class="mb-2">
					<span><b>Creación:</b> {{$juego->created_at}}</span><br>
					<span><b>Ultima modificación:</b> {{$juego->updated_at}}</span><br>
					<span><b>Visitias:</b> {{$juego->visitas}}</span>
				</div>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text">
							<input id="visible"  type="checkbox" name="visible"  {{ old('visible') == "" ? ($juego->visible == 1) ? 'checked' : null : 'checked' }} aria-label="Checkbox for following text input">
						</div>
					</div>
					<label for="visible" class="form-control color" >¿Hacer visible?</label>
				</div>
				<div>
					<input type="submit" class="btn btn-outline-primary text-center" name="guardar" value="Guardar">

					<input type="submit" class="btn btn-outline-primary text-center" name="compilar" value="Guardar y Compilar">
				</div>
			</div>

			<div class="w-100 mb-2" >
				<h4><b>	Imagen del juego </b></h4>
				<p>Escoja una imagen que desea aplicar como portada de su juego</p>
				<div class="input-group mb-5">
					<div id="image-preview" style="background-image: url({{$juego->img}})">
						<label for="img" id="image-label">Escoger portada</label>
						<input type="file" class="custom-file-input" name="img" id="img"/>
					</div>
				</div>

			</div>

			<div class="w-100 mb-2" >
				<h4><b>	Categoria del juego </b></h4>
				<p>Escoja una categoría para su juego</p>
				<select class="w-100 color" id="category" name="categoria[]"  multiple required size="5" required>
					@forEach ($categorias as $categoria)
					<option value='{{ $categoria->slug }}' {{$categoria->seleccionado == 1 ? "selected" : null }}>
						{{$categoria->nombre}}
					</option>
					@endForEach
				</select>
				@if ($errors->has('categoria'))
				<span class="help-block">
					<strong>{{ $errors->first('categoria') }}</strong>
				</span>
				@endif
			</div>

			<div class="w-100 mb-2" >
				<h4><b>	Plataforma del juego </b></h4>
				<p>Indique si es para que plataforma es su juego</p>
				<select class="w-100 color" id="plataforma" name="plataforma[]"  multiple required size="5" required>
					@forEach ($plataformas as $plataforma)
					<option value='{{$plataforma->slug}}' {{$plataforma->seleccionado == 1 ? "selected" : null }}>
						{{$plataforma->nombre}}
					</option>
					@endForEach
				</select>
				@if ($errors->has('plataforma'))
				<span class="help-block">
					<strong>{{ $errors->first('plataforma') }}</strong>
				</span>
				@endif
			</div>
		</div>

	</div>
	<hr>

	<div id="creando" class="row">
		<h2 class="text-center w-100">Crea tu propio código</h2>
		<br/>
		<div class="col-sm-12 col-lg-4">
			<div id="file-menu" class="row">
				<div class="col" role="tablist">
					<div class="card">
						<div class="card-header p-0">
							<h5 class="mb-0">
								<button type="button" class="btn btn-link p-1 full"  data-toggle="collapse" data-target="#collapsehtml">
									HTML
								</button>
							</h5>
						</div>
						<div id="collapsehtml" class="collapse">
							<div class="card-body">
								<div class="buttons">

								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-header p-0">
							<h5 class="mb-0">
								<button type="button" class="btn btn-link p-1 full" data-toggle="collapse" data-target="#collapsecss">
									CSS
								</button>
								<div class="absolue-rigth">
									<button type="button" data-type="css" class="add btn btn-link">
										<i class="material-icons">note_add</i>
									</button>
								</div>
							</h5>
						</div>
						<div id="collapsecss" class="collapse">
							<div class="card-body">
								<div class="sortable buttons">
									<div>

									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-header p-0">
							<h5 class="mb-0">
								<button type="button" class="btn btn-link p-1 full" data-toggle="collapse" data-target="#collapsejs">
									JS
								</button>
								<div class="absolue-rigth">
									<button type="button" data-type="js" class="add btn btn-link">
										<i class="material-icons">note_add</i>
									</button>
								</div>
							</h5>
						</div>
						<div id="collapsejs" class="collapse">
							<div class="card-body">
								<div class="sortable buttons">
									<div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="file-editor" class="col-sm-12 col-lg-8">
			<div class="tab-content" role="tab-content">
				@forEach($juego->files as $index=>$file)
				@if($file->tipo == "html")
				<div class="tab-pane" id="{{$file->tipo}}-{{$file->nombre}}">
					<input id="{{$file->nombre}}" value="{{$file->nombre}}" name="name{{$file->tipo}}" hidden="">
					<textarea type="{{$file->tipo}}" name="{{$file->tipo}}" placeholder="Aquí va tu código js">{{$file->content}}</textarea>
				</div>
				<script type="text/javascript">
					systemFiles.add("html", "index", function(){}, false, $("#{{$file->tipo}}-{{$file->nombre}} textarea"));
				</script>
				@else
				<div class="tab-pane" id="{{$file->tipo}}-{{$file->nombre}}">
					<input id="{{$file->nombre}}" value="{{$file->nombre}}" name="name{{$file->tipo}}{{$index}}" hidden="">
					<textarea type="{{$file->tipo}}" name="{{$file->tipo}}{{$index}}" placeholder="Aquí va tu código js">{{$file->content}}</textarea>
				</div>
				<script type="text/javascript">
					systemFiles.add("{{$file->tipo}}", "{{$file->nombre}}", function(){}, false, $("#{{$file->tipo}}-{{$file->nombre}} textarea"));
				</script>
				@endif
				@endForEach
			</div>
		</div>
		<div class="col-sm mt-3">
			<iframe id="code"></iframe>
		</div>
	</div>


</form>
@stop

@section('modals')
<div class="modal fade" id="file-name-modal">
	<div class="modal-dialog">
		<form>
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Crear fichero</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="file-name" class="col-form-label">Nombre del fichero:</label>
						<input type="text" class="form-control" id="file-name">
						<input type="hidden" class="form-control" id="file-type">
					</div>
					<div class="alert alert-danger pt-1 pb-1" role="alert"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Crear fichero</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="file-name-edit-modal">
	<div class="modal-dialog">
		<form>
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Editar nombre fichero</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="file-name" class="col-form-label">Nombre del fichero:</label>
						<input type="text" class="form-control" id="file-name">
						<input type="hidden" class="form-control" id="file-type">
					</div>
					<div class="alert alert-danger pt-1 pb-1" role="alert"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Cambiar nombre</button>
				</div>
			</div>
		</form>
	</div>
</div>
@stop



@section('scripts')
<script type="text/javascript" src="{{asset('js/jquery.uploadPreview.min.js') }}"></script>
<script type="text/javascript">
	compile();

	@if(count($juego->files) > 0)
	mostrarCreado();
	updateIframe(null);
	@else
	mostrarUrl();
	@endif

	$.uploadPreview({
			input_field: "#img", // Default: .image-upload
			preview_box: "#image-preview",  // Default: .image-preview
			label_field: "#image-label",    // Default: .image-label
			label_default: "Escoger portada",   // Default: Choose File
			label_selected: "Cambiar",  // Default: Change File
			no_label: false                 // Default: false
		});

	$('input[name=tipo]').click(function(e){
		//MUESTRA HTML,CSS,JS
		if(e.target.value == "creado"){
			mostrarCreado();
		}
		//MUESTRA INPUT URL
		else if(e.target.value == "url"){
			mostrarUrl();
		}	
	})

	function mostrarUrl(){
		$('#creando').hide();
		$('#creando textarea').removeAttr('required');

		$('#urlExterna').attr('required');

		$('#urlExterna').show();
		$('input[name=compilar').hide();

		$("input[value=url]").prop("checked", true);
	}

	function mostrarCreado(){
		$('#urlExterna').hide()
		$('#urlExterna').removeAttr('required');

		$('#creando textarea').attr('required');

		$('#creando').show();
		$('input[name=compilar').show();

		$("input[value=creado]").prop("checked", true);
	}
</script>
@stop