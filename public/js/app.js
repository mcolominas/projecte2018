function Files(){
	this.files = {"html": [], "css": [], "js": []};
}

Files.prototype.add = function(type, name, success, buttons = true, content = "") {
	console.log(content)	
	let self = this;
	try{
		if(!isset(type)) throw {message: "El tipo de fichero no puede estar vacio."};
		if(!isset(name)) throw {message: "El nombre del fichero no puede estar vacio."};
		switch(type){
			case "html":
			case "css":
			case "js":
			break;
			default:
			throw {message: "Tipo de formato " + type + " no es aceptado."};
		}
		if(existName(type, name)) throw {message: "Ya existe un fichero con el nombre: " + name};

		this.files[type].push(name)

		let collapse = $("#collapse"+type+" > div > div");
		let sortableItem = getSortableItem(type, name);


		let fileEditor = $("#file-editor > div");
		let fileEditorItem = getFileEditorItem(type, name, content);

		collapse.append(sortableItem);
		fileEditor.append(fileEditorItem);
		success();
	}catch(err){
		var divAlert = $("#file-name-modal div[role=alert]");
		divAlert.removeClass("d-none");
		divAlert.text(err.message);
	}

	//private functions
	function existName(type, name){
		return self.files[type].indexOf(name) != -1;
	}

	function isset(text){
		return text != null && text != "undefined" && text != "";
	}

	function getSortableItem(type, name){
		let divParent = $("<div>");
		let a = $('<a class="list-group-item list-group-item-action p-1 '+type+'" tipo='+type+' href="#'+type+'-'+name+'" name="'+name+'" role="tab">'+name+'</a>');
		a.click(changeTab);

		if(buttons){
			var divOptions = $('<div class="absolue-rigth active">');
			var buttonDelete = $('<button type="button" data-type="'+type+'" class="delete btn btn-link">');
			buttonDelete.click(eventClickBtnRemove);
			var iconDelete = $('<i class="material-icons">delete</i>');
			var buttonEdit = $('<button type="button" id="btn'+type+name+'" data-type="'+type+'" class="edit btn btn-link">');
			buttonEdit.on("click", eventClickBtnEdit);
			var iconEdit = $('<i class="material-icons">mode_edit</i>');
		}

		if(buttons){
			buttonDelete.append(iconDelete);
			buttonEdit.append(iconEdit);
			divOptions.append(buttonDelete);
			divOptions.append(buttonEdit);
			divParent.append(a);
			divParent.append(divOptions);
		}else divParent.append(a);

		return divParent;
	}

	function getFileEditorItem(type, name, content){
		let num = $('#collapse' + type + " .buttons").children().length;
		if(type == "html") num = "";
		let divParent = $('<div class="tab-pane" id="'+type+'-'+name+'">');
		let inputOculto = $('<input hidden id="'+name+'" value="'+name+'" name="name'+type+num+'">');
		let textarea = $('<textarea type="'+type+'" name="'+type+num+'" placeholder="Aquí va tu código '+type+'" required>'+content+'</textarea>');

		textarea.keyup(updateIframe);
		divParent.append(inputOculto)
		divParent.append(textarea);

		return divParent;
	}

	//events
	function eventClickBtnEdit(e){
		openModalFileNameEdit();
		var object = $(e.currentTarget).parent().parent().find('a')
		var tipo = object.attr('tipo');
		var name = object.attr('name');

		$('#file-name-edit-modal form').submit(function(e){
			if(object[0].name === name){
				realizarSubmit(e,object,tipo,name)
			}

		})

	}

	//se ejecuta cuando se da al botón eliminar
	function eventClickBtnRemove(e){
		//openModalFileNameEdit();

		var tipo = $(this).parent().parent().find('a').attr('tipo')
		var name = $(this).parent().parent().find('a').attr('name')
		removeFile(tipo,name)

	}
};

Files.prototype.update = function(type, name, success){

}

var systemFiles = new Files();

function compile() {
	if($("input[name=namehtml]").length == 0)
	systemFiles.add("html", "index", function(){}, false, "");
	//add events
	$("#file-menu .sortable" ).on( "sortupdate", function(){
		updateIframe();
		orderNames($(this).find('a').attr('tipo'));
	} );
	$("#file-menu .sortable").sortable({
		revert: true,
		axis: "y"
	});
	$("#file-menu button.add").click(function(e){
		e.preventDefault();
		let type = $(this).attr("data-type");
		openModalFileName(type);
	});
	$("#file-name-modal form").submit(function(e){
		e.preventDefault();
		var modal = $(this).closest(".modal");
		var type = modal.find("#file-type").val();
		var name = modal.find("#file-name").val();
		systemFiles.add(type, name, function(){
			modal.modal('hide');
		})

	});


	$('#creando').removeClass("show");
	$('#creando').addClass("d-none");
	$('#urlExterna').attr('required');

	$('#creando textarea').removeAttr('required');
	$('#urlExterna').show()
};

