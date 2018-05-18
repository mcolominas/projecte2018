@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/backEnd/Develop/crearJuego.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('title')
{{ config('app.name', 'Game World') }} - Inicio
@stop


@section('content')


<form method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="row">
		<div id="datosJuegos"  style="border: 1px solid" class="form-group col-8 ">
			<h4><b>Datos del Juego</b></h4>
			<label for="nombre" class="control-label">Nombre del juego</label>

			<input id="nombre" type="text" class="form-control" name="nombre" required>

			<label for="desc" class="control-label">Descripción del Juego</label>

			<textarea id="desc" class="w-100" rows="5" placeholder="Descripción del juego..." name="desc" required></textarea>


			<p>¿Creará el juego utilizando esta página o mediante una URL? </p>
			<label class="control-label">Por URL</label>
			<input type="radio" class="form-control w-100" name="tipo" value="url" required>
			<label class="control-label">Creado desde la página</label>
			<input type="radio" class="form-control w-100" name="tipo" value="creado" required>

			<input type="submit" class="btn btn-success" name="submit">
		</div>

		<div class="col-4">
			<div class="w-100" style="border: 1px solid;"> 
				<h4><b>	Publicar el juego </b></h4>
				<p>Quiere que su juego aparezca disponible para jugar?</p>
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text">
							<input id="visible"  type="checkbox" name="visible" aria-label="Checkbox for following text input" >
						</div>
					</div>
					<label class="form-control" >Si</label>
				</div>
			</div>

			<div class="w-100" style="border: 1px solid;">
				<h4><b>	Imagen del juego </b></h4>
				<p>Escoja una imagen que desea aplicar como portada de su juego</p>
				<div class="input-group mb-5">
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="img" id="img" required>
						<label class="custom-file-label" for="inputGroupFile02">Imagen</label>
					</div>
				</div>

			</div>

			<div class="w-100" style="border: 1px solid;">
				<h4><b>	Categoria del juego </b></h4>
				<p>Escoja una categoría para su juego</p>
				<select id="category" name="categoria[]"  multiple required size="5" required>
					@forEach ($categorias as $categoria)
					<option value='{{$categoria->slug}}'>
						{{$categoria->nombre}}
					</option>
					@endForEach
				</select>
			</div>

			<div class="w-100" style="border: 1px solid">
				<h4><b>	Plataforma del juego </b></h4>
				<p>Indique si es para que plataforma es su juego</p>
				<select id="plataforma" name="plataforma[]"  multiple required size="5" required>
					@forEach ($plataformas as $plataforma)
					<option value='{{$plataforma->slug}}'>
						{{$plataforma->nombre}}
					</option>
					@endForEach
				</select>
			</div>
		</div>

	</div>
	<div class="row">
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
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="file-editor" class="col-sm-12 col-lg-8">
			<div class="tab-content" role="tab-content">
			</div>
		</div>

	</div>
	<div class="row">
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
<script type="text/javascript" src="{{asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{asset('js/crearJuego.js') }}"></script>

@stop