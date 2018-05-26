//función ajax
function ajaxJuego(dato, params, respuesta){
	let host = "http://mcolominas.cf/GameWorld/api/juego/";
	if(params != null){
		$.ajax({
			data:params,
			dataType: 'json',
			url: host+dato,
			type: "post",
			success: respuesta,
			error: function(data) { console.log(data);}
		});
	}else{
		$.ajax({
			dataType: 'json',
			url: host+dato,
			type: "post",
			success: respuesta,
			error: function(data) { console.log(data);}
		});
	}
}

//-------------------------------------------------------------------------
//clase juego
function Juego(hash){
	this._hash = hash;
}

/*
iniciarPartida = Indica que se ha empezado la partida
success = funcion callback que se llama cuando se han obtenido todos los datos.
fail = funcion callback que se llama cuando no se han obtenido los datos.
*/
Juego.prototype.iniciarPartida = function(success, fail) {
	ajaxJuego("iniciarPartida", {hash: this._hash}, function(res){
		if(res.status == 1) success();
		else fail();
	});
};

/*
finalizarPartida = Indica que se ha finalizado la partida
success = funcion callback que se llama cuando se han obtenido todos los datos.
fail = funcion callback que se llama cuando no se han obtenido los datos.
*/
Juego.prototype.finalizarPartida = function(success, fail) {
	ajaxJuego("finalizarPartida", {hash: this._hash}, function(res){
		if(res.status == 1) success();
		else fail();
	});
};

//-------------------------------------------------------------------------
//clase Logros
/*
Logros = Constructor de logros
user = objeto usuario
*/
function Logros(user){
	this._user = user;
}

/*
cargar = obtiene todos los datos de los logros
juego = objeto juego
success = funcion callback que se llama cuando se han obtenido todos los datos.
fail = funcion callback que se llama cuando no se han obtenido los datos.
*/
Logros.prototype.cargar = function(juego, success, fail) {
	let self = this;
	ajaxJuego("getLogros", {hash: juego._hash}, function(res){
		if(res.status == 1){
			self.setLogros(res.logros);
			success();
		}else fail();
	});
};

/*
addLogro = añade un logro al jugador
hash = hash del logro que se desea comprar
success = funcion callback que se llama cuando se han obtenido todos los datos, se le pasa el logro.
fail = funcion callback que se llama cuando no se han obtenido los datos, se le pasa el logro..
*/
Logros.prototype.addLogro = function(hash, success, fail) {
	let self = this;
	ajaxJuego("addLogro", {hash: hash}, function(res){
		if(res.status == 1){
			let index = self.getIndex(res.codigo);
			if(index == -1) {
				console.log("El logro no existe");
				fail();
				return;
			}
			let logro = self.getLogro(index);
			logro.consegido = 1;
			self.setLogro(index, logro);
			self._user.addCoins(logro.coins);
			success(logro);
		}else fail();
	});
};

Logros.prototype.setLogros = function(logros) {
	this._logros = logros;
};
Logros.prototype.getLogros = function() {
	return this._logros;
};
Logros.prototype.setLogro = function(index, logros) {
	this._logros[index] = logros;
};
Logros.prototype.getLogro = function(index) {
	return this._logros[index];
};
Logros.prototype.getIndex = function(codigo) {
	for(let i = 0; i < this.getCantLogros(); i++){
		if(this.getLogro(i).codigo == codigo) return i;
	}
	return -1;
};
Logros.prototype.getCantLogros = function(index, logros) {
	return this._logros.length;
};

//-------------------------------------------------------------------------
//clase Tienda
function Tienda(user){
	this._user = user;
}

/*
cargar = obtiene todos los datos de los productos
juego = objeto juego
success = funcion callback que se llama cuando se han obtenido todos los datos.
fail = funcion callback que se llama cuando no se han obtenido los datos.
*/
Tienda.prototype.cargar = function(juego, success, fail) {
	let self = this;
	ajaxJuego("getProductos", {hash: juego._hash}, function(res){
		if(res.status == 1){
			self.setProductos(res.productos);
			success();
		}else fail();
	});
};

/*
comprar = compra un item de la tienda
codigo = codigo del item que se desea comprar
success = funcion callback que se llama cuando se han obtenido todos los datos, se le pasa el producto.
fail = funcion callback que se llama cuando no se han obtenido los datos, se le pasa el producto..
*/
Tienda.prototype.comprar = function(codigo, success, fail) {
	let self = this;
	let index = this.getIndex(codigo);
	if(index == -1) {
		console.log("El producto no existe");
		return;
	}

	let producto = this.getProducto(index);
	console.log(producto)
	ajaxJuego("comprar", {hash: producto.hash}, function(res){
		if(res.status == 1){
			producto.consegido = 1;
			self.setProducto(index, producto);
			self._user.removeCoins(producto.coste);
			success(producto);
		}else fail(producto);
	});
};
Tienda.prototype.setProductos = function(productos) {
	this._productos = productos;
};
Tienda.prototype.getProductos = function() {
	return this._productos;
};
Tienda.prototype.setProducto = function(index, producto) {
	this._productos[index] = producto;
};
Tienda.prototype.getProducto = function(index) {
	return this._productos[index];
};
Tienda.prototype.getProductoByCodigo = function(codigo) {
	return this.getProducto(this.getIndex(codigo));
};
Tienda.prototype.getIndex = function(codigo) {
	for(let i = 0; i < this.getCantProductos(); i++)
		if(this.getProducto(i).codigo == codigo) return i;
	return -1;
};
Tienda.prototype.getCantProductos = function(index, producto) {
	return this._productos.length;
};

//-------------------------------------------------------------------------
//clase Usuario
/*
callback = funcion callback que se llama cuando los coins se han modificado (opcional), recibe como parametro la cantidad de dinero despues del cambio.
*/
function Usuario(callback = null){
	this._combioCoins = callback;
}

/*
cargar = obtiene todos los datos del usuario
callback = funcion callback que se llama cuando se han obtenido todos los datos.
*/
Usuario.prototype.cargar = function(success) {
	let self = this;
	ajaxJuego("getInfoUser", null, function(res){
		if(res.status == 1){
			self._conectado = true;
			self.setNombre(res.datos.nombre);
			self.setCoins(res.datos.coins);
		}else self._conectado = false;
		success();
	});
};

Usuario.prototype.setNombre = function(nombre) {
	if(this.isConectado())
		this._nombre = nombre.toString();
};

Usuario.prototype.getNombre = function() {
	if(this.isConectado()) return this._nombre;
	else return "Invitado";
};

Usuario.prototype.setCoins = function(coins) {
	if(this.isConectado()){
		this._coins = parseInt(coins);
		if(this._combioCoins != null)
			this._combioCoins(this.getCoins())
	}
};

Usuario.prototype.addCoins = function(coins) {
	if(this.isConectado()){
		this._coins += parseInt(coins);
		if(this._combioCoins != null)
			this._combioCoins(this.getCoins())
	}
};

Usuario.prototype.removeCoins = function(coins) {
	if(this.isConectado()){
		this._coins -= parseInt(coins);
		if(this._combioCoins != null)
			this._combioCoins(this.getCoins())
	}
};

Usuario.prototype.getCoins = function() {
	if(this.isConectado()) return this._coins;
	else return 0;
};

Usuario.prototype.isConectado = function() {
	return this._conectado;
};


/*
Nota: En caso de estar no estar logeado se le asignara de nombre invitado, se le daran 0 coins y no podra recibir ningun logro.
Tutorial:

Instanciar los objetos:

var juego = new Juego("hash_del_juego");
var usuario = new Usuario(eventCambioDinero);
var tienda = new Tienda(usuario);
var logros = new Logros(usuario);
------------------------------------------------------
Cargar los datos:

loadData(function(){ //se han cargado los datos correctamente
	//Iniciar el juego
	//...

}, function(){ //Error al cargar los datos
	alert("No se han podido obtener los datos del juego.");
});

function loadData(success, fail){
	usuario.cargar(function(){
		tienda.cargar(juego, function(){
			crearTabla();
			logros.cargar(juego, function(){
				success();
			}, function(){fail();});
		}, function(){fail();});
	});
}
------------------------------------------------------
Compar un producto:

tienda.comprar("codigo_del_producto", function(producto){
	//Se ha comprado con exito

}, function(){ //Error al comprar el producto
	alert("Hubo algun error al comprar el producto.");
});
------------------------------------------------------
Dar logros:

logros.addLogro("hash_del_logro",function(logro){
	//Ha recibido el logro
	showNuevoLogro(logro);
}, function(){
	//No complio con todos los requisitos o huvo un error
	console.log("no has podido obtener un logro");
});




*/

