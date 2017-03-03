@include('partials.commonfunctions')
@extends('master_home')

@section('header')
    @parent
    <link rel="stylesheet" href="{{ url('css/all.css') }}">
    <link rel="stylesheet" href="{{ url('css/pharmacy.css') }}">


@endsection

@section('title', 'Audit')

@section('content')
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

    </body>

@endsection
@section('footer')
    @parent





@endsection