//función que llama a un ajax 
var url = "";
$("#addComentario form").submit(function(e){
	e.preventDefault();
	var hash = $("#idComentario").val()
	if(hash == ""){
		url = "http://localhost:8000/api/addComentario";
	}else{
		url = "http://localhost:8000/api/addSubComentario";
	}
	var comentario = $("#message-text").val();
	var params = {id : hash, mensaje: comentario}
	var respuesta = function(){alert("funciona");};


	ajax(url,"POST",params,respuesta)
	$('#addComentario').modal('hide')

});

//función general ajax
function ajax(url, method, params, respuesta){
	$.ajax({
		data:params,
		dataType: 'json',
		cors: true,
		timeout: 5000,
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