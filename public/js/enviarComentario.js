const servidor = "http://127.0.0.1:8000/api/";

var hash,url,comentario,params,slug;

//función que llama a una api e inserta un comentario
$('#comentar form').submit(function(e){
	e.preventDefault();
	url = servidor + "addComentario";
	comentario = $('#comentar form').find("textarea").val();
	slug = $('input[name="slug"]').val();
	params = {mensaje: comentario, slug: slug};

	ajax(url,"post",params,function(res){
		console.log(res); 
		$('#comentar textarea').val('')
	});

});


//función que llama a una api e inserta un subcomentario 
$("#addComentario form").submit(function(e){
	e.preventDefault();
	hash = $("#idComentario").val();
	url = servidor+"addSubComentario";
	comentario = $("#message-text").val();
	slug = $('input[name="slug"]').val();
	params = {id : hash, mensaje: comentario, slug: slug}


	ajax(url,"post",params, function(res){console.log(res)} );
	$('#addComentario').modal('hide');

});




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