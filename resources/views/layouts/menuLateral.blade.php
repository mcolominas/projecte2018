<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
  <?php
  if(Request::is('desarrollador*'))
    $menu = Menu::menuDesarollador();
  else if(Request::is('admin*'))
    $menu = Menu::menuAdministrador();
  else
    $menu = Menu::menuCategorias();
  ?>
  @foreach ($menu as $item)
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="{{ $item['nombre'] }}">
    <a class="nav-link" href="{{ $item['url'] }}">
      <img class="icon" src="{{ $item['img'] }}">
      <span class="nav-link-text">{{ $item['nombre'] }}</span>
    </a>
  </li>
  @endforeach
</ul>

<ul class="navbar-nav sidenav-toggler">
  <li class="nav-item">
    <a class="nav-link text-center" id="sidenavToggler">
      <i class="fa fa-fw fa-angle-left"></i>
    </a>
  </li>
</ul>