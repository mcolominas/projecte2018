<ul class="navbar-nav ml-auto">
  <li class="nav-item">
    <!-- BUSCADOR -->
    <form class="form-inline my-2 my-lg-0 mr-lg-2">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for...">
        <span class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
  </li>

  <!-- Entrar/Salir -->
  @guest
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle mr-lg-2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span>Acceder</span>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="#">
          Login 
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">
          Registrate
        </a>
      </div>
    </a>
  </li>
  @else
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle mr-lg-2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

      <span>{{ Auth::user()->name }} </span>

    </a>
    <div class="dropdown-menu dropdown-menu-right">
      <a class="dropdown-item" href="#">
        <i class="fas fa-user"></i> Mi Perfil 
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
      </a>
    </div>
  </li>
  @endguest
</ul>