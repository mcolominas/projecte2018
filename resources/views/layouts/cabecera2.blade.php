 <!-- BEGIN HEADER -->
 <div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{ route('index') }}">
                <img src="{{ asset('vendor/assets/layouts/layout/img/logo.png') }}" alt="logo" class="logo-default" /> </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li id="buscador">

                        <form>
                            <input type="text" placeholder="Search..." required>
                            <input type="button" value="Search">
                        </form>
                    </li>
                    @guest
                    <li id="login"><a href="{{ route('login') }}">Login</a></li>
                    <li id="register"><a href="{{ route('register') }}">Register</a></li>
                    @else
                    @if ( Auth::user()->rol === "admin" )
                    <li id="admin"><a href="#">Panel de Administrador</a></li>
                    @elseif ( Auth::user()->rol === "desarrollador")
                    <li id="develop"><a href="#">Panel de Desarollador</a></li>
                    @endif

                    <li id="dropdown" class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> {{ Auth::user()->name }}  </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{ route('perfil') }}">
                                    <i class="icon-user"></i> Mi Perfil </a>
                                </li>

                                <li class="divider"> </li>

                                <li>
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i> Cerrar Sesión </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                        @endguest
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
