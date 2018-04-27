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
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/main.css') }}" />

  <!-- iconos -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>

  @section('styles')
  @show

  <title>@yield('title', config('app.name', 'Game World') )</title>
</head>
<body>
  @include('layouts.cabecera')

  @include('layouts.menu')

  <div class="container-fluid">    
    <div class="row">
      <div class="col-md-12">
        @yield('content')
      </div>
    </div>
  </div>

  @include('layouts.pieDePagina')

  <!-- JS -->
  <script src="{{ asset('vendor/jquery/js/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

  @section('scripts')
  @show
</body>
</html>