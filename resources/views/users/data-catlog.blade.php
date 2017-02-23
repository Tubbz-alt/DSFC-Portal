@extends('master')

@section('title', 'NHS England Reference Data')

@section('header')
    @parent
    <link rel="stylesheet" href="{{ url('css/login.css') }}">


    <style>
        .collapse {
            display: block !important;

        }

    </style>
@endsection

@section('content')

    <div class="container">
        <div class="data-catlog">


        </div>
    </div>




@endsection
<footer>
    <div class="footer-strip">
        <div class="container">
            <div class="text-left">
                <p>&copy; 2016 Intelligent Health UK Limited. All Rights Reserved. </p>

            </div>

        </div>
    </div>
</footer>
@section('footer')
    @parent


@endsection