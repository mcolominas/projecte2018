@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/perfil.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('title')
{{ config('app.name', 'Game World') }} - Perfil
@stop

@section('content')
<div class="row">

	<div class="col-md-3">
		<div class="card-body">
			<h3 class="card-title">Opciones</h3>
			<ul class="nav nav-pills nav-stacked" id="myTabs">
				<li class="active"><a href="#home" data-toggle="pill">Cambiar Correo</a></li>
				<li><a href="#profile" data-toggle="pill">Cambiar Contraseña</a></li>
				<li><a href="#messages" data-toggle="pill">Hazte Developer!!</a></li>
			</ul>
		</div>
	</div>

	<!-- Content -->
	<div class="col-md-9">
		<div class="tab-content">
			<!-- Panel 1 Cambio Correo -->
			<div class="tab-pane active" id="home">
				<form class="form-horizontal" action="{{ route('perfil.correo') }}" method="POST">
					{{ csrf_field() }}
					<fieldset>

						<!-- Form Name -->
						<legend>Cambiar Correo</legend>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="nuevoMail">Nuevo Correo</label>  
							<div class="col-md-5">
								<input id="nuevoMail" name="nuevoMail" type="text"  value="{{ old('nuevoMail') }}" placeholder="Introduce el nuevo correo" class="form-control input-md">
								@if ($errors->has('nuevoMail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nuevoMail') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>

						<!-- Password input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="confirmPwd">Confirmar Contraseña</label>
							<div class="col-md-5">
								<input id="confirmPwd" name="confirmPwd" type="password" placeholder="Introduce tu contraseña" class="form-control input-md" required="">
								@if ($errors->has('confirmPwd'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirmPwd') }}</strong>
                                    </span>
                                @endif
							</div>
						</div>

						<!-- Button -->
						<div class="form-group">
							<div class="col-md-4 col-md-offset-4">
								<button name="cambiar" class="btn btn-success">Cambiar Datos</button>
							</div>
						</div>

					</fieldset>
				</form>
			</div>

			<!-- Panel 2 Cambio Contraseña -->
			<div class="tab-pane" id="profile">
				<form class="form-horizontal" method="POST">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<fieldset>

						<!-- Form Name -->
						<legend>Cambiar Contraseña</legend>

						<!-- Password input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="pwdActual">Contraseña Actual</label>
							<div class="col-md-5">
								<input id="pwdActual" name="pwdActual" type="password" placeholder="Introduce tu contraseña Actual" class="form-control input-md" required="">

							</div>
						</div>

						<!-- Password input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="pwdNuevo">Contraseña Nueva</label>
							<div class="col-md-5">
								<input id="pwdNuevo" name="pwdNuevo" type="password" placeholder="Introduce la nueva contraseña" class="form-control input-md" required="">

							</div>
						</div>

						<!-- Password input-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="confirmPwd">Confirmar Contraseña</label>
							<div class="col-md-5">
								<input id="confirmPwd" name="confirmPwd" type="password" placeholder="Repite la nueva contraseña " class="form-control input-md" required="">

							</div>
						</div>

						<!-- Button -->
						<div class="form-group">
							<div class="col-md-4 col-md-offset-4">
								<button name="cambiar" class="btn btn-success">Cambiar Datos</button>
							</div>
						</div>

					</fieldset>
				</form>


			</div>




			<!-- Panel 3 Hacerse Developer -->
			<div class="tab-pane" id="messages">
				<form class="form-horizontal" method="POST">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<fieldset>

						<!-- Form Name -->
						<legend>Hazte Develop</legend>
						<div class="content">
							<h5><b>¿Qué es un Develop?</b></h5>
							<p><b><i>Develop o Developer </i></b> quiere decir que serás desarollador de tus própios juegos.<br>
								Podrás crearlos utilizando JavaScript, un lenguaje de programación, para que tu o otros usuarios
								puedan jugar y ganar monedas virtuales las cuales podrás gastar en una tienda virtual, ya sea para 
							tener una épica skin o ventajas para tu personaje, entre otras cosas.</p>

							<h5><b>¿Qué ventajas obtengo al ser Develop?</b></h5>
							<p> La principal ventaja como <b><i>Develop</i></b> es que podrás crear tus própios juegos utilizando
								JavaScript, así tus amigos o otros usuarios podrán probar el juego de tus sueños.<br>
							También podrás añadir logros en tus juegos para recompensar a esos usuarios que deciden aventurarse en tu juego.</p>

							<p>Otra característica, es que puedes añadir en la tienda online productos para facilitar algún reto difícil del juego que hayas creado.<br>
							(¡¡El precio de los productos lo puedes decidir tú!!)</p>
						</div>

						<!-- Button -->
						<div class="form-group">
							<div class="col-md-4 col-md-offset-2">
								<button id="cambiar" name="cambiar" class="btn"><span>Quiero hacerme Develop<span></button>
								</div>
							</div>

						</fieldset>
					</form>

				</div>


			</div>
		</div>

	</div>

	@stop