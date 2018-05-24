@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/backEnd/Develop/crearLogo.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('title')
{{ config('app.name', 'Game World') }} - Inicio
@stop


@section('content')

<form method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="row">
		
		<div class="w-100"> 
			

		</div>

	</div>
</form>

@stop
