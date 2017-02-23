@extends('login-master')

@section('title', 'Login Here')

@section('header')
    @parent
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
    <style>

        .login-form {
            background: rgba(255, 255, 255, 0.3) none repeat scroll 0 0;
            border: 1px solid #74c7ec;
            margin: 7% 0 0 -52%;
            padding: 8px;
            width: 428px;
        }

        .title {
            font-family: Pacifico;
            text-decoration: underline;
        }

        .form-footer {
            padding: 15px 40px;
        }

        .bt-login {
            background-color: #0071bd;
            color: #ffffff;
            font-size: 25px;
            height: 48px;
            padding-bottom: 10px;
            padding-top: 2px;
            transition: background-color 300ms linear 0s;
        }

        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: 6px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border: 1px solid #74c7ec;
        }

        .form-signin input[type="password"] {
            margin-bottom: 30px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border: 1px solid #74c7ec;
        }




    </style>
@endsection

@section('content')
    <div class="loader-bg" style="display: none;">
        <span class="image-loader screen-center">

        </span>
    </div>

    <div class="login-box-cover">
        <div class="container">
        <div class="login-box">
            <div class="login-form">
                <div class="login-form-img" >
                    <h1></h1>
                </div>
                {!! Form::open(array('url' => 'user/login', 'method' => 'POST','id'=>'login-form' ,'class'=>'form-signin','role'=>'form')) !!}
                {!! Form::text('login', old('login', ''), array('class' => 'form-control ', 'autocomplete' => 'off',
                   'placeholder'=>'Username','id'=>"email" )) !!}
                {!! Form::password('password', array('class' => 'form-control   disable', 'autocomplete' => 'off',
                    'placeholder'=>'Password','id'=>"password")) !!}
                {!! Form::hidden('admin', 'admin') !!}
                {!! Form::submit('Login', array('class' => 'btn btn-block bt-login')) !!}
                {!! Form::close() !!}
            </div>
        </div>
        </div>
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

    </script>

@endsection