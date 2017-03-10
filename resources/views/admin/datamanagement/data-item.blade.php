@extends('admin.home')

@section('title', 'Data Item')
<link rel="stylesheet" type="text/css" href="{{url('js/datepicker/jquery-ui.css')}}">
<style>
	.exportdate .inputs {
		margin-top: 6px !important;
	}
</style>

@section('content')
	<div id="content-wrapper" class="container">

		<div class="col-md-12">


			<div class="text-right">
				{!! Form::open(array('url' => 'admin/reference-data/export-pages-data-item', 'method'=>'post')) !!}
				<span class="exportdate">Start Date: <input name="startdate" class="inputs" type="text"  id="datepicker1"></span>
				<span class="exportdate">End Date: <input name="enddate" class="inputs" type="text" id="datepicker2"></span>&nbsp;&nbsp;
				{!! Form::submit('Export to CSV', array('class' => 'btn btn-primary btn-sm')) !!}
				{!! Form::close() !!}
			</div>

		</div>

		<section class="col-sm-12 table-responsive margin-top-10">

			<div class="panel panel-default ">

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
									<td class='text-center'>0000{{$i}}</td>
									<td class='text-center'>{{$data->dataItemName}}</td>
									<td class='text-center'>{{$data->codedValue}}</td>
									<td class='text-center' >{{$data->codedValueDescription}}</td>
									<td class='text-center' >{{$data->dataItemVersionId}}</td>
									<td class='text-center' >0000{{$i}}.0000{{$j}}</td>
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
			</div>
		</section>

		<!-- Modal -->
		<div class="modal fade" id="myModalnationaldata" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>

					</div>
					<div class="modal-body">
						<div id="nationaldata">

						</div>

					</div>

				</div>

			</div>
		</div>
	</div>



@endsection

@section('footer')
	@parent
	<script src="{{ url('js/all.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script>
	<script src="{{ url('js/datepicker/modernizr.js') }}"></script>
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
			$(document).on('click', '.oneormoremappingfinal', function(e){
				var id = $(this).attr('id');


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
					url: "{{ url("admin/reference-data/selected-data-moremapping-dataitem") }}",
					data: {"data_selected":checked,"_token": token,"datacount":datacount,
						"data_item":dataitemname,"nationalvalue":nationalvalue},
					type: 'POST',
					success: function (data) {
						$("#nationaldata").html(data);
						$('#myModalnationaldata').modal('show');


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


			$(".destroydataitem").click(function () {

				var data_id = $(this).attr('data-id');
				var tablename = $(this).attr('data-table');
				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/destroy-data-item")}}',
					data: {"data_id": data_id,"_token": token,"status":status,"tablename":tablename},
					cache: false,
					success: function (data) {
						window.location.reload();
					}
				});


			});

		});

	</script>
@endsection