@extends('login-master')

@section('title', 'Login Here')

@section('header')
    @parent
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
@endsection

@section('content')

    <div class="login-box-cover">
        <div class="login-box">
            <div id="success">
                @if (Session::has('success'))
                    <div class='alert alert-success'>{{ Session::get('success') }}</div>

                @elseif (Session::has('login_error'))
                    <div class='alert alert-danger'>{{ Session::get('login_error') }}</div>
                @endif
            </div>
            <div class="date-cover">{{ date('M d') }}</div>
            <div class="time-cover"></div>
            {!! Form::open(array('url' => 'ad/check-user', 'method' => 'POST')) !!}
            <div class="login-types">
                <a class="windows-login active" title="Windows login"><img src="{{ url('images/windows_icon.png') }}" alt=""></a>
                <a href="{{ url('/user/login') }}" title="Group Login" class="ibox-login pull-right"><img src="{{ url('images/iblox-login.png')}}" alt=""></a>
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
                <div class="form-row">
                    {!! Form::submit('Login') !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>

@endsection

@section('footer')
    @parent
    <script src="{{url('js/jqClock.min.js')}}"></script>
    <script>
        $(".time-cover").clock({"format":"24","calendar":"false"});
    </script>

@endsection