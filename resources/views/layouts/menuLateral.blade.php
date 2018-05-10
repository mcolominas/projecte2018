<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
  
  @foreach (Menu::getMenuIndex() as $categoria)
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="{{ $categoria['nombre'] }}">
    <a class="nav-link" href="{{ $categoria['url'] }}">
      <img class="icon" src="{{ $categoria['img'] }}">
      <span class="nav-link-text">{{ $categoria['nombre'] }}</span>
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