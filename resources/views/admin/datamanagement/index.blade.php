@extends('admin.home')

@section('title', 'Reference Data')
<link rel="stylesheet" type="text/css" href="{{url('js/datepicker/jquery-ui.css')}}">
<style>
	.exportdate .inputs {
		margin-top: 6px !important;
	}

	.chat-window{
		bottom:0;
		position:fixed;
		float:right;
		margin-left:10px;
	}
	.chat-window > div > .panel{
		border-radius: 5px 5px 0 0;
	}
	.icon_minim{
		padding:2px 10px;
	}
	.msg_container_base{
		background: #e5e5e5;
		margin: 0;
		padding: 0 10px 10px;
		max-height:300px;
		overflow-x:hidden;
	}
	.top-bar {
		background: #666;
		color: white;
		padding: 10px;
		position: relative;
		overflow: hidden;
	}
	.msg_receive{
		padding-left:0;
		margin-left:0;
	}
	.msg_sent{
		padding-bottom:20px !important;
		margin-right:0;
	}
	.messages {
		background: white;
		padding: 10px;
		border-radius: 2px;
		box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
		max-width:100%;
	}
	.messages > p {
		font-size: 13px;
		margin: 0 0 0.2rem 0;
	}
	.messages > time {
		font-size: 11px;
		color: #ccc;
	}
	.msg_container {
		padding: 10px;
		overflow: hidden;
		display: flex;
	}
	img {
		display: block;
		width: 100%;
	}
	.avatar {
		position: relative;
	}
	.base_receive > .avatar:after {
		content: "";
		position: absolute;
		top: 0;
		right: 0;
		width: 0;
		height: 0;
		border: 5px solid #FFF;
		border-left-color: rgba(0, 0, 0, 0);
		border-bottom-color: rgba(0, 0, 0, 0);
	}

	.base_sent {
		justify-content: flex-end;
		align-items: flex-end;
	}
	.base_sent > .avatar:after {
		content: "";
		position: absolute;
		bottom: 0;
		left: 0;
		width: 0;
		height: 0;
		border: 5px solid white;
		border-right-color: transparent;
		border-top-color: transparent;
		box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
	}

	.msg_sent > time{
		float: right;
	}



	.msg_container_base::-webkit-scrollbar-track
	{
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		background-color: #F5F5F5;
	}

	.msg_container_base::-webkit-scrollbar
	{
		width: 12px;
		background-color: #F5F5F5;
	}

	.msg_container_base::-webkit-scrollbar-thumb
	{
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		background-color: #555;
	}

	.btn-group.dropup{
		position:fixed;
		left:0px;
		bottom:0;
	}
	.filestatus {
		padding: 8px !important;
	}

</style>
@section('content')
	<div id="content-wrapper" class="container">
		<section class="col-sm-12">
			<div class="section-header-admin">
				<h1 class="col-md-6">Reference Data</h1>

				<div class="text-right">
					{!! Form::open(array('url' => 'admin/reference-data/export-pages-imported', 'method'=>'post')) !!}
					<span class="exportdate">Start Date: <input name="startdate" class="inputs" type="text"  id="datepicker1"></span>
					<span class="exportdate">End Date: <input name="enddate" class="inputs" type="text" id="datepicker2"></span>&nbsp;&nbsp;
					{!! Form::submit('Export to CSV', array('class' => 'btn btn-primary btn-sm')) !!}
					{!! Form::close() !!}
				</div>



			</div>
		</section>
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
					@if(count($file_info)>0)
						<tr>

							<th class="text-center">File Title</th>
							<th class="text-center">File Description</th>
							<th class="text-center">Created Date</th>
							<th class="text-center">Created By</th>
							{{--<th class="text-center">Comment</th>--}}
							<th class="text-center">Details</th>
							<th class="text-center">Approved Date</th>
							<th class="text-center">Status</th>
							<th></th>
						</tr>
						<!-- Started Loop for fetching records from DB (for loop) -->
						@foreach($file_info as $data => $value)


							<tr>

								<td class="text-center">{{ $value->fileTitle }}</td>
								<td class="text-center">{{ $value->fileDescription }}</td>
								<td class="text-center">{{ $value->createdDate }}</td>
								<td class="text-center">{{ $value->username }}</td>
								{{--<td class="text-center">{{ $value->commentText }}</td>--}}

								<td class="text-center"><a href="{{url('admin/reference-data/details/'.$value->conceptReferenceDataId)}}" 	class="patient-detail-hover details-hover">Details</a></td>
								<!-- we will also add show, edit, and delete buttons -->
								<td width="15%">
									@if($value->status==1)
										<span class="alert text-danger " href="javascript:void(0)"
										   data-id="{{$value->conceptReferenceDataId}}" data-status="0">{{ date('jS M G:i A', strtotime($value->updatedDate)) }}</span>
									@endif
								</td>
								<td  class="text-center">
									<!-- show the client (uses the show method found at GET /user/{id} -->
									@if($value->status==1)
									<a class="btn btn-small btn-primary btn-sm " href="javascript:void(0)"
									   data-id="{{$value->conceptReferenceDataId}}" data-status="0">Approved</a>

								   @else
										<a class="btn btn-small btn-danger btn-sm csvapproval" href="javascript:void(0)"
										   data-id="{{$value->conceptReferenceDataId}}" data-status="1">Pending Approval</a>
									@endif

									<!-- edit this client (uses the edit method found at GET /user/{id}/edit -->

								{{--	<!-- delete the client (uses the destroy method DESTROY /user/{id} -->
									{!! Form::open(array('class' => 'inline_form','method'=>'DELETE','url' =>'admin/user/'.$value->id)) !!}
							        	{!! Form::submit('Resubmit', array('class' => 'btn btn-small btn-warning btn-sm')) !!}
							        {!!  Form::close() !!}--}}
								</td>
								<td>
									<a class="btn btn-small btn-info btn-sm" href="#" data-toggle="modal" data-target="#commentModel_{{ $value->conceptReferenceDataId }}">Comments</a>
									<a class="btn btn-small btn-danger btn-sm destroydata" href="javascript:void(0)"
									   data-id="{{$value->conceptReferenceDataId}}" data-status="1">Delete</a>
								</td>


							</tr>




										<!-- Comment Modal -->
							<div id="commentModel_{{$value->conceptReferenceDataId }}" class="modal fade" role="dialog">
								<div class="modal-dialog">

									<!-- Modal content-->
									<div class="modal-content">
										<div class="row chat-window col-xs-5 col-md-12" id="chat_window_1">
											<div class="col-xs-12 col-md-12">
												<div class="panel panel-default">
													<div class="panel-heading top-bar">
														<div class="col-md-8 col-xs-8">
															<h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> NHS DATA Comments</h3>
														</div>
														<div class="col-md-4 col-xs-4" style="text-align: right;">
															<a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
															<a href="#"><span class="glyphicon glyphicon-remove icon_close close" data-id="chat_window_1" data-dismiss="modal"></span></a>
														</div>
													</div>

													<div class="panel-body msg_container_base">
														@foreach($reply_comments as $reply)

															@if($reply->referenceDetailId ==$value->referenceDetailId)
																@if($reply->userId == Sentinel::check()->id)
																	<div class="row msg_container base_sent">
																		<div class="col-md-10 col-xs-10">
																			<div class="messages msg_sent">
																				<p>{{$reply->commentText}} </p>
																				<time datetime="2009-11-13T20:00">{{date('Y F d G:i A', strtotime($reply->commentedDate))}}</time>
																			</div>
																		</div>
																		<div class="col-md-2 col-xs-2 avatar">
																			<img src="{{url('images/avatar.jpg')}}" class=" img-responsive ">
																			<p>{{$reply->userName}} </p>
																		</div>
																	</div>
																@else
																	<div class="row msg_container base_receive">
																		<div class="col-md-2 col-xs-2 avatar">
																			<img src="{{url('images/avatar.jpg')}}" class=" img-responsive ">
																			<p>{{$reply->userName}} </p>
																		</div>
																		<div class="col-md-10 col-xs-10">
																			<div class="messages msg_receive">
																				<p>{{$reply->commentText}} </p>
																				<time datetime="2009-11-13T20:00">{{date('Y F d G:i A', strtotime($reply->commentedDate))}}</time>
																			</div>
																		</div>
																	</div>
																@endif
															@endif
														@endforeach

														<div class="panel-footer">
															<div class="input-group">
																<input  class="form-control input-sm chat_input working_comments" placeholder="Write your message here..." type="text" id="working_comment_{{$value->conceptReferenceDataId}}">
																<span class="input-group-btn">
                                                                 <button class="btn btn-primary btn-sm commentbtn" id="btn-chat" @if(!empty($reply->parentCommentId))data-parent-comment-id="{{$reply->parentCommentId}}" @endif data-referenceid="{{$value->conceptReferenceDataId}}" data-commentid ="{{$value->commentId }}" value="{{$value->conceptReferenceDataId }}">Send</button>
                                                                </span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>

							@endforeach

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
	<script src="{{ url('js/datepicker/jquery-ui.js') }}"></script>
	<script>
		$( function() {
			$( "#datepicker1" ).datepicker({
				dateFormat: "yy-mm-dd"
			});
			$( "#datepicker2" ).datepicker({
				dateFormat: "yy-mm-dd"
			});
		} );
		$(document).ready(function () {
			$(".csvapproval").click(function () {

				var data_id = $(this).attr('data-id');
				var status = $(this).attr('data-status');

				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/data-approval")}}',
					data: {"data_id": data_id,"_token": token,"status":status},
					cache: false,
					success: function (data) {
						window.location.reload();
					}
				});


			});
			$(".destroydata").click(function () {

				var data_id = $(this).attr('data-id');
				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/destroy")}}',
					data: {"data_id": data_id,"_token": token,"status":status},
					cache: false,
					success: function (data) {
						window.location.reload();
					}
				});


			});

			$(".commentbtn").click(function () {

				var data_id = $(this).val();
				var data_parent_comment_id = $(this).attr('data-parent-comment-id');

				var comments = $('#working_comment_'+data_id).val();


				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/comments")}}',
					data: {"data_id": data_id,"_token": token,"comments":comments,"data_parent_comment_id":data_parent_comment_id},
					cache: false,
					success: function (data) {
						$('.working_comments').val('');
						window.location.reload();
					}
				});


			});

		});

	</script>
@endsection