@extends('frontend-master')

@section('title', 'SignUp Here')

@section('header')
	@parent
	<link rel="stylesheet" href="{{ url('css/users/login.css') }}">
@endsection

@section('content')
	<div id="content-wrapper" class="container">
		<div class="row  margin-top-100">
			<h1 class="text-center text-white text-lato-hairline">SignUp</h1>
			<div id="box-wrapper" class="col-xs-12 col-md-4 col-md-offset-4 bordered rounded-6">
				<h1 class="text-center">
					<img src="{{ url('images/logo.png') }}" alt="Logo">
				</h1>
				@if (count($errors) > 0)
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
							<p>{{ $error }}</p>
						@endforeach
					</div>
				@endif
				{!! Form::open(array('url' => 'user/signup', 'method' => 'POST')) !!}
					<div class="form-group">
						{!! Form::label('username', 'Username') !!}
						{!! Form::text('username', '', array('class' => 'form-control' , 'autocomplete' => 'off')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('email', 'Email') !!}
						{!! Form::email('email', '', array('class' => 'form-control' , 'autocomplete' => 'off')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('first_name', 'First Name') !!}
						{!! Form::text('first_name', '', array('class' => 'form-control' , 'autocomplete' => 'off' )) !!}
					</div>
					<div class="form-group">
						{!! Form::label('last_name', 'Last Name') !!}
						{!! Form::text('last_name', '', array('class' => 'form-control', 'autocomplete' => 'off' )) !!}
					</div>
					<div class="form-group">
						{!! Form::label('password', 'Password') !!}
						{!! Form::password('password', array('class' => 'form-control', 'autocomplete' => 'off')) !!}
					</div>

					<div class="form-group">
						{!! Form::label('password_confirmation', 'Password Confirmation') !!}
						{!! Form::password('password_confirmation', array('class' => 'form-control', 'autocomplete' => 'off')) !!}
					</div>
					
					<div class="form-group text-right">
						{!! Form::submit('SignUp', array('class' => 'btn btn-info')) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
