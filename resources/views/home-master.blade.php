<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=550, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <title>@yield('title')</title>
    @section('header')
        <link rel="stylesheet" href="{{ url('css/all.css') }}">
        <link rel="stylesheet" href="{{ url('css/slider-ibox.css') }}">
        <link rel="stylesheet" href="{{ url('css/jquery.flipster.css') }}">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    @show
</head>
<body  class="ibox_slider_cover">
@yield('content')

@section('footer')
    <script src="{{ url('js/all.js') }}"></script>

@show
</body>
</html>