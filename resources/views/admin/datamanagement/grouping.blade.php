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

</style>
@section('content')

	<div  class="container">
		<div class="col-md-12">

			<div class="text-right">
				{!! Form::open(array('url' => 'admin/reference-data/export-pages-grouping', 'method'=>'post')) !!}
				<span class="exportdate">Start Date: <input name="startdate" class="inputs" type="text"  id="datepicker1"></span>
				<span class="exportdate">End Date: <input name="enddate" class="inputs" type="text" id="datepicker2"></span>&nbsp;&nbsp;
				{!! Form::submit('Export to CSV', array('class' => 'btn btn-primary btn-sm')) !!}
				{!! Form::close() !!}
			</div>



		</div>
		<section class="col-sm-12 table-responsive margin-top-10">
		<table class="filtertable_definitions table  table-striped table-bordered definitions-table horizontal_scroll">
			@if (count($definitions_data) > 0)

				<thead>
				<tr>



					<th class="text-center">Data Item Name</th>
					<th class="text-center ">Data Type</th>
					<th class="text-center">Group Name</th>
					<th class="text-center ">Group Type</th>


					<th class="text-center invisible-data">Created Date</th>
					<th class="text-center invisible-data"></th>

				</tr>
				</thead>
				<tbody>
				@foreach ($definitions_data as $pl)

					<tr>


						<td class="text-center" >{{$pl->dataItemName}}</td>
						<td class="text-center">{{$pl->codedValueType}}</td>
						<td class="text-center ">{{$pl->groupName}}</td>
						<td class="text-center ">{{$pl->groupType}}</td>


						<td class="text-center invisible-data">{{$pl->createdDate}}</td>
						<td  class='text-center' style='vertical-align:middle;'>
							<a class="btn btn-small btn-danger btn-sm destroygrouping"
							   href="javascript:void(0)"
							   data-id="{{$pl->groupId}}" data-status="1"
							   data-item="{{$pl->groupName}}">Delete</a>
						</td>

					</tr>
				@endforeach
				@else
					<tr>
						<td>
							<h4 class="text-center">No Mapping records found!</h4>
						</td>
					</tr>
				@endif
				</tbody>
		</table>
		</section>

	</div>



@endsection

@section('footer')
	@parent

	<script src="{{ url('js/users/index.js') }}"></script>
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

			$(".groupingapproval").click(function () {

				var data_id = $(this).attr('data-id');
				var status = $(this).attr('data-status');

				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/grouping-approval")}}',
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

			$(".destroygrouping").click(function () {

				var data_id = $(this).attr('data-id');
				var dataitemname = $(this).attr('data-item');
				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/destroy-grouping-data")}}',
					data: {"data_id": data_id,"_token": token,"status":status,"dataitemname":dataitemname},
					cache: false,
					success: function (data) {
						window.location.reload();
					}
				});


			});

		});

	</script>
@endsection