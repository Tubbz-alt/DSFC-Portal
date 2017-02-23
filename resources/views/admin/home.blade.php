@extends('admin')

@section('title', 'Admin Area')
@section('top-right-menu')
	<a href="{{ url('dashboard') }}">
		<button type="button" class="btn btn-primary margin-top-10">Back to Dashboard</button>
	</a>
	<style>
		.bottom {
			font-size: 20px;
			margin-top: 10px;
			padding-bottom: 20px;
			text-align: center;
		}
	</style>
@endsection
@section('content')
	<div id="content-wrapper" class="container">


		


	</div>
@endsection



