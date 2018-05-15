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
		<h2 class="col-12 offset-md-1">Titulo</h2>
		
		<!-- el IFRAME del JUEGO -->
		<iframe id="juego" class="col-md-12 "  src="http://www.htmlquick.com/" >
		</iframe>



		<!-- Aquí va la descripción -->
		<div id="descrip" class="row col-md-12 ">
			<span class="col-md-9 ">
				ESTO ES UNA DESCRIPCIÓN aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
				aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
				aaaa        a aaaaaaaaaaaaa aaaaaaaaaaaaaaaaa a
				aaaaaaaaaaa aaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaa
				aaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

			</span>
			<div class="col-md-3">
				<a href="#" data-toggle="tooltip" data-placement="top" title="Reportar!"> 
					<i id="reportar" class="fas fa-ban"></i> 
				</a>
				<a  href="#" data-toggle="tooltip" data-placement="top" title="No Me Gusta"> 
					<i id="noMeGusta" class="far fa-thumbs-down"></i> 
				</a>
				<a  href="#" data-toggle="tooltip" data-placement="top" title="Me Gusta"> 
					<i id="meGusta" class="far fa-thumbs-up"></i> 
				</a>
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
	<div class="col-md-12">
		<div class="comentario">
			<div>
				<i class="fas fa-user "></i>
				<h5><b>Nombre</b></h5>
				<p>
					prueba de comentario de un usuario que te ha parecido? 
				</p>
				<a href="#"> Comentar <i class="fas fa-comment"></i> </a>
			</div>
			<div class="comentario">
				<div>
					<i class="fas fa-user "></i>
					<h5><b>Nombre</b></h5>
					<p>
						prueba de comentario de un usuario que te ha parecido? 
					</p>
					<a href="#"> Comentar <i class="fas fa-comment"></i> </a>
				</div>
				<div class="comentario">
					<div>
						<i class="fas fa-user "></i>
						<h5><b>Nombre</b></h5>
						<p>
							prueba de comentario de un usuario que te ha parecido? 
						</p>
						<a href="#"> Comentar <i class="fas fa-comment"></i> </a>
					</div>

					<div class="comentario">
						<div>
							<i class="fas fa-user "></i>
							<h5><b>Nombre</b></h5>
							<p>
								prueba de comentario de un usuario que te ha parecido? 
							</p>
							<a href="#"> Comentar <i class="fas fa-comment"></i> </a>
						</div>

						<div class="comentario">
							<div>
								<i class="fas fa-user "></i>
								<h5><b>Nombre</b></h5>
								<p>
									prueba de comentario de un usuario que te ha parecido? 
								</p>
								<a href="#"> Comentar <i class="fas fa-comment"></i> </a>
							</div>

							<div class="comentario">
								<div>
									<i class="fas fa-user "></i>
									<h5><b>Nombre</b></h5>
									<p>
										prueba de comentario de un usuario que te ha parecido? 
									</p>
									<a href="#"> Comentar <i class="fas fa-comment"></i> </a>
								</div>


							<div class="comentario">
								<div>
									<i class="fas fa-user "></i>
									<h5><b>Nombre</b></h5>
									<p>
										prueba de comentario de un usuario que te ha parecido? 
									</p>
									<a href="#"> Comentar <i class="fas fa-comment"></i> </a>
								</div>


							<div class="comentario">
								<div>
									<i class="fas fa-user "></i>
									<h5><b>Nombre</b></h5>
									<p>
										prueba de comentario de un usuario que te ha parecido? 
									</p>
									<a href="#"> Comentar <i class="fas fa-comment"></i> </a>
								</div>


							<div class="comentario">
								<div>
									<i class="fas fa-user "></i>
									<h5><b>Nombre</b></h5>
									<p>
										prueba de comentario de un usuario que te ha parecido? 
									</p>
									<a href="#"> Comentar <i class="fas fa-comment"></i> </a>
								</div>

							</div>
							</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="comentario">
			<div>
				<i class="fas fa-user "></i>
				<h5><b>Nombre</b></h5>
				<p>
					prueba de comentario de un usuario que te ha parecido? 
				</p>
				<a href="#"> Comentar <i class="fas fa-comment"></i> </a>
			</div>

		</div>
		
	</div>
</div>
<div class="row">
	<div id="comentar" class="col-10 offset-1 text-center">
		<h5><b>Escribe tu comentario!</b> <i class="fas fa-pencil-alt"></i></h5>
		<form>
			<textarea class="w-100" rows="5" placeholder="Escribe un comentario...." ></textarea>
			<button class="btn btn-outline-primary " type="submit"> Comentar </button>
		</form>
	</div>
</div>


@stop