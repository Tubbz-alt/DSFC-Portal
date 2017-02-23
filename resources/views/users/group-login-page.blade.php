@extends('login-master')

@section('title', 'Login Here')

@section('header')
    @parent
    <link rel="stylesheet" href="{{ url('css/newlogin.css') }}">
    <style>
        .loader-bg {
            background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
            height: 100%;
            position: absolute;
            width: 100%;
            z-index: 1000;

        }
    </style>
@endsection

@section('content')
    <div class="loader-bg" style="display: none;">
        <span class="image-loader screen-center">

        </span>
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
    <script src="{{url('js/jqClock.min.js')}}"></script>
    <script>


        jQuery(document).ready(function () {

        jQuery(".login").on('click', function (e) {
             e.preventDefault();
                $(".loader-bg").show();
                setTimeout(function () {
                    $('form#login-form').submit();
                    $(".loader-bg").hide();

                }, 1000); // in milliseconds

            });
        });
       $(".time-cover").clock({"format":"24","calendar":"false"});
    </script>

@endsection