@extends('frontend-master')

@section('title', 'Login Here')

@section('header')
	@parent
	<link rel="stylesheet" href="{{ url('css/users/login.css') }}">
@endsection

@section('content')
<header class="super-masthead">
  <div class="container">
		<div class="header-wrapper">
		  <div class="row">
		    <div class="top-logo">
		      <hgroup class="header-strapline">
		        <a class="logo" href="http://www.england.nhs.uk"><img src="{{ url('images/nhs-england-logo-rev.svg') }}" alt="NHS Choices" title="NHS Choices Logo" /></a>
		        <h2>Reference Library Portal</h2>
		      </hgroup>
		    </div>
		  </div>
		</div>
		<nav>
			<div id="wrap" class="row nav-wrapper">
				<ul class="nav pull-left">
						<li>
							<!-- <a href="/">The Data Catalogue</a> -->
						</li>
				</ul>
			</div>
		</nav>
	</div>
</header>
	<div id="content-wrapper" class="container">
		<div class="row  margin-top-90">
			<h1 class="text-center text-white text-lato-hairline" style="visibility:hidden;">Login</h1>
			<div id="box-wrapper" class="col-xs-12 col-md-4 col-md-offset-4 bordered rounded-6 login-box">
				<h1 class="text-center">
					Log in
				</h1>
				@if (count($errors) > 0)
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
							<p>{{ $error }}</p>
						@endforeach
					</div>
				@endif
				<div id="success">
					@if (Session::has('success'))
						<div class='alert alert-success'>{{ Session::get('success') }}</div>
					@endif
				</div>


				{!! Form::open(array('url' => 'user/login', 'method' => 'POST')) !!}
					<div class="form-group">

						{!! Form::text('login', old('login', ''), array('class' => 'form-control', 'autocomplete' => 'off' ,'placeholder'=>'Username')) !!}
					</div>
					<div class="form-group">

						{!! Form::password('password', array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder'=>'Password')) !!}
					</div>
					<div class="form-group">
						<label style="padding-top: 5px;">
							{!! Form::checkbox('remember', 'true')!!}
							Remember Password
						</label>

<a class="btn btn-link " href="{{ url('user/forgot-password') }}" style="float: right;">Forgot Your Password?</a>
					</div>


					<!--<div class="form-group col-md-6 col-xs-12">
						<a class="btn btn-link " href="{{ url('user/forgot-password') }}">Forgot Your Password?</a>
					</div>-->
					<div class=" form-group col-md-12  col-xs-12 text-right">
						{!! Form::submit('Login', array('class' => 'btn btn-info login-buttons-info')) !!}
					</div>


				{!! Form::close() !!}
			</div>
		</div>
	</div>
	@include('partials.footer')
@endsection

@section('footer')
@show
