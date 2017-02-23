@extends('frontend-master')

@section('title', '404!')

@section('header')
	@parent
	<link rel="stylesheet" href="{{ url('css/frontend/home.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-lato-hairline">Sorry page not found :(</h1>
        </div>
    </div>    
@endsection