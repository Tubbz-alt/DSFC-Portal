@extends('frontend-master')

@section('title', 'Home Page')

@section('header')
	@parent
	<link rel="stylesheet" href="{{ url('css/frontend/home.css') }}">
@endsection

@section('content')
	<div id="content-wrapper" class="container margin-top-100">
		<h1 class="margin-top-100"><a href="{{ url('dashboard/') }}"><img src="{{ url('images/logo.png') }}" alt=""></a></h1>
		<h1 class="text-lato-hairline"><a href="{{ url('dashboard/') }}">iBox Dashboards</a></h1>
	</div>
@endsection