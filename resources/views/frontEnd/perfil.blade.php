@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/frontEnd/perfil.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('title')
{{ config('app.name', 'Game World') }} - Perfil
@stop

@section('content')
<div class="row">
	@if(session()->has('success'))
	<div class="col-12">
		<div class="alert alert-success" role="alert">
			{{ session()->get('success') }}
		</div>
	</div>
	@endif

	<div class="col-md-3">
		<div class="card-body">
			<h3 class="card-title">Opciones</h3>
			<div class="list-group" id="list-tab" role="tablist">
				<a class="list-group-item list-group-item-action {{ empty(old('tipo')) || old('tipo') == 'correo' ? 'active' : null }}" id="list-profile-list" data-toggle="list" href="#home" role="tab" aria-controls="profile">Cambiar Correo</a>
				<a class="list-group-item list-group-item-action {{ old('tipo') == 'pwd' ? 'active' : null }}" id="list-messages-list" data-toggle="list" href="#profile" role="tab" aria-controls="messages">Cambiar Contraseña</a>
				@if(Auth::user()->isNormal())
				<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#messages" role="tab" aria-controls="settings">Hazte Developer!!</a>
				@endif
			</div>
		</div>
	</div>
	
	<!-- Content -->
	<div class="col-md-9">
		<div class="tab-content">
			<!-- Panel 1 Cambio Correo -->
			<div class="tab-pane {{ empty(old('tipo')) || old('tipo') == 'correo' ? 'active' : null }}" id="home">
				<legend>Cambiar Correo</legend>
				<form class="form-horizontal col-md-6 offset-md-3" action="{{ route('perfil.datos') }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="tipo" value="correo">

					<fieldset>

						<!-- Text input-->
						<div class="form-group row">
							<label class="col-md-12 control-label" for="nuevoMail">Nuevo Correo</label>  
							<div class="col-md-12">
								<input id="nuevoMail" name="nuevoMail" type="text"  value="{{ old('nuevoMail') }}" placeholder="Introduce el nuevo correo" class="form-control input-md">
								@if ($errors->has('nuevoMail'))
								<span class="help-block">
									<strong>{{ $errors->first('nuevoMail') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<!-- Password input-->
						<div class="form-group row">
							<label class="col-md-12 control-label" for="confirmPwd">Confirmar Contraseña</label>
							<div class="col-md-12">
								<input id="confirmPwd" name="confirmPwd" type="password" placeholder="Introduce tu contraseña" class="form-control input-md" required="">
								@if ($errors->has('confirmPwd'))
								<span class="help-block">
									<strong>{{ $errors->first('confirmPwd') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<!-- Button -->
						<div class="form-group row">
							<div class="col-md-8 offset-md-2">
								<button name="cambiar" class="w-100 btn btn-success">Cambiar Datos</button>
							</div>
						</div>

					</fieldset>
				</form>
			</div>

			<!-- Panel 2 Cambio Contraseña -->
			<div class="tab-pane {{ old('tipo') == 'pwd' ? 'active' : null }}" id="profile">
				<legend>Cambiar Contraseña</legend>
				<form class="form-horizontal col-md-6 offset-md-3" action="{{ route('perfil.datos') }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="tipo" value="pwd">

					<fieldset>
						<!-- Password input-->
						<div class="form-group row">
							<label class="col-md-12 control-label" for="pwdActual">Contraseña Actual</label>
							<div class="col-md-12">
								<input id="pwdActual" name="currentPassword" type="password" placeholder="Introduce tu contraseña Actual" class="form-control input-md" required="">
								@if ($errors->has('currentPassword'))
								<span class="help-block">
									<strong>{{ $errors->first('currentPassword') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<!-- Password input-->
						<div class="form-group row">
							<label class="col-md-12 control-label" for="pwdNuevo">Contraseña Nueva</label>
							<div class="col-md-12">
								<input id="pwdNuevo" name="newPassword" type="password" placeholder="Introduce la nueva contraseña" class="form-control input-md" required="">
								@if ($errors->has('newPassword'))
								<span class="help-block">
									<strong>{{ $errors->first('newPassword') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<!-- Password input-->
						<div class="form-group row">
							<label class="col-md-12 control-label" for="confirmPwd">Confirmar Contraseña</label>
							<div class="col-md-12">
								<input id="confirmPwd" name="newPassword_confirmation" type="password" placeholder="Repite la nueva contraseña " class="form-control input-md" required="">
								@if ($errors->has('newPassword_confirmation'))
								<span class="help-block">
									<strong>{{ $errors->first('newPassword_confirmation') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<!-- Button -->
						<div class="form-group row">
							<div class="col-md-8 offset-md-3">
								<button name="cambiar" class="btn btn-success">Cambiar Datos</button>
							</div>
						</div>

					</fieldset>
				</form>
			</div>

			<!-- Panel 3 Hacerse Developer -->
			@if(Auth::user()->isNormal())
			<div class="tab-pane" id="messages">
				<form class="form-horizontal" action="{{ route('perfil.datos') }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="tipo" value="develop">

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
							<div class="col-md-4 offset-md-2">
								<button id="cambiar" name="cambiar" class="btn"><span>Quiero hacerme Develop<span></button>
								</div>
							</div>

						</fieldset>
					</form>

				</div>
			</div>
			@endif
		</div>

	</div>

	@stop