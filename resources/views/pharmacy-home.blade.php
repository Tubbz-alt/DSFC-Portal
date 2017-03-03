<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=550, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <title>Pharmacy Home</title>
    @section('header')
        <link rel="stylesheet" href="{{ url('css/all.css') }}">
        <link rel="stylesheet" href="{{ url('css/pharmacy.css') }}">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    @show
</head>
<body class="pharmacy">
<div class="pharmacy-home">
    <div class="pharmacy-header">
        <a class="pharmacy-logo" href="{{ url('home') }}"><img src="{{ url('images/ibox_logo_home.png') }}" style="width: 90px;"> </a>
    </div>
    <div class="container pharmacy-content">
        <div class="pharmacy-home-tile-cover">
            <div class="pharmacy-title-inner">
                <div class="pharmacy-home-tile tile-blue">
                    <a href="{{ url('dashboard/audit/audit') }}">
                        <img src="{{ url('images/icon-sample.png') }}">
                        <span class="tile-label">Audit Dashboard</span>
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">

                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>

                <div class="pharmacy-home-tile tile-blue">
                    <a href="#">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@section('footer')
    <script src="{{ url('js/all.js') }}"></script>
@show
</body>
</html>