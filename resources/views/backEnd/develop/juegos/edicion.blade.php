@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/backEnd/Develop/crearJuego.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('title')
{{ config('app.name', 'Game World') }} - Inicio
@stop


@section('content')


<form>
	<div class="row">

		<div class="col-md-5">
			<div id="datosJuegos" class="form-group">
				<label for="password" class="col-12 control-label">Nombre del juego</label>

				<div class="col-12">
					<input id="nombre" type="text" class="form-control" name="nombre" required>
					<span class="help-block">
						<strong></strong>
					</span>
					
				</div>
			</div>
			<input id="desc" type="text" class="form-control" name="nombre" required>
			<input id="visible" type="checkbox" class="form-control" name="nombre" required>
			<input id="icono" type="text" class="form-control" name="nombre" required>
			<input id="radiobutton" type="radio" class="form-control" name="nombre" required>
			<select id="categoria" name="categoria"  multiple required size="5">
				<option>

				</option>
			</select>
			<select id="plataforma" name="plataforma"  multiple required size="5">
				<option>
				</option>
			</select>

		</div>


		<div class="col-sm-12 col-lg-4">
			<div id="file-menu" class="row">
				<div class="col" role="tablist">
					<div class="card">
						<div class="card-header p-0">
							<h5 class="mb-0">
								<button class="btn btn-link p-1 full"  data-toggle="collapse" data-target="#collapsehtml">
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
								<button class="btn btn-link p-1 full" data-toggle="collapse" data-target="#collapsecss">
									CSS
								</button>
								<div class="absolue-rigth">
									<button data-type="css" class="add btn btn-link">
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
								<button class="btn btn-link p-1 full" data-toggle="collapse" data-target="#collapsejs">
									JS
								</button>
								<div class="absolue-rigth">
									<button data-type="js" class="add btn btn-link">
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
</form>
@stop

@section('scripts')
<script type="text/javascript" src="{{asset('js/app.js') }}"></script>
@endSection