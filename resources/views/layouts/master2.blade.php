<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- iconos -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
  <link href="{{ asset('vendor/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" />
  
  <!-- BEGIN THEME GLOBAL STYLES -->
  <link href="{{ asset('vendor/assets/global/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
  <link href="{{ asset('vendor/assets/global/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
  
  <!-- BEGIN THEME LAYOUT STYLES -->
  <link href="{{ asset('vendor/assets/layouts/layout/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('vendor/assets/layouts/layout/css/themes/darkblue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />

  <link rel="stylesheet" href="{{ asset('css/main.css') }}" />

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
  <script src="{{ asset('vendor/assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('vendor/assets/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
  @section('scripts')
  @show
</body>
</html>