function getHtmlCode(search = "#collapsehtml"){
	var id = $(search + " a").attr("href");
	return $(id + " textarea").val();
}

function getCssCode(search = "#collapsecss"){
	var tagStart = "<style>";
	var tagClose = "</style>\n";
	var codeCss = "";
	$(search + " a").each(function(index) {
		var id = $(this).attr("href");
		codeCss += tagStart + $(id + " textarea").val() + tagClose;
	});
	return codeCss;
}

function getJsCode(search = "#collapsejs"){
	var tagStart = "<script>";
	var tagClose = "</script>\n";
	var codeJs = "";
	$(search + " a").each(function(index) {
		var id = $(this).attr("href");
		codeJs += tagStart + $(id + " textarea").val() + tagClose;
	});
	return codeJs;
}

//events functions
function changeTab(e){
	e.preventDefault()
	var parent = $(this).closest('[role="tablist"]');
	parent.find('[role="tab"]').removeClass("active ui-sortable-handle");
	$(this).addClass("active ui-sortable-handle");

	var target = $($(this).attr("href"));
	parent = target.closest('[role="tab-content"]');
	parent.find('.show.active').removeClass("show active");
	target.addClass("show active");
}

function updateIframe(e){
	var frame = document.getElementById("code");
	var code = frame.contentDocument || frame.contentWindow.document;

	code.open();
	code.writeln(getHtmlCode() + getCssCode()+ getJsCode() + "");
	code.close();
}

//Open modals
function openModalFileName(type = ""){
	var modal = $("#file-name-modal");
	modal.find("div[role=alert]").removeClass("d-none");
	modal.find("div[role=alert]").addClass("d-none");
	modal.find("#file-type").val(type);
	modal.find("#file-name").val("");
	modal.modal('show');
}

function openModalFileNameEdit(type = ""){
	var modal = $("#file-name-edit-modal");
	modal.find("div[role=alert]").removeClass("d-none");
	modal.find("div[role=alert]").addClass("d-none");
	modal.find("#file-type").val(type);
	modal.find("#file-name").val("");
	modal.modal('show');
}

//ordena los textareas
function orderNames(type){
	var i = 0;
	var array = $('.'+type)

	for(i;i<array.length;i++){
		var name = array[i].name
		var id = type+"-"+name
		//cambia valores del input hidden
		$(array.eq(i).attr("href")).find("input").attr('id',name)
		$(array.eq(i).attr("href")).find("input").attr('value',name)
		$(array.eq(i).attr("href")).find("input").attr('name','name'+type+i)

		//cambia atributos del textarea
		$(array.eq(i).attr("href")).find("textarea").attr('name',type+i)

		//cambia el id del div padre
		$(array.eq(i).attr("href")).attr("id",id)
	}
	
}

// Elimina el fichero y ordena de nuevo los textareas
function removeFile(type,name){
	var id = type + "-" + name

	//elimina el textarea y su padre (Div)
	$('#'+id).empty()
	$('#'+id).remove()

	//elimina el botón y sus padres/hermano
	$('a[name='+name+']').parent().empty()
	$('a[name='+name+']').parent().remove()


	//reordena los botones 
	orderNames(type)
	
}


function realizarSubmit(e,object,tipo,name){

	
	var valor = $('#file-name-edit-modal #file-name');

	if($('[name='+valor.val()+']').length > 0){
		alert('Ese nombre ya existe')
		return;
	}else{

		object.attr('name',valor.val())
		object.text(valor.val())

	//ordena los textareas
	orderNames(tipo)

	object.attr('href','#'+tipo+'-'+object.attr('name'))

	valor.val("")
	$('#file-name-edit-modal').modal('hide');
}	

}
$('input[name=tipo]').click(function(e){
	//MUESTRA HTML,CSS,JS
	if(e.target.value == "creado" && e.target.checked == true){
		$('#urlExterna').hide()
		$('#creando textarea').attr('required');
		
		$('#urlExterna').removeAttr('required');
		$('#creando').removeClass("d-none");
		$('#creando').addClass("show");
	}
	//MUESTRA INPUT URL
	else if(e.target.value == "url" && e.target.checked == true){
		$('#creando').removeClass("show");
		$('#creando').addClass("d-none");
		$('#urlExterna').attr('required');

		$('#creando textarea').removeAttr('required');
		$('#urlExterna').show()
	}	
})

