@extends('layouts.master')

@section('title')
    {{ config('app.name', 'Game World') }} - Inicio
@stop

@section('content')
	<div class="mt-element-card mt-element-overlay">
	    <div class="row">
	        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
	            <a href="#" target="_blank">
	            	<div class="mt-card-item">
		                <div class="mt-card-avatar mt-overlay-1">
		                    <img src="{{ ('vendor/assets/pages/img/demo/tablero2.jpg') }}" />
		                    <div class="mt-overlay">
		                        <ul class="mt-info">
		                            <span>DESCRIPCIÓN DEL JUEGO aaaaaaaaaaaaa aaaaaaaaa aaaaaa aaaaaaaaaaa aaaaa aaaaaaaaaaaa aaaaaaaaaaaa aaaaaaaaaaaaaa aaaaaaaaa aaaaaaaaaaaaa aaaaa aaaaaaaaa aaaaaaaa aaaaaaaaa aaaaa
		                            aaaaaaaaaaaaa aaaaaaa aaaaaa aaaaaaaaaaaaaaaaa aaaa
		                        aaaaaaaaaaaaa aaaaaaa aaaaaaaaaaaa a aaaaaaaaa aaaaa
		                    aaaaaaaa aaaaaaaaaaa aaaaaaaa aaaa aaaa aaaaaaaaa aaaaa aaaaa aaaaaa aaaaaa aaaaaasdfs sdf  asd asd a a asd asd asd as das dasd as dasd a as dasd as a das ad asd aadf asd as as daaa aaaaaaa</span>
		                        </ul> 
		                    </div>
		                </div>
		                <div class="mt-card-content">
		                    <h3 class="mt-card-name">TITULO</h3>  

		                </div>
	            	</div>
	            </a>   
	        </div>
	    </div>
	</div>
@stop