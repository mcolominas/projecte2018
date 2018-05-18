function Files(){
	this.files = {"html": [], "css": [], "js": []};
}

Files.prototype.add = function(type, name, success, buttons = true) {
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
		let fileEditorItem = getFileEditorItem(type, name);

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
		let a = $('<a class="list-group-item list-group-item-action p-1" href="#'+type+'-'+name+'" name="'+name+'" role="tab">'+name+'</a>');
		a.click(changeTab);

		if(buttons){
			var divOptions = $('<div class="absolue-rigth active">');
			var buttonDelete = $('<button type="button" data-type="'+type+'" class="delete btn btn-link">');
			buttonDelete.click(eventClickBtnRemove);
			var iconDelete = $('<i class="material-icons">delete</i>');
			var buttonEdit = $('<button data-type="'+type+'" class="edit btn btn-link">');
			buttonEdit.click(eventClickBtnEdit);
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

	function getFileEditorItem(type, name){
		let num = $('#collapse' + type + " .buttons").children().length;
		if(type == "html") num = "";
		let divParent = $('<div class="tab-pane" id="'+type+'-'+name+'">');
		let textarea = $('<textarea type="'+type+'" name="'+type+num+'" placeholder="Aquí va tu código '+type+'">');

		textarea.keyup(updateIframe);

		divParent.append(textarea);

		return divParent;
	}

	//events
	function eventClickBtnEdit(e){
		openModalFileNameEdit();
	}

	function eventClickBtnRemove(e){
		//openModalFileNameEdit();
		
	}
};

Files.prototype.update = function(type, name, success){

}

var systemFiles = new Files();

function compile() {
	systemFiles.add("html", "index", function(){}, false);
	//add events
	$("#file-menu .sortable" ).on( "sortupdate", updateIframe );
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

compile();