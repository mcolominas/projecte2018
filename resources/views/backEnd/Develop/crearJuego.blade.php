@extends('layouts.master')

@section('styles')
@parent
<link href="{{ asset('css/backEnd/Develop/crear.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('title')
{{ config('app.name', 'Game World') }} - Inicio
@stop


@section('content')

	<div class="row">
		<iframe id="code">
			
		</iframe>
	</div>
	
@stop