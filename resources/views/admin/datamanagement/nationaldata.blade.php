<?php
function datatype($str){

	if ($str== "Date") {
		$str = 'date';
	}
	elseif (substr($str,0,3) == "var") {
		$str = 'Text';
	}
	elseif(substr($str,0,3) == "int"){
		$str = 'integer';
	}
	elseif(substr($str,0,3) == "big"){
		$str = 'bigint';
	}
	elseif(substr($str,0,3) == "nvar"){
		$str = 'text';
	}
	elseif(substr($str,0,3) == "dat"){
		$str = 'date';
	}
	elseif(substr($str,0,3) == "Tim"){
		$str = 'time';
	}
	elseif(substr($str,0,3) == "Dat"){
		$str = 'datetime';
	}
	/*   else{
           $str = 'Text';
       }*/
	return $str;
}

?>
@extends('admin.home')

@section('title', 'TNR')
<link rel="stylesheet" type="text/css" href="{{url('js/datepicker/jquery-ui.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('css/jquery.dataTables.min.css')}}">
<style>
	.exportdate .inputs {
		margin-top: 6px !important;
	}

	.table.table-striped.table-bordered td  {

	}
	.table.table-striped.table-bordered th {
		border-bottom: 1px solid #ccc;
	}
	.data-type tr td{
		padding: 4px !important;
		vertical-align: middle;
	}
	.data-type td:nth-child(1), .table-wrapper th:nth-child(1) {
		width:12% !important;
	}
	.data-type td:nth-child(2), .table-wrapper th:nth-child(2) {
		width:12% !important;
	}
</style>
@section('content')

	<div id="content-wrapper" class="container admin ">

		<div class="tabBlock">

			<ul class="tabBlock-tabs datachallenge-info">

				<li class="tabname tabBlock-tab set-tab is-active">
					Files </li>
				<li class="tabname tabBlock-tab set-tab ">
					Data
				</li>
			</ul>
			<div class="tabBlock-content" >

				<div class="tabBlock-pane">
					<div class="col-md-12" style="margin-top: -65px;">

						<div class="text-right">
							<a href="{{url('media/uploads/NationalDDDataItemsv10.csv')}}"
							   class="btn btn-primary btn-sm" download target="_blank">Sample </a>
							<span type="button" class="btn btn-primary btn-sm " href="javascript:void(0)"
								  data-toggle="modal"
								  data-target="#nationalcsv">Import National Data
				            </span>
						</div>




					</div>



					<section class="col-sm-12 table-responsive" >
						<div class="panel panel-default">
							<table class="table table-striped table-bordered">
								@if(count($file_info)>0)
									<tr>

										<th class="text-center">File Name</th>
										<th class="text-center">File Title</th>
										<th class="text-center">File Description</th>
										<th class="text-center">Created Date</th>
										<th class="text-center">Created By</th>
										<th class="text-center">Details</th>


									</tr>
									<!-- Started Loop for fetching records from DB (for loop) -->
									@foreach($file_info as $data => $value)


										<tr>

											<td class="text-center">{{substr( $value->filePath, 8 ) }}</td>
											<td class="text-center">{{ $value->fileTitle }}</td>
											<td class="text-center">{{ $value->fileDescription }}</td>
											<td class="text-center">{{ $value->createdDate }}</td>
											<td class="text-center">{{ $value->username }}</td>
											<td class="text-center">{{ $value->fileDescription }}</td>




										</tr>
									@endforeach
								@else
									<tr><h4 class="text-center">Sorry!! No records found</h4></tr>
								@endif
							</table>
						</div>
					</section>

				</div>

				<div class="tabBlock-pane">

					<section class="col-sm-12 table-responsive" style="margin-top: -65px;">
						<div class="panel panel-default">
							<table class="table table-striped table-bordered nationaldata">
								<thead>
								@if(count($database_table)>0)
									<tr>

										<th class="text-center">Table Name</th>
										<th class="text-center">Attr Name</th>
										<th class="text-center">Main Code Text</th>
										<th class="text-center">Main Description</th>
										<th class="text-center">Main Description 60 Chars</th>
										<th class="text-center">Is Latest</th>



									</tr>
								</thead>
									<tbody id="databasfilterdata">
									<!-- Started Loop for fetching records from DB (for loop) -->
									@foreach($database_table as $data => $tables)


										<tr>

											<td class="text-center">{{ $tables->ddItemName }}</td>
											<td class="text-center">{{ $tables->ddItemAttrName }}</td>
											<td class="text-center">{{ $tables->ddItemCodeText }}</td>
											<td class="text-center">{{ $tables->ddCodedValueDescription }}</td>
											<td class="text-center">{{ $tables->ddCodedValueDescriptionChars }}</td>
											<td class="text-center">{{ $tables->isLatest }}</td>



										</tr>
									@endforeach
									</tbody>
								@else
									<tr><h4 class="text-center">Sorry!! No records found</h4></tr>
								@endif
							</table>
						</div>
					</section>

				</div>



			</div>

		</div>






	</div>




	<!-- Modal -->
	<div id="nationalcsv" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">


				<div class="modal-body">
					<section class="col-sm-12 table-responsive margin-top-10">
						<div >

							{!! Form::open(array('url' => 'admin/reference-data/store-national-data','files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data','id'=>'wizard_form_file')) !!}


							<div>
								@if (count($errors) > 0)
									<div class="alert alert-danger">
										@foreach ($errors->all() as $error)
											<p>{{ $error }}</p>
										@endforeach
									</div>
								@endif


							</div>
							<div >
								<section>
									<div class="col-md-12">
										<div class="form-group col-md-6">
											<div class="form-group">
												{!! Form::label('filename', 'File Title') !!}
												{!! Form::text('file_title', '', array('class' => 'form-control' , 'autocomplete' => 'off','required' => 'required','id'=>'file_title')) !!}
											</div>
											<div class="form-group">
												{!! Form::label('filedescription', 'File Description') !!}
												{!! Form::text('filedescription', '', array('class' => 'form-control' , 'autocomplete' => 'off','required' => 'required','id'=>'filedescription')) !!}
											</div>
											<div class="validation error" id="subject_errors">&nbsp;</div>
											{!! Form::label('chooose file', 'Choose File') !!}
											<input type="file" name="excel-data" id="txtFileUpload">
										</div>
										<div class="form-group text-left col-md-7">
											{!! Form::submit('Upload', array('class' => 'btn btn-info')) !!}
										</div>

									</div>
								</section>

							</div>

							{!! Form::close() !!}

						</div>
					</section>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

@endsection

@section('footer')
	@parent

	<script src="{{ url('js/users/index.js') }}"></script>
	<script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
	<script src="{{ url('js/datepicker/jquery-ui.js') }}"></script>
	<script src="{{ url('js/jquery.bootstrap-growl.js') }}"></script>
	<script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
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

			$('.nationaldata').DataTable({
				"lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
				"bPaginate": true,
				"searching": true,

				"dom": '<"top"f>rt<"bottom"ilp><"clear">',
				"bFilter": false,
				"bInfo": false,
				"bAutoWidth": false,

				columnDefs: [{
					targets: "_all",
					orderable: false
				}],
				oLanguage: {
					sLengthMenu: "_MENU_",
				},






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





			$(".datatypechange").change(function () {

				var data_id = $(this).attr('data-id');
				$('#datasetbutton_'+data_id).removeAttr("disabled")
			});

			$(".savedata").click(function () {

				var data_id = $(this).attr('data-id');

				$('#datasetbutton_'+data_id).removeAttr("disabled")


				var value = $(this).parent().prev().find('select option:selected').val();



				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/data-type-change")}}',
					data: {"data_id": data_id,"_token": token,"value":value},
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