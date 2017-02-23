@extends('admin.home')

@section('title', 'Reference Data')
<style>
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
	.tabBlock-content {

		padding: 14px 0 !important;

	}

</style>
@section('content')

	<div  class="container admin">
		<div class="tabBlock">

			<ul class="tabBlock-tabs datachallenge-info">

				<li class="tabname tabBlock-tab set-tab is-active">
					Open</li>
				<li class="tabname tabBlock-tab set-tab ">
					Pending
				</li>
				<li class="tabname tabBlock-tab set-tab ">
					Closed
				</li>
			</ul>
			<div class="tabBlock-content" >

				<div class="tabBlock-pane">
					<table class="table table-striped table-bordered">
						@if (count($request_open) > 0)

							<thead>
							<tr>


								<th class="text-center">Database</th>
								<th class="text-center">Table Name</th>
								<th class="text-center">Data Item Name</th>
								<th class="text-center ">Data Type</th>
								<th class="text-center">Dataset Belongs</th>
								<th class="text-center ">Change Request Comments</th>
								<th class="text-center">Data Item</th>



								{{--<th class="text-center">Data Item Description  </th>--}}

								<th class="text-center invisible-data">Requirement</th>
								<th class="text-center invisible-data">Code (TBC)</th>
								<th class="text-center invisible-data">Created Date</th>
								<th class="text-center invisible-data">Status</th>
							</tr>
							</thead>
							<tbody>
							@foreach ($request_open as $pl)

								<tr>

									<td class="text-center">{{$pl->dataBaseName}}</td>
									<td class="text-center">{{$pl->tableName}}</td>
									<td class="text-center" >{{$pl->dataItemName}}</td>
									<td class="text-center">{{$pl->dataType}}</td>
									<td class="text-center ">{{$pl->datasetBelongs}}</td>
									<td class="text-center ">{{$pl->requestComments}}</td>
									<td class="text-center">{{$pl->dataItem}}</td>

									{{--<td class="text-center">{{$pl->dataItemDescription}}</td>--}}
									<td class="text-center invisible-data">{{$pl->requirement}}</td>
									<td class="text-center invisible-data">{{$pl->codeTbc}}</td>

									<td class="text-center invisible-data">{{$pl->createdDate}}</td>
									<td class="text-center invisible-data">

										@if($pl->status==1)
											<a class="btn btn-small btn-primary btn-sm " href="javascript:void(0)"
											   data-id="{{$pl->referenceDetailId}}" data-status="0">Closed</a>
										@else
											<a class="btn btn-small btn-danger btn-sm requestapproval" href="javascript:void(0)"
											   data-id="{{$pl->referenceDetailId}}" data-status="1">Open</a>
										@endif
									</td>

								</tr>
							@endforeach
							@else
								<tr>
									<td>
										<h4 class="text-center">No Change Request records found!</h4>
									</td>
								</tr>
							@endif
							</tbody>
					</table>
				</div>

				<div class="tabBlock-pane">
					<table class="table table-striped table-bordered">
						@if (count($request_pending) > 0)

							<thead>
							<tr>


								<th class="text-center">Database</th>
								<th class="text-center">Table Name</th>
								<th class="text-center">Data Item Name</th>
								<th class="text-center ">Data Type</th>
								<th class="text-center">Dataset Belongs</th>
								<th class="text-center ">Change Request Comments</th>
								<th class="text-center">Data Item</th>



								{{--<th class="text-center">Data Item Description  </th>--}}

								<th class="text-center invisible-data">Requirement</th>
								<th class="text-center invisible-data">Code (TBC)</th>
								<th class="text-center invisible-data">Created Date</th>
								<th class="text-center invisible-data">Status</th>
							</tr>
							</thead>
							<tbody>
							@foreach ($request_pending as $pending)

								<tr>

									<td class="text-center">{{$pending->dataBaseName}}</td>
									<td class="text-center">{{$pending->tableName}}</td>
									<td class="text-center" >{{$pending->dataItemName}}</td>
									<td class="text-center">{{$pending->dataType}}</td>
									<td class="text-center ">{{$pending->datasetBelongs}}</td>
									<td class="text-center ">{{$pending->requestComments}}</td>
									<td class="text-center">{{$pending->dataItem}}</td>

									{{--<td class="text-center">{{$pl->dataItemDescription}}</td>--}}
									<td class="text-center invisible-data">{{$pending->requirement}}</td>
									<td class="text-center invisible-data">{{$pending->codeTbc}}</td>

									<td class="text-center invisible-data">{{$pending->createdDate}}</td>
									<td class="text-center invisible-data">

										@if($pending->status==1)
											<a class="btn btn-small btn-primary btn-sm " href="javascript:void(0)"
											   data-id="{{$pending->referenceDetailId}}" data-status="0">Closed</a>
										@else
											<a class="btn btn-small btn-danger btn-sm requestapproval" href="javascript:void(0)"
											   data-id="{{$pending->referenceDetailId}}" data-status="1">Open</a>
										@endif
									</td>

								</tr>
							@endforeach
							@else
								<tr>
									<td>
										<h4 class="text-center">No Change Request records found!</h4>
									</td>
								</tr>
							@endif
							</tbody>
					</table>
				</div>

				<div class="tabBlock-pane">
					<table class="table table-striped table-bordered">
						@if (count($request_closed) > 0)

							<thead>
							<tr>


								<th class="text-center">Database</th>
								<th class="text-center">Table Name</th>
								<th class="text-center">Data Item Name</th>
								<th class="text-center ">Data Type</th>
								<th class="text-center">Dataset Belongs</th>
								<th class="text-center ">Change Request Comments</th>
								<th class="text-center">Data Item</th>



								{{--<th class="text-center">Data Item Description  </th>--}}

								<th class="text-center invisible-data">Requirement</th>
								<th class="text-center invisible-data">Code (TBC)</th>
								<th class="text-center invisible-data">Created Date</th>
								<th class="text-center invisible-data">Status</th>
							</tr>
							</thead>
							<tbody>
							@foreach ($request_closed as $closed)

								<tr>

									<td class="text-center">{{$closed->dataBaseName}}</td>
									<td class="text-center">{{$closed->tableName}}</td>
									<td class="text-center" >{{$closed->dataItemName}}</td>
									<td class="text-center">{{$closed->dataType}}</td>
									<td class="text-center ">{{$closed->datasetBelongs}}</td>
									<td class="text-center ">{{$closed->requestComments}}</td>
									<td class="text-center">{{$closed->dataItem}}</td>

									{{--<td class="text-center">{{$pl->dataItemDescription}}</td>--}}
									<td class="text-center invisible-data">{{$closed->requirement}}</td>
									<td class="text-center invisible-data">{{$closed->codeTbc}}</td>

									<td class="text-center invisible-data">{{$closed->createdDate}}</td>
									<td class="text-center invisible-data">

										@if($closed->status==1)
											<a class="btn btn-small btn-primary btn-sm " href="javascript:void(0)"
											   data-id="{{$closed->referenceDetailId}}" data-status="0">Closed</a>
										@else
											<a class="btn btn-small btn-danger btn-sm requestapproval" href="javascript:void(0)"
											   data-id="{{$closed->referenceDetailId}}" data-status="1">Open</a>
										@endif
									</td>

								</tr>
							@endforeach
							@else
								<tr>
									<td>
										<h4 class="text-center">No Change Request records found!</h4>
									</td>
								</tr>
							@endif
							</tbody>
					</table>
				</div>

			</div>

		</div>


	</div>



@endsection

@section('footer')
	@parent

	<script src="{{ url('js/users/index.js') }}"></script>
	<script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
	<script>
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

			$(".requestapproval").click(function () {

				var data_id = $(this).attr('data-id');
				var status = $(this).attr('data-status');

				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/change-request")}}',
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