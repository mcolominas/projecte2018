<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" />


  <!-- iconos -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>

  <!-- Fuentes -->
  <link href="{{ asset('vendor/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('vendor/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('vendor/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('vendor/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('vendor/assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('vendor/assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('vendor/assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css" />
  
  <!-- BEGIN THEME GLOBAL STYLES -->
  <link href="{{ asset('vendor/assets/global/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
  <link href="{{ asset('vendor/assets/global/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
  
  <!-- BEGIN THEME LAYOUT STYLES -->
  <link href="{{ asset('vendor/assets/layouts/layout/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('vendor/assets/layouts/layout/css/themes/darkblue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
  <link href="{{ asset('vendor/assets/layouts/layout/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="{{ asset('css/main.css') }}" />

  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

  <!-- Código Publicidad Google AdSense -->
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({
      google_ad_client: "ca-pub-2984360403927414",
      enable_page_level_ads: true
    });
  </script>




  @section('styles')
  @show

  <title>@yield('title', config('app.name', 'Game World') )</title>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
<div class="page-wrapper">
  @include('layouts.cabecera')

  <div class="clearfix"> </div>

  <div class="page-container">
    @include('layouts.menu')

    <div class="page-content-wrapper">
      <div class="page-content">
        @yield('content')
      </div>
    </div>

    @include('layouts.pieDePagina')
</div>

  <!-- JS -->
  <script src="{{ asset('vendor/assets/global/plugins/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendor/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
  <!-- END CORE PLUGINS -->
  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <script src="{{ asset('vendor/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>
  
  <script src="{{ asset('vendor/assets/global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/horizontal-timeline/horizontal-timeline.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>

  <script src="{{ asset('vendor/assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
  <!-- END PAGE LEVEL PLUGINS -->
  <!-- BEGIN THEME GLOBAL SCRIPTS -->
  <script src="{{ asset('vendor/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
  <!-- END THEME GLOBAL SCRIPTS -->
  <!-- BEGIN PAGE LEVEL SCRIPTS -->
  <script src="{{ asset('vendor/assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
  <!-- END PAGE LEVEL SCRIPTS -->
  <!-- BEGIN THEME LAYOUT SCRIPTS -->
  <script src="{{ asset('vendor/assets/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/layouts/layout/scripts/demo.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>
  @section('scripts')
  @show
</body>
</html>