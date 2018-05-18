const servidor = "http://127.0.0.1:8000/api/";

var url,method,params,respuesta;




$('form').on( "submit", function(e){
	e.preventDefault();
	var formData = new FormData(this);
		
	url = ""
	method = "post"
	params = formData
	respuesta = function(){alert('funciona')}

	ajax(url,method,params,respuesta)



});


//función ajax
function ajax(url, method, params, respuesta){
	$.ajax({
		data:params,
		dataType: 'json',
		mimetype: "multipart/form-data"
		url: url,
		type: method,
		success: respuesta,
		error: function(data) { console.log(data);}
	});
}



//mimetype: "multipart/form-data"