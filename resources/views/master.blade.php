<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link rel="icon" href="{{url('images/favicon.ico')}}" type="image/x-icon">
    <title>@yield('title')</title>

   <link rel="stylesheet" href="{{ url('css/frontend/pretty.css') }}">
    <link rel="stylesheet" href="{{ url('css/all.css') }}">

    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/all.js') }}"></script>
    <script src="{{ url('js/common.js') }}"></script>


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @show
</head>
<body>
    @section('header')
    <div class="outer-wrpaer container-fluid">
        @include('partials.header-strip')
		@include('partials.feedback')

		   @show
        <!-- The content area seciton comes here -->
        @yield('content')
        <!-- The content area seciton comes here -->
        @include('partials.footer')
    </div>
    @section('footer')



    @show
</body>
</html>
