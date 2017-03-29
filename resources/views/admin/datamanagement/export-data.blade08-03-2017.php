@extends('admin.home')

@section('title', 'Export ')
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
	.imported{
		background: #e2e2e2;
	}
	.mapped{
		background: #d6d6d6;
	}
	.coded{
		background: #e2e2e2;
	}
	.mapping-table .invisible-data-final{
		display:none;
	}

</style>
<link rel="stylesheet" type="text/css" href="{{url('css/jquery.dataTables.min.css')}}">
@section('content')

	<div id="content-wrapper" class="container">
		<div class="col-md-12">

			<div class="text-center" style="padding-top: 50px;">
				{!! Form::open(array('url' => 'admin/reference-data/export-pages-export', 'method'=>'post')) !!}
				<span class="exportdate">Start Date: <input name="startdate" class="inputs" type="text"  id="datepicker1"></span>
				<span class="exportdate">End Date: <input name="enddate" class="inputs" type="text" id="datepicker2"></span>&nbsp;&nbsp;
				{!! Form::submit('Export to CSV', array('class' => 'btn btn-primary btn-sm')) !!}
				{!! Form::close() !!}
			</div>



		</div>

		<!-- <section class="col-sm-12 table-responsive margin-top-10">
		<table class="table table-striped table-bordered export-table" id="export-table">
			@if (count($definitions_data) > 0)

				<thead>

				<tr>
					<th class="text-center ">Definition ID </th>
					<th class="text-center ">Definition Version</th>

					<th class="text-center ">Database</th>
					<th class="text-center ">Table</th>

					<th class="text-center ">Definition Name </th>
					<th class="text-center ">Definition Description</th>
					<th class="text-center ">Data Type </th>
					<th class="text-center ">Requirement</th>

					<th class="text-center "> Code</th>
					<th class="text-center "> Code Description</th>
					<th class="text-center "> Code ID</th>
					<th class="text-center "> Code Version</th>

					<th class="text-center ">Derived</th>
					<th class="text-center ">Derivation Methodology</th>
					<th class="text-center ">Author</th>
					<th class="text-center ">Created Date</th>

					<th class="text-center ">Data Dictionary Name</th>
					<th class="text-center ">Data Dictionary Link</th>
					<th class="text-center ">Group ID</th>
					<th class="text-center ">Group Name</th>

					<th class="text-center ">Group Version</th>
					<th class="text-center ">Group Description</th>
					<th class="text-center ">Definition Type</th>
					<th class="text-center ">Field Mapping</th>

					<th class="text-center ">Code Mapping</th>
					<th class="text-center ">Upload Date</th>




				</tr>
				</thead>
				<tbody>
                {{--*/ $i = 0 ;/*--}}
                {{--*/ $j = 0 ;/*--}}
                {{--*/ $k = 0 ;/*--}}

                {{--*/ $temp = array(); /*--}}
                {{--*/ $temp2 = array(); /*--}}
                {{--*/ $temp3 = array(); /*--}}
				{{--*/  $a = count($definitions_data); /*--}}
				@foreach ($definitions_data as $key => $data)
                    @if (!in_array($data->dataItemName, $temp))
						{{--*/ $total = 1 /*--}}
                        {{--*/  $i++;
                        $total = $total + 1;
                        $reset = 0;

 						/*--}}

                    @endif

                     @if (!in_array($data->tableName, $temp2))
						{{--*/ $total2 = 1 /*--}}
                        {{--*/  $j++;
                        $total2 = $total2 + 1;
                        $reset2 = 0;

 						/*--}}

                    @endif

                    @if (!in_array($data->groupName, $temp3))
                    	@if(!empty($data->groupName))
							{{--*/ $total3 = 1 /*--}}
	                        {{--*/  $k++;
	                        $total3 = $total3 + 1;
               			 

 						/*--}}
 						@endif

                    @endif


					<tr class='localtable stileone'>

                        <td class='text-center'>{{$j}} </td>
                        <td class='text-center'>1</td>

						<td class='text-center'>{{$data->dataBaseName}}  </td>
						<td class='text-center' >{{$data->tableName}}</td>

						<td class='text-center'>{{$data->tnrItemName}}</td>
						<td class='text-center' >{{$data->tnrDataItemDescription}}</td>
						<td class='text-center' >{{$data->dataType}}</td>
						<td class='text-center' >{{$data->required}}</td>

						<td class='text-center' >{{$data->codeTbc}}</td>
						<td class='text-center' >{{$data->codeDescriptionTbc}}</td>
						<td class='text-center' >0000{{$i}}</td>
						<td class='text-center' >1</td>

						<td class='text-center' >{{$data->isDerivedItem}}</td>
						<td class='text-center' >{{$data->derivationMethodology}}</td>
						<td class='text-center' >{{$data->authorName}}</td>
						<td class='text-center' >{{$data->createdDate}}</td>

						<td class='text-center' >{{$data->dataDictionaryName}}</td>
						<td class='text-center' >{{$data->dataDictionaryLinks}}</td>
						<td class='text-center' >{{$k}}</td>
						<td class='text-center' >{{$data->groupName}}</td>

						<td class='text-center' >1</td>
						<td class='text-center' >{{$data->groupName}}</td>
						<td class='text-center' >
							@if(!empty($data->mappingInfo))
								Mapping
							@elseif(!empty($data->groupName))

									Grouping
							@elseif(!empty($data->tableName))
								column
							@else
								Reference Data
							@endif
						</td>
						<td class='text-center' ></td>
						
						<td class='text-center' ></td>
						<td class='text-center' >{{$data->updated_at}}</td>

						</tr>



                    {{--*/  $temp[]= $data->dataItemName; /*--}}
                    {{--*/  $reset++ /*--}}

                    {{--*/  $temp2[]= $data->tableName; /*--}}
                    {{--*/  $reset2++ /*--}}

	                {{--*/  $temp3[]= $data->groupName; /*--}}
	



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
		</section> -->


	</div>



@endsection

@section('footer')
	@parent

	<script src="{{ url('js/users/index.js') }}"></script>
	<script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
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

			$('#export-table').DataTable({
				"bPaginate": true,
				"bLengthChange": false,
				"bFilter": false,
				"bInfo": true,
				"bAutoWidth": false,

			});
			$(document).on('click', '.oneormoremappingfinal ', function(e){
				var id = $(this).attr('id');

				$(".coded_values_mapping_final_"+id).toggleClass('invisible-data-final');


				var checked = []
				$("input[name='wizard_list[]']:checked").each(function () {
					checked.push(parseInt($(this).val()));
				});

				checked.push(parseInt($(this).attr('data-reference')));
				var token = "{{csrf_token()}}";
				var dataitemname = $(this).attr('data-item');
				var nationalvalue = $(this).attr('data-national');
				if(checked==""){
					checked = $(this).attr('data-reference');
					checked.push(checked);
					var datacount = "single";
				}else{
					var datacount = "multiple";
				}
				$.ajax({
					url: "{{ url("admin/reference-data/selected-data-moremapping-final") }}",
					data: {"data_selected":checked,"_token": token,"datacount":datacount,
						"data_item":dataitemname,"nationalvalue":nationalvalue},
					type: 'POST',
					success: function (data) {
						$(".nationaldata").html(data);



					}


				});




			});





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

			$(".mappingapproval").click(function () {

				var data_id = $(this).attr('data-id');
				var status = $(this).attr('data-status');

				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/mapping-approval")}}',
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

			$(".destroymapping").click(function () {

				var data_id = $(this).attr('data-id');
				var dataitemname = $(this).attr('data-item');
				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/destroy-mapping-data")}}',
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