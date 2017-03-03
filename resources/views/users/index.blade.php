@extends('admin.home')

@section('title', 'User List')

@section('content')
	<div id="content-wrapper" class="container">
		<div class="col-sm-12">
			<a id="btn_style" href="{{url('admin/user/create')}}" class='btn btn-primary btn-sm'>Create New User</a>

		</div>
		<div class="row">
			<div class="col-xs-12 col-md-12">
				@if (count($errors) > 0)
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
							<p>{{ $error }}</p>
						@endforeach
					</div>
				@endif
			</div>
		</div>
		<div id="success" class="col-xs-12 col-md-12">
			@if (Session::has('success'))
				<div class='alert alert-success'>{{ Session::get('success') }}</div>
			@endif
		</div>
		<section class="col-sm-12 table-responsive">
			<div class="panel panel-default">
				<table class="table table-striped table-bordered">
					@if(count($user)>0)
						<tr>
							<th class="text-center">
								<label id="select_all">
									<!-- checkbox to select all records -->
									{!! Form::checkbox('check_all_users', 'value', null, ['id' => 'check_all_users'])!!} 
									Select All
								</label>
							</th>
							<th class="text-center">First Name</th>
							<th class="text-center">Last Name</th>
							<th class="text-center">User Name</th>
							<th class="text-center">Email</th>
							<th class="text-center">Organisation</th>
							<th class="text-center">Last Login</th>
							<th class="text-center">Update On</th>
							<th class="text-center">User Type</th>
							<th class="text-center">Make as Admin</th>
							<th class="text-center">Status</th>

							<th></th>
						</tr>
						<!-- Started Loop for fetching records from DB (for loop) -->
						@foreach($user as $data => $value)
							<?php
							$user = Sentinel::getUser();
							$user_permissions = DB::table('users')->where('id','=',$user->id)->first();




							?>


							<tr>
								<td class="text-center">
									<!-- checkbox to select the particular records -->
									{!! Form::checkbox('user_list[]', $value->id, null, ['class' => 'user_list'])!!}
								</td>
								<td>{{ $value->first_name }}</td>
								<td>{{ $value->last_name }}</td>
								<td>{{ $value->username }}</td>
								<td>{{ $value->email }}</td>
								<td>{{ $value->organisation }}</td>
								<td>{{ $value->last_login }}</td>
								<td>{{ $value->updated_at }}</td>
								<td>
									@if($value->role_id=="1")
										Admin User
									@else
										General user
									@endif

								</td>
								<td class="text-center">
									@if($user_permissions->permissions=="admin")
									
										@if(!empty($value->role_id))
										{!! Form::checkbox('makeasadmin', $value->id, true, ['class' => 'makeasadmin user_list','data-status'=>'removeadmin'])!!}
										@else
											{!! Form::checkbox('makeasadmin', $value->id, null, ['class' => 'makeasadmin user_list','data-status'=>'addadmin'])!!}
										@endif
									@else
										@if(!empty($value->role_id))
											{!! Form::checkbox('makeasadmin', $value->id, true, ['class' => ' user_list','data-status'=>'removeadmin','disabled' => 'disabled',])!!}
										@else
											{!! Form::checkbox('makeasadmin', $value->id, null, ['class' => ' user_list','data-status'=>'addadmin','disabled' => 'disabled',])!!}
										@endif

									@endif
								</td>
								<td>


									@if($user->inRole('administrator'))
										@if($value->role_id=="1")
										@else
											@if($value->completed==1)
												<button class="btn btn-small btn-danger activator" data-id="{{$value->id}}" data-status="deactivate">Deactive</button>

											@else
												<button class="btn btn-small btn-success activator" data-id="{{$value->id}}" data-status="activate">Acivate</button>
											@endif

										@endif


									@else
										@if($value->role_id=="1")
										@else
										@if($value->completed==1)
											<button disabled class="btn btn-small btn-danger " data-id="{{$value->id}}" data-status="deactivate">Deactive</button>

										@else
											<button disabled class="btn btn-small btn-success " data-id="{{$value->id}}" data-status="activate">Acivate</button>
										@endif
										@endif

									@endif
								</td>
								<!-- we will also add show, edit, and delete buttons -->
								<td>
									<!-- show the client (uses the show method found at GET /user/{id} -->
									@if($value->role_id=="1")
										@if($user->inRole('administrator') )
											<a class="btn btn-small btn-primary btn-sm" href="{{ URL::to('admin/user/'.$value->id) }}">Show</a>

											<!-- edit this client (uses the edit method found at GET /user/{id}/edit -->
											<a class="btn btn-small btn-info btn-sm" href="{{ URL::to('admin/user/'.$value->id.'/edit') }}">Edit</a>

										@endif
									@else
									<a class="btn btn-small btn-primary btn-sm" href="{{ URL::to('admin/user/'.$value->id) }}">Show</a>

									<!-- edit this client (uses the edit method found at GET /user/{id}/edit -->
									<a class="btn btn-small btn-info btn-sm" href="{{ URL::to('admin/user/'.$value->id.'/edit') }}">Edit</a>
								   @endif
								    @if($user->inRole('administrator') )
										@if($value->role_id=="1")

										@else
											 <!-- delete the client (uses the destroy method DESTROY /user/{id} -->
												 {!! Form::open(array('class' => 'inline_form','method'=>'DELETE','url' =>'admin/user/'.$value->id)) !!}
												 {!! Form::submit('Delete', array('class' => 'btn btn-small btn-warning btn-sm')) !!}
												 {!!  Form::close() !!}
										@endif
									@else
										@if($value->role_id=="1")
										@else

										{!! Form::open(array('class' => 'inline_form','method'=>'DELETE','url' =>'admin/user/'.$value->id)) !!}
										{!! Form::submit('Delete', array('class' => 'btn btn-small btn-warning btn-sm',"disabled"=>"disabled")) !!}
										{!!  Form::close() !!}
										@endif
									@endif
								</td>
							</tr>
							@endforeach
							<!-- endfor loop -->							
							<tr>
								<td colspan="6">
									{!! Form::open(array('method'=>'POST','url' =>'admin/user/delete-all', 'id' => 'delete_wrapper_form')) !!}
										{!! Form::submit('Delete All', array('class' => 'btn btn-small btn-warning btn-sm', 'id' => 'delete_all')) !!} 
									{!!  Form::close() !!}
								</td>
							</tr>
						@else
						<tr><h4 class="text-center">Sorry!! No records found</h4></tr>
					@endif
				</table>
			</div>
		</section>
	</div>
@endsection

@section('footer')
	@parent

	<script src="{{ url('js/users/index.js') }}"></script>
	<script>
		$(document).ready(function () {
			$('.makeasadmin').change(function() {
				var user_id = $(this).val();
				var status = $(this).attr('data-status');
				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/users/make-admin")}}',
					data: {"user_id": user_id,"_token": token,"status":status},
					cache: false,
					success: function (data) {
						window.location.reload();
					}
				});


			});


			$(".activator").click(function () {

				var user_id = $(this).attr('data-id');
				var status = $(this).attr('data-status');

				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/users/active-user")}}',
					data: {"user_id": user_id,"_token": token,"status":status},
					cache: false,
					success: function (data) {
						window.location.reload();
					}
				});


			});

		});

	</script>
@endsection