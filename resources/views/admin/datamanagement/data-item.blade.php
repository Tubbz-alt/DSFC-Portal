
@extends('admin.home')

@section('title', 'TNR')
@section('content')
	<div id="content-wrapper" class="container admin ">
		<div class="tabBlock">
			<ul class="tabBlock-tabs datachallenge-info">
				<li class="tabname tabBlock-tab set-tab is-active">Data Item </li>
				<li class="tabname tabBlock-tab set-tab ">Coded Value</li>
			</ul>
			<div class="tabBlock-content" >
				<div class="tabBlock-pane">
					<section class="col-sm-12 table-responsive">
						<div class="panel panel-default">
							<table class="table table-striped table-bordered">
								@if (count($dataset_dataitem) > 0)
									<tr>
										<th class="text-center ">Data Item ID   </th>
										<th class="text-center ">Data Item  </th>
										<th class="text-center ">Version </th>
										<!-- <th class="text-center "></th> -->
									</tr>
									{{--*/ $i = 0 /*--}}
									{{--*/ $j = 1 /*--}}
									{{--*/ $temp = array(); /*--}}
									@foreach ($dataset_dataitem as $data)
									<tr class='localtable stileone'>

										@if (!in_array($data->dataItemName, $temp))
											{{--*/  $i++; /*--}}
									      {{--*/ $j = 1 /*--}}
										@endif
											{{--*/ $num_padded_k = sprintf("%04d", $i); /*--}}
											{{--*/ $i_padded = sprintf("%04d", $i); /*--}}
											{{--*/ $j_padded = sprintf("%04d", $j); /*--}}

										<td class='text-center'>{{$num_padded_k}}</td>
										<td class='text-center'>{{$data->dataItemName}}</td>
										<td class='text-center' >{{$data->dataItemVersionId}}</td>
										
										<!-- <td  class="text-center">
	                                      <a class="btn btn-small btn-danger btn-sm destroydataitem"
											 href="javascript:void(0)"
											data-id="{{$data->definitionID}}" data-status="1"
											 data-table="{{$data->definitionID}}">Delete</a>
										</td> -->
									</tr>
										{{--*/  $temp[]= $data->dataItemName; /*--}}
										{{--*/  $j++; /*--}}
									@endforeach
								@else
									<tr>
										<td>
											<h4 class="text-center">No records found!</h4>
										</td>
									</tr>
								@endif
							</table>
					</section>
				</div>
				<div class="tabBlock-pane">
					<section class="col-sm-12 table-responsive">
						<div class="panel panel-default">
							<table class="table table-striped table-bordered">
								@if (count($dataset) > 0)
									<tr>
										<th class="text-center ">Data Item ID   </th>
										<th class="text-center ">Data Item  </th>
										<th class="text-center ">Coded Value  </th>
										<th class="text-center ">Coded Value Description </th>
										<th class="text-center ">Version </th>
										<th class="text-center ">Coded Values ID </th>
										<th class="text-center ">Coded Values Version ID</th>
										<th class="text-center "></th>
									</tr>
									{{--*/ $i = 0 /*--}}
									{{--*/ $j = 1 /*--}}
									{{--*/ $temp = array(); /*--}}
									@foreach ($dataset as $data)
									<tr class='localtable stileone'>

										@if (!in_array($data->dataItemName, $temp))
											{{--*/  $i++; /*--}}
									      {{--*/ $j = 1 /*--}}
										@endif
											{{--*/ $num_padded_k = sprintf("%04d", $i); /*--}}
											{{--*/ $i_padded = sprintf("%04d", $i); /*--}}
											{{--*/ $j_padded = sprintf("%04d", $j); /*--}}

										<td class='text-center'>{{$num_padded_k}}</td>
										<td class='text-center'>{{$data->dataItemName}}</td>
										<td class='text-center'>{{$data->codedValue}}</td>
										<td class='text-center' >{{$data->codedValueDescription}}</td>
										<td class='text-center' >{{$data->dataItemVersionId}}</td>
										<td class='text-center' >{{$i_padded}}.{{$j_padded}}</td>
										<td class='text-center' >{{$data->codedValueDescription}}</td>
										<td  class="text-center">
	                                      <a class="btn btn-small btn-danger btn-sm destroydataitem"
											 href="javascript:void(0)"
											data-id="{{$data->definitionID}}" data-status="1"
											 data-table="{{$data->definitionID}}">Delete</a>
										</td>
									</tr>
										{{--*/  $temp[]= $data->dataItemName; /*--}}
										{{--*/  $j++; /*--}}
									@endforeach
								@else
									<tr>
										<td>
											<h4 class="text-center">No records found!</h4>
										</td>
									</tr>
								@endif
							</table>
					</section>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('footer')
	@parent

	<script src="{{ url('js/users/index.js') }}"></script>
	<script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
	<script src="{{ url('js/jquery.bootstrap-growl.js') }}"></script>
	<script>

		
		$(document).ready(function () {

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

				$(document).on('click', '.destroydatadatabase', function (e) {
				var data_id = $(this).attr('data-id');
				var tablename = $(this).attr('data-table');
				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/destroy-database")}}',
					data: {"data_id": data_id,"_token": token,"status":status,"tablename":tablename},
					cache: false,
					success: function (data) {
						$.bootstrapGrowl("Database Deleted", // Messages
								{ // options
									type: "success", // info, success, warning and danger
									ele: "body", // parent container
									offset: {
										from: "top",
										amount: 100
									},
									align: "center", // right, left or center
									width: 250,
									delay: 1000,
									allow_dismiss: true, // add a close button to the message
									stackup_spacing: 10
								});
						$('#databasfilterdata').html(data);
					}
				});


			});
			$(".destroytnritemname").click(function () {

				var data_id = $(this).attr('data-id');
				var tablename = $(this).attr('data-table');
				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/destroy-tnritem")}}',
					data: {"data_id": data_id,"_token": token,"status":status,"tablename":tablename},
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