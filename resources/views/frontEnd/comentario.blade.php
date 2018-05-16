<div class="comentario">
	<div>
		<i class="fas fa-user "></i>
		<h5><b>{{$comentarios["user"]["name"]}}</b></h5>
		<p>{!!$comentarios["comentario"]!!}</p>
		@auth
		<a href="#" data-toggle="modal" data-target="#addComentario" data-whatever="{{$comentarios['hash']}}"> Comentar <i class="fas fa-comment"></i> </a>
		@endauth
	</div>
    @foreach($comentarios['sub_comentarios'] as $comentarios)
        @include('frontEnd.comentario', $comentarios)
    @endforeach
</div>