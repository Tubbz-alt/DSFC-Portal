<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{url('images/favicon.ico')}}" type="image/x-icon">
     <link rel="stylesheet" type="text/css" href="{{url('css/main/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ url('css/all.css') }}">
    @section('header')
    <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="{{url('css/main/ie8-and-down.css')}}">
    <script src="{{url('js/main/html5shiv.js')}}"></script>
    <script src="{{url('js/main/respond.min.js')}}"></script>
    <![endif]-->

    <!--[if lte IE 7]>
    <link rel="stylesheet" href="{{url('css/main/font-awesome-ie7.css')}}" type="text/css"/>
    <![endif]-->

    @show
  </head>
  <body>
  <div class="outer-wrpaer container-fluid">
  @include('partials.header-strip')
    <!-- The content area seciton comes here -->
    @yield('content')
    <!-- The content area seciton comes here -->
    </div>
    @section('footer')
      <script src="{{ url('js/main/jquery-1.11.3.js') }}"></script>
      <script src="{{ url('js/main/bootstrap.js') }}"></script>
      @include('partials.content-footer')
    @show
  </body>
  </html>
