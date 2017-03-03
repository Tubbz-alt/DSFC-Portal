<!DOCTYPE html>
<html @if (isset($valuelanguage)&& $valuelanguage=="ar") lang="ar" dir="rtl"
      @elseif (isset($valuelanguage)&& $valuelanguage=="en")  lang="en" dir="ltr"
      @elseif (isset($valuelanguage)&& $valuelanguage=="es")  lang="es" dir="ltr"
      @elseif (isset($valuelanguage)&& $valuelanguage=="fr")  lang="fr" dir="ltr" @endif>
<head>
    <meta charset="utf-8">
    <meta name="google-site-verification" content="YQB4H_muIxzbRPbOSzfStcsBrpvZI2ThRoVu5QBc4qM"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <title>Login | 3i Healthcare </title>
    @section('header')
        <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('css/login.css') }}">
        @if (isset($valuelanguage)&& $valuelanguage=="ar")
            <link rel="stylesheet" href="{{ url('css/stylear.css') }}">
        @else
            <link rel="stylesheet" href="{{ url('css/style.css') }}">
        @endif
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="shortcut icon" href="{{url('images/favicon.ico') }}">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    @show
    <script type="text/javascript">
        if (screen.width <= 768) {
            // window.location.href = "http://demo.3ihealthcare.co.uk/" + window.location.pathname
        }
    </script>
    <style>

        body {
            background: url('images/admin_login.png') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-color: #fff;
        }
		

        p {
            color: #fff;
        }
        .login-form-img {


        }
        .login-form {
            background: rgba(255, 255, 255, 0.3) none repeat scroll 0 0;
            width: 430px;
            margin: 10% 0 0 25%;
            padding: 20px;
            border: 1px solid #74c7ec;
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

        .login-form input[type="submit"] {

        }

        .login-message {
            width: 380px;
            margin: 5% auto 0;
        }

        i {
            margin-right: 4%;
            color: #555555
        }

        a {
            text-decoration: none;
            color: #555555;
        }

        @media (max-width: 320px) {
            .login-form {
                width: 150px !important;
            }
        }

        @media (min-width: 322px) and (max-width: 800px) {
            .login-form {
                width: 200px !important;
            }

        }

        @media (min-width: 320px) and (max-width: 1023px) {
            body {
                background: url('images/admin_login.png') no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                background-color: #fff;
            }
        }

        @media (min-width: 1024px) and (max-width: 1360px) {
            body {
                background: url('images/admin_login.png') no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                background-color: #fff;
            }
        }

        @media (min-width: 1361px) and (max-width: 1960px) {
            body {
                background: url('images/admin_login.png') no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                background-color: #fff;
            }
        }

    </style>
</head>
<body>


<section class="admincontenthome contenthome_admin ">

    <div class="container">
        <div class="login-message"></div>
        <div class="login-form">
            <!--<div class="login-form-img"> <img src="{{url('images/opra-text-right.png')}}"></div>-->
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


    {{--<div id="content-wrapper" class="container">
        <div class="row  margin-top-100">
            <div id="box-wrapper" class="col-xs-8 col-md-4 col-md-offset-4 bordered rounded-6">


                {!! Form::open(array('url' => 'user/login', 'method' => 'POST','id'=>'login-form')) !!}
                <div class="form-group col-md-10 col-xs-12 col-md-offset-1">
                    {!! Form::text('login', old('login', ''), array('class' => 'form-control login-text', 'autocomplete' => 'off',
                    'placeholder'=>'Username')) !!}
                </div>
                <div class="form-group col-md-10 col-md-offset-1 col-xs-12">

                    {!! Form::password('password', array('class' => 'form-control password-text ', 'autocomplete' => 'off',
                    'placeholder'=>'Password')) !!}
                    {!! Form::hidden('admin', 'admin') !!}
                </div>
                <div class="form-group col-md-10 col-xs-12" style="display: none;">
                    <label>
                        {!! Form::checkbox('remember', 'true', 'true')!!}
                        Remember Password
                    </label>
                </div>
                <div class=" form-group col-md-12 col-xs-12 col-md-offset-1">
                    {!! Form::submit('Login', array('class' => 'btn btn-primary login-button-text col-md-10 col-xs-12')) !!}
                </div>


                {!! Form::close() !!}
                <div id="success">
                    @if (Session::has('success'))
                        <div class='alert alert-success'>{{ Session::get('success') }}</div>
                    @endif
                </div>
                <div class = "alert alert-error">

                </div>


            </div>
        </div>
    </div>--}}

</section>
</body>
<script src="{{ url('js/all.js') }}"></script>
<script>


    jQuery(document).ready(function () {

        /*        jQuery(".login-button-text").on('click', function (e) {

         if($(".admincontenthome").hasClass('contenthome_error')){
         $(".admincontenthome").removeClass('contenthome_error');
         $(".admincontenthome").addClass('contenthome_admin');
         }

         $("#rotate_login").addClass('contenthome_rotate');
         $(".rotate_image").css('display', 'block');
         e.preventDefault();
         setTimeout(function () {                $(".rotate_image").css('display', 'none');
         $('form#login-form').submit();

         }, 1000); // in milliseconds


         });*/
    });

</script>

</html>