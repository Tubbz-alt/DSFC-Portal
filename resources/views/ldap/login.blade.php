@extends('login-master')

@section('title', 'Login Here')

@section('header')
    @parent
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
@endsection

@section('content')

    <div class="login-box-cover">
        <div class="login-box">
            <div class="time-cover"></div>
            {!! Form::open(array('url' => 'ad/check-user', 'method' => 'POST')) !!}
            <div class="login-types">
               {{-- <a class="windows-login active" title="Windows login"><img src="{{ url('images/windows_icon.png') }}" alt=""></a>--}}
                <a href="" title="Group Login" class="ibox-login" style="margin-left: 60px;">
                    <img width="75px" src="{{ url('images/logo.png')}}" alt="" >
                </a>
            </div>
            <div class="login-forms">
                <div class="form-row">
                    {!! Form::text('login', old('login', ''), array('class' => 'form-control user-name', 'autocomplete' => 'off')) !!}
                </div>
                <div class="form-row">
                    {!! Form::password('password', array('class' => 'form-control password', 'autocomplete' => 'off')) !!}
                    <span style="display: none;">
                    {!! Form::checkbox('remember', 'true', array('style'=>'display:none'))!!}
                    </span>
                </div>
                <div class="form-row form-row-submit-butt">
                    {!! Form::submit('Login') !!}
                </div>
            </div>
            {!! Form::close() !!}
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

@endsection