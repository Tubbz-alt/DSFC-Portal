@extends('admin.home')

@section('title', 'Create Group')

@section('content')
	<div id="content-wrapper" class="container">
		<div class="section-header">
			<h1>Create Group</h1>
		</div>
		<!-- error or success message -->
	<div class="row">
		<div class="col-xs-12 col-md-12">
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
	    </div>
    </div>
		
		{!! Form::open(array('method'=>'post','url' => 'admin/group')) !!}
			@include('partials.groups-form')
			<div class="form-group row">
				<div class="col-xs-12 text-right">
					{!! Form::submit('CREATE', array('class' => 'btn btn-primary btn-sm')) !!}
				</div>
			</div>
		{!! Form::close() !!}
	</div>
@endsection
@section('footer')
@parent
<script src="{{ url('js/groups/autofill.js') }}"></script>
@endsection
