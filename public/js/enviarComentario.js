const servidor = "http://127.0.0.1:8000/api/";

var hash,url,comentario,params,slug;

//función que llama a una api e inserta un comentario
$('#comentar form').submit(function(e){
	e.preventDefault();
	url = servidor + "addComentario";
	comentario = $('#comentar form').find("textarea").val().replace(/\n/g,"<br />");
	slug = $('input[name="slug"]').val();
	params = {comentario: comentario, slug: slug};

	ajax(url,"post",params,function(res){
		console.log(res); 
		$('#comentar textarea').val('')
		if(res.status == 1){
			$('#comentarios').prepend(getHTMLComentario(res.username, res.comentario, res.id))
		}
	});

});


//función que llama a una api e inserta un subcomentario 
$("#addComentario form").submit(function(e){

	e.preventDefault();
	hash = $("#idComentario").val();
	url = servidor+"addSubComentario";
	comentario = $("#message-text").val().replace(/\n/g,"<br />");
	slug = $('input[name="slug"]').val();
	params = {id : hash, comentario: comentario, slug: slug}


	ajax(url,"post",params, function(res){console.log(res)
		if(res.status == 1){
			$('#comentarios a[data-whatever='+hash+']').closest(".comentario").append(getHTMLComentario(res.username, res.comentario, res.id))
		}
	});
	$('#addComentario').modal('hide');

});


function getHTMLComentario(username, comentario, id){
	return $('<div class="comentario">'+
		'<div>'+
		'<i class="fas fa-user "></i>'+
		'<h5><b> '+username+'</b></h5>'+
		'<p>'+comentario+'</p>'+
		'<a href="#" data-toggle="modal" data-target="#addComentario" data-whatever="'+id+'"> Comentar <i class="fas fa-comment"></i> </a>'+
		'</div>'+
		'</div>');
}

//función ajax
function ajax(url, method, params, respuesta){
	$.ajax({
		data:params,
		dataType: 'json',
		url: url,
		type: method,
		success: respuesta,
		error: function(data) { console.log(data);}
	});
}

//función que recoje el data del botón seleccionado 
$('#addComentario').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data("whatever") // Extract info from data-* attributes
  var modal = $(this).find("#idComentario").val(recipient)
})


//Función que elimina el valor del textarea y el input hidden cuando se cancela el formulario
$('#addComentario').on('hidden.bs.modal', function (e) {
	$('#idComentario').val("");
	$('#message-text').val("");
})
