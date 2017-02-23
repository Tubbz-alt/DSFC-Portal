@extends('admin.home')

@section('title', 'Help Field List')

@section('content')
	<div id="content-wrapper" class="container">
		<section class="col-sm-12">
			<div class="section-header">
				<h1>Help Field List</h1><br>
			</div>
			<a id="btn_style" href="{{url('admin/help/create')}}" class='btn btn-primary btn-sm'>Create New</a>
		</section>
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
		<section class="col-xs-12 table-responsive">
			<div class="panel panel-default row">
				<!-- Table -->
				<table class="table table-striped table-bordered col-md-12">
					<!-- start if here -->
					@if(count($help)>0)
						<tr>
							<th class="text-center">
								<label id="select_all">
									{!! Form::checkbox('check_all_groups', 'value', null, ['id' => 'check_all_groups'])!!}
									SELECT ALL
								</label>
							</th>
							<th class="text-center">Title</th>
							<th class="text-center">Description</th>
							<th></th>
						</tr>
						<!-- Started Loop for fetching records from DB (for loop) -->
						@foreach($help as $data => $value)
						<tr>
							<td class="text-center">
								<!-- checkbox to each group (to select the purticular records -->
								{!! Form::checkbox('group_list[]', $value->id, null, ['class' => 'group_list'])!!}
							</td>
							<td>{{ $value->title }}</td>
							<td>{{ $value->description }}</td>

							<!-- we will also add show, edit, and delete buttons -->
							<td>

								<!-- edit this group (uses the edit method found at GET /group/{id}/edit -->
								<a class="btn btn-small btn-info btn-sm" href="{{ URL::to('admin/help/'.$value->id.'/edit') }}">Edit</a>

								<!-- delete the group (uses the destroy method DESTROY /group/{id} -->
								{!! Form::open(array('class' => 'inline_form','method'=>'DELETE','url' =>'admin/help/'.$value->id)) !!}
									{!! Form::submit('Delete', array('class' => 'btn btn-small btn-warning btn-sm')) !!}
								{!!  Form::close() !!}
							</td>
						</tr>
						@endforeach
						<!-- endfor loop -->
						<tr>
							<td colspan="4">
								{!! Form::open(array('method'=>'POST', 'url' =>'admin/help/delete-all','id' => 'delete_wrapper_form')) !!}
									{!! Form::submit('Delete All', array('class' => 'btn btn-small btn-warning btn-sm', 'id' => 'delete_all')) !!}
								{!!  Form::close() !!}
							</td>
						</tr>
					@else<!-- else if here -->
					<!-- put a tr with a message called "Sorry no records found!" -->
						<tr><h4 class="text-center">"Sorry no records found!"</h4></tr>
					@endif<!-- end if here -->
				</table>
			</div>
		</section>
	</div>
@endsection
@section('footer')
@parent
<script src="{{ url('js/groups/index.js') }}"></script>
<script src="{{ url('js/common.js') }}"></script>

@endsection