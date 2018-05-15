<ul class="navbar-nav ml-auto">
  <li class="nav-item">
    <!-- BUSCADOR -->
    <form id="formBuscar" class="form-inline my-2 my-lg-0 mr-lg-2" method="get" action="{{route('buscar')}}">
      <div class="input-group">
        <input id="location" class="form-control" type="text" placeholder="Buscar juego">
        <span class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
  </li>

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
  <li class="nav-item" id="admin">
    <a class="nav-link" href="#">Panel de Administrador</a>
  </li>
  @elseif ( Auth::user()->rol === "desarrollador")
  <li class="nav-item" id="develop">
    <a class="nav-link" href="{{ route('mainDesarrollador')}}">Panel de Desarollador</a>
  </li>
  @endif
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle mr-lg-2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

      <span>{{ Auth::user()->name }} </span>

    </a>
    <div class="dropdown-menu dropdown-menu-right">
      <a class="dropdown-item" href="{{ route('perfil') }}">
        <i class="fas fa-user"></i> Mi Perfil 
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="icon-key">
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
<script type="text/javascript">
  $(function(){
  $("#formBuscar").submit(function(e){
    e.preventDefault();
    var link = '{{route("juego",["slug" => ""])}}/' + $(this).find("input").eq(0).attr("slug");
    window.location.replace(link);
  });

  })
</script>
@endSection