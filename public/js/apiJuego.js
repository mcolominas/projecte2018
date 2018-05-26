//función ajax
function ajaxJuego(dato, params, respuesta){
	let host = "https://mcolominas.cf/GameWorld/api/juego/";
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
class Juego{
	constructor(hash){
		this._hash = hash;
	}

	/*
	iniciarPartida = Indica que se ha empezado la partida
	success = funcion callback que se llama cuando se han obtenido todos los datos.
	fail = funcion callback que se llama cuando no se han obtenido los datos.
	*/
	iniciarPartida(success, fail){
		ajaxJuego("iniciarPartida", {hash: this._hash}, function(res){
			if(res.status == 1) success();
			else fail();
		});

	}

	/*
	finalizarPartida = Indica que se ha finalizado la partida
	success = funcion callback que se llama cuando se han obtenido todos los datos.
	fail = funcion callback que se llama cuando no se han obtenido los datos.
	*/
	finalizarPartida(success, fail) {
		ajaxJuego("finalizarPartida", {hash: this._hash}, function(res){
			if(res.status == 1) success();
			else fail();
		});
	};
}

//-------------------------------------------------------------------------
//clase Logros
/*
Logros = Constructor de logros
user = objeto usuario
*/
class Logros{
	constructor(user){
		this._user = user;
	}

	/*
	cargar = obtiene todos los datos de los logros
	juego = objeto juego
	success = funcion callback que se llama cuando se han obtenido todos los datos.
	fail = funcion callback que se llama cuando no se han obtenido los datos.
	*/
	cargar(juego, success, fail) {
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
	addLogro(hash, success, fail) {
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

	setLogros(logros) {
		this._logros = logros;
	};
	getLogros() {
		return this._logros;
	};
	setLogro(index, logros) {
		this._logros[index] = logros;
	};
	getLogro(index) {
		return this._logros[index];
	};
	getIndex(codigo) {
		for(let i = 0; i < this.getCantLogros(); i++){
			if(this.getLogro(i).codigo == codigo) return i;
		}
		return -1;
	};
	getCantLogros() {
		return this._logros.length;
	};
}



//-------------------------------------------------------------------------
//clase Tienda
class Tienda{
	constructor(user){
		this._user = user;
	}

	/*
	cargar = obtiene todos los datos de los productos
	juego = objeto juego
	success = funcion callback que se llama cuando se han obtenido todos los datos.
	fail = funcion callback que se llama cuando no se han obtenido los datos.
	*/
	cargar(juego, success, fail) {
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
	fail = funcion callback que se llama cuando no se han obtenido los datos, se le pasa el producto.
	*/
	comprar(codigo, success, fail) {
		let self = this;
		let index = this.getIndex(codigo);
		if(index == -1) {
			console.log("El producto no existe");
			return;
		}

		let producto = this.getProducto(index);
		ajaxJuego("comprar", {hash: producto.hash}, function(res){
			if(res.status == 1){
				producto.consegido = 1;
				self.setProducto(index, producto);
				self._user.removeCoins(producto.coste);
				success(producto);
			}else fail(producto);
		});
	};
	setProductos(productos) {
		this._productos = productos;
	};
	getProductos() {
		return this._productos;
	};
	setProducto(index, producto) {
		this._productos[index] = producto;
	};
	getProducto(index) {
		return this._productos[index];
	};
	getProductoByCodigo(codigo) {
		return this.getProducto(this.getIndex(codigo));
	};
	getIndex(codigo) {
		for(let i = 0; i < this.getCantProductos(); i++)
			if(this.getProducto(i).codigo == codigo) return i;
		return -1;
	};
	getCantProductos() {
		return this._productos.length;
	};
}

//-------------------------------------------------------------------------
//clase Usuario
/*
callback = funcion callback que se llama cuando los coins se han modificado (opcional), recibe como parametro la cantidad de dinero despues del cambio.
*/
class Usuario{
	constructor(callback = null){
		this._combioCoins = callback;
	}

	/*
	cargar = obtiene todos los datos del usuario
	callback = funcion callback que se llama cuando se han obtenido todos los datos.
	*/
	cargar(success) {
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

	setNombre(nombre) {
		if(this.isConectado())
			this._nombre = nombre.toString();
	};

	getNombre() {
		if(this.isConectado()) return this._nombre;
		else return "Invitado";
	};

	setCoins(coins) {
		if(this.isConectado()){
			this._coins = parseInt(coins);
			if(this._combioCoins != null)
				this._combioCoins(this.getCoins())
		}
	};

	addCoins(coins) {
		if(this.isConectado()){
			this._coins += parseInt(coins);
			if(this._combioCoins != null)
				this._combioCoins(this.getCoins())
		}
	};

	removeCoins(coins) {
		if(this.isConectado()){
			this._coins -= parseInt(coins);
			if(this._combioCoins != null)
				this._combioCoins(this.getCoins())
		}
	};

	getCoins() {
		if(this.isConectado()) return this._coins;
		else return 0;
	};

	isConectado() {
		return this._conectado;
	};
}
