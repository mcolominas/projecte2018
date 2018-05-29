<ul class="navbar-nav ml-auto">

  @if(!Request::is('admin*') && !Request::is('desarrollador*'))
    <li class="nav-item">
      <!-- BUSCADOR -->
      <form id="formBuscar" class="form-inline my-2 my-lg-0 mr-lg-2 " method="get" action="{{route('buscar')}}">
        <div class="input-group w-100 w-lg-auto">
          <input id="location" class="form-control" type="text" placeholder="Buscar juego">
          <span class="input-group-append">
            <button class="btn btn-primary" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
    </li>
  @endif
  <!-- Entrar/Salir -->
  @guest
  <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">Acceder</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('register') }}">Registrate</a>
  </li>
  @else
  @if ( Auth::user()->rol === "admin" )
    @if(Request::is('admin*'))
      <li class="nav-item" id="develop">
        <a class="nav-link" href="{{ route('index')}}">Volver a la página</a>
      </li>
    @else
      <li class="nav-item" id="admin">
        <a class="nav-link" href="{{ route('admin')}}">Panel de Administrador</a>
      </li>
    @endif
  @elseif ( Auth::user()->rol === "desarrollador")
    @if(Request::is('desarrollador*'))
      <li class="nav-item" id="develop">
        <a class="nav-link" href="{{ route('index')}}">Volver a la página</a>
      </li>
    @else
      <li class="nav-item" id="develop">
        <a class="nav-link" href="{{ route('desarrollador')}}">Panel de Desarollador</a>
      </li>
    @endif
  @endif
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle mr-lg-2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

      <span>{{ Auth::user()->name }}
        @if(!Request::is('admin*') && !Request::is('desarrollador*'))
          <span title="coins" style="color:gold;">
            <img class="icon" alt="coins" src="{{ asset('img/iconos/coins.png') }}">
            <span id="coins">{{Auth::user()->coins}}</span>
          </span>
        @endif
      </span>

    </a>
    <div class="dropdown-menu dropdown-menu-right">
      <a class="dropdown-item" href="{{ route('perfil') }}">
        <i class="fas fa-user"></i> Mi Perfil 
      </a>
      <a class="dropdown-item" href="{{ route('misLogros') }}">
        <i class="fas fa-trophy"></i> Mis Logros 
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i>
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
    </div>
  </li>
  @endguest
</ul>

@section("scripts")
@parent
<script type="text/javascript">
  $(function(){
    $("#formBuscar").submit(function(e){
      e.preventDefault();
      var link = '{{route("juego",["slug" => ""])}}/' + $(this).find("input").eq(0).attr("slug");
      window.location.replace(link);
    });
	@auth
		@if(!Request::is('admin*') && !Request::is('desarrollador*'))
		  setInterval(recargarCoins, 5000);
		  function recargarCoins(){
			$.ajax({
			  dataType: 'json',
			  url: "/api/juego/getInfoUser",
			  type: "post",
			  success: setCoins,
			  error: function(data) { console.log(data);}
			});
			function setCoins(res){
				if(res.status == 1)
			  $("#coins").text(res.datos.coins);
			}
		  }
		@endif
	@endauth
  })
</script>
@endSection