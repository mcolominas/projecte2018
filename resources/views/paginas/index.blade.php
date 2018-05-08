@extends('layouts.master')

@section('styles')
	@parent
    <link href="{{ asset('css/paginaPrincipal.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('title')
    {{ config('app.name', 'Game World') }} - Inicio
@stop

@section('content')
<!-- PUBLICIDAD -->
<div style="border: 1px solid; text-align: center;height: 90px; margin: 5px">
	PUBLICIDAD
</div>


<!-- Contiene los juegos -->
<div class="mt-element-card mt-element-overlay">
    <div class="row">
    	<!-- Empieza Juego -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a href="#" target="_blank">
            	<div class="mt-card-item">
            		<div class="mt-card-content">
	                    <h3 class="mt-card-name">TITULO</h3>  
	                </div>
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
            	</div>
            </a>   
        </div>
        <!-- Acaba juego -->

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a href="#" target="_blank">
            	<div class="mt-card-item">
            		<div class="mt-card-content">
	                    <h3 class="mt-card-name">TITULO</h3>  

	                </div>
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
            	</div>
            </a>   
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a href="#" target="_blank">
            	<div class="mt-card-item">
            		<div class="mt-card-content">
	                    <h3 class="mt-card-name">TITULO</h3>  

	                </div>
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
            	</div>
            </a>   
        </div>


        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a href="#" target="_blank">
            	<div class="mt-card-item">
            		<div class="mt-card-content">
	                    <h3 class="mt-card-name">TITULO</h3>  

	                </div>
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
            	</div>
            </a>   
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a href="#" target="_blank">
            	<div class="mt-card-item">
            		<div class="mt-card-content">
	                    <h3 class="mt-card-name">TITULO</h3>  

	                </div>
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
            	</div>
            </a>   
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a href="#" target="_blank">
            	<div class="mt-card-item">
            		<div class="mt-card-content">
	                    <h3 class="mt-card-name">TITULO</h3>  

	                </div>
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
            	</div>
            </a>   
        </div>
    </div>
</div>


<!-- paginación -->
<div class="centrar">
	<ul class="pagination">
	    <li><a href="#">«</a></li>
	    <li><a href="#">1</a></li>
	    <li><a href="#">2</a></li>
	    <li><a href="#">3</a></li>
	    <li><a href="#">4</a></li>
	    <li><a href="#">5</a></li>
	    <li><a href="#">6</a></li>
	    <li><a href="#">»</a></li>
	</ul>
</div>
<!-- PUBLICIDAD -->
<div style="border: 1px solid; text-align: center;height: 90px; margin: 5px">
	PUBLICIDAD
</div>
@stop