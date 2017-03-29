@extends('master')
@section('page-title', 'Reference Library Portal')
@section('header')
	@parent
	<link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/jquery.dataTables.min.css')}}">
	<style>
		.details-hover{
			cursor: pointer; cursor: hand;
		}
		.nationalinactive{
			display: none;
		}
		.localinactive{
			display: none;
		}
		.nationalactive{
			display: block;
		}
		.localactive{
			display: block;
		}
		#wizardcsvDataModel .modal-dialog {
			margin: 30px auto;
			width: 900px;
		}
		.filter-table {
			width: 100%;
			float: left;
			margin-left: 16px;
		}
		.default_list{
			height: 300px;
			overflow-y: scroll;
		}
		.vertical.default_list {
			list-style: none;
		}
		.default_list li{
			font-size: 11px;
		}
		ARTICLE LABEL {
			background: #0072c6  none repeat scroll 0 0;
			color: white;
			display: block;
			font-size: 16px;
			font-weight: 100;
			line-height: 20px;
			padding: 10px 0 10px 10px;
			width: 100%;
		}
		.six.columns input {
			margin-left: 10px;
		}
		#recordscount > span {
			margin-left: 41px !important;
		}
		*, *::before, *::after {
			box-sizing: border-box;
		}
		#select_all {
			width: 87px;
			font-size: 12px;
		}
		.table th {
			font-size: 12px;
		}
		/*.btn.btn-primary.mapfunction {
			margin-bottom: -30px;
		}*/
		.yourDiv{
			position:absolute;
			top: 123px;
		}
		.form-group.datasetdiv {
			margin-bottom: -35px;
			position: absolute;
			z-index: 99999;
			width: 33%;
		}
		.maps{

		}
		.btn.btn-primary.btn-info-full.next-step-mapping.dataset {
			margin-right: 10px;
		}
		.list-inline.pull-right {
			margin-top: 10px;
		}
		.dataTables_wrapper .dataTables_paginate .paginate_button {

			padding: -0.5em 1em !important;

		}
		.tabBlock-content {

			padding: 10px 0 !important;

		}
		.filestatus{
			padding: 8px !important;
		}

		#myModalfileinfo .modal-body {
			height: 220px;
		}
		#myModalfileinfo  .modal-dialog {
			width: 779px;
		}
		.wizardcsvDataModelpopup{
			display: none;
		}
		.definitions-table .invisible-data{
			display:none;
		}
		.donate-now {
			list-style-type:none;
			margin:1px 0 0 0;
			padding:0;
		}

		.donate-now li {
			float:left;
			margin:0 5px 0 0;
		}

		.donate-now label {
			padding:5px;
			border:1px solid #CCC;
			cursor:pointer;
		}

		.donate-now label:hover {
			background:#DDD;
		}
		.hidedatabutton{
			display: none;
		}

	</style>

@endsection
@section('title', 'Csv Data')

@section('content')
	{{--*/ $user = Sentinel::getUser(); /*--}}
	<div class="file-data-loader">
        <span class="image-loader screen-center">
            <img src="{{ url('images/loading.gif') }}">
        </span>
		<p id="hii"></p>
	</div>

	<div id="content-wrapper" class="container">
		<section class="col-sm-12">
			<table class="table table-striped table-bordered definitions-table">
				@if (count($approved) > 0)
					<thead>
					<tr>

						<th class="text-center">Data Item Name</th>
						<th class="text-center">Coded Value Type </th>
						<th class="text-center">Show Coded Values </th>




						@if($user->inRole('administrator'))
							<th class="text-center invisible-data">Coded Value </th>
							<th class="text-center invisible-data">Coded Value Description </th>
							<th class="text-center invisible-data">Date Item ID</th>
							<th class="text-center invisible-data">Data Item Version ID </th>
							<th class="text-center invisible-data">Coded Value ID </th>
							<th class="text-center invisible-data">Coded Value Version ID  </th>
							<th class="text-center invisible-data">Author</th>
						@endif
						<th class="text-center">   </th>
						<th class="text-center">   </th>



					</tr>
					</thead>
					<tbody>
					@foreach ($approved as $approved_data)
						<tr>

							<td class="text-center">{{$approved_data->dataItemName}}</td>
							<td class="text-center" >{{$approved_data->codedValueType}}</td>
							<td class="text-center" ><span class="btn btn-primary btn-sm showhide" data-item-name="{{$approved_data->dataItemName}}" id="{{$approved_data->definitionID}}">Show</span></td>





							@if($user->inRole('administrator'))
								<td class="text-center invisible-data">{{$approved_data->codedValue}}</td>
								<td class="text-center invisible-data">{{$approved_data->codedValueDescription}}</td>
								<td class="text-center invisible-data">{{$approved_data->dataItemId}}</td>
								<td class="text-center invisible-data">{{$approved_data->dataItemVersionId}}</td>
								<td class="text-center invisible-data">{{$approved_data->codedValueId}}</td>
								<td class="text-center invisible-data">{{$approved_data->codedValueVersionId}}</td>
								<td class="text-center invisible-data">{{$approved_data->username}}</td>
							@endif
							<td class="text-center" style="width: 106px;">

                                        <span >

                                                <a href="javascript:void(0)"><span
															class="mappingdatabutton  btn-primary btn check-map check_{{$approved_data->definitionID}}"
															data-reference="{{$approved_data->definitionID}}"
															data-token="{{ csrf_token() }}">Map</span></a>

                                            </span>
							</td>





						</tr>
						<tr class="additionaldata">

							<td class="invisible-data " colspan="11" id="coded_values_{{$approved_data->definitionID}}" align="center">
								<table  class="table table-striped table-bordered definitions-table" style="width: 70%;">
									<tr style="background-color: #979797">
										<th class="text-center ">Coded Value </th>
										<th class="text-center ">Coded Value Description </th>
										<th></th>
									</tr>
									<tbody id="filterdata{{$approved_data->definitionID}}">



									</tbody>
								</table>

							</td>

						</tr>


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



	<div class="modal fade" id="commentsModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Mapping comments</h4>
				</div>
				<div class="modal-body">
					<div class="col-md-6  ">
						<input type="text" value="" id="mapping_comments" class="form-control  " placeholder="Your Comments" name="mapping_comments">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary commentsubmit" data-dismiss="modal">Submit</button>
				</div>
			</div>

		</div>
	</div>


	<div id="myModalfileinfo" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">File Details</h4>
				</div>
				<div class="modal-body">
					<div id="file_status_filter">

					</div>

				</div>

			</div>

		</div>
	</div>


	<div class="modal fade" id="mappingDataModel" tabindex="-1" role="dialog" aria-labelledby="wizardcsvDataModelLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				{!! Form::open(array('url' => 'dashboard/data-item/store-info','files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data','id'=>'wizard_form_file')) !!}


				<div class="modal-header">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							@foreach ($errors->all() as $error)
								<p>{{ $error }}</p>
							@endforeach
						</div>
					@endif
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="wizardcsvDataModelLabel">Import Data </h4>
				</div>
				<div class="modal-body">
					<section>
						<div class="wizard">
							<div class="wizard-inner">
								<div class="connecting-line"></div>
								<ul class="nav nav-tabs" role="tablist">

									<li role="presentation" class="active">
										<a href="#step1" data-toggle="tab" aria-controls="step2" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon  glyphicon-info-sign"></i>
                            </span>
										</a>
									</li>


									<li role="presentation" class="disabled">
										<a href="#step2" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
										</a>
									</li>


									<li role="presentation" class="disabled">
										<a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
										<span class="round-tab">
											<i class="glyphicon glyphicon-ok"></i>
										</span>
										</a>
									</li>
								</ul>
							</div>


							<div class="tab-content">
								<div class="tab-pane active" role="tabpanel" id="step1">

									<div class="col-md-12">
										<article>
											<label for="search">Select National or Local</label>
										</article>
										<ul class="donate-now">
											<li><label for="Local">
													<input value="Local" type="radio" id="a25" name="data_item" class="nationalfield">Local</label>
											</li>
											<li><label for="National">
													<input value="National" type="radio" id="a50" name="data_item" class="nationalfield">National</label>
											</li>
										</ul>


										<div style="width: 100%;float: left">
											<article>
												<label for="search">Select Data Set</label>
											</article>
											<div>
												<div class="map_only" style="width: 30%">
													<div class="form-group dataset-class">
														{!! Form::select('dataset_belongs',
                                                        (
                                                        [""=>"Please Select"]+['A&E' => 'A&E',
                                                        'Ambulance Services' => 'Ambulance Services',
                                                        'Inpatient' => 'Inpatient',
                                                        'Outpatients' => 'Outpatients',
                                                        'Mental Health' => 'Mental Health',
                                                        'Out of Hours' => 'Out of Hours',
                                                         '111' => '111']),'',['class' => 'form-control','id'=>'datasetbelongs']) !!}
													</div>
												</div>

											</div>
										</div>

										<div style="width: 100%;float: left">
											<article>
												<label for="search">Comments</label>
											</article>
											<div class="mapping_comments">
												<input type="text" value="" id="dataitemmapping_comments" class="form-control  dataitemmapping_comments" placeholder="Add Comments Here" name="dataitemmapping_comments">
											</div>


										</div>

										<div style="width: 100%;float: left">
											<article>
												<label for="search">Share Point Link</label>
											</article>
											<div class="sharepointlinks">
												<textarea name="form-control  sharepoinglink" id="sharepoinglink" cols="40" rows="10" value="" placeholder="Insert Share Point Link Here"></textarea>

											</div>

										</div>




										{{--<div class="datagrid" id="recordslist">
											<table class="table  table-striped table-bordered definitions-table horizontal_scroll">
												<thead>
												<tr>

													<th class="text-center">Data Item Name</th>
													<th class="text-center">Coded Value </th>
													<th class="text-center">Coded Value Type </th>
													<th class="text-center">Coded Value Description </th>


												</tr>
												</thead>
												<tbody  class="tbodyrecords_national">

												</tbody>


											</table>

										</div>--}}
									</div>
									<div class="datagrid" id="recordslist" style="display: none">
										<table class="table  table-striped table-bordered definitions-table horizontal_scroll">
											<thead>
											<tr>

												<th class="text-center">Data Item Name</th>
												<th class="text-center">Coded Value </th>
												<th class="text-center">Coded Value Type </th>
												<th class="text-center">Coded Value Description </th>


											</tr>
											</thead>
											<tbody id="tbodyrecords" class="tbodyrecords_national">

											</tbody>


										</table>


									</div>
									<ul class="list-inline pull-right localnational">
										<li><button type="button" class="btn btn-default prev-step">Previous</button></li>

										<li><button type="button" class="hidedatabutton commentsdata  btn btn-primary btn-info-full complete-wizard-final localmapping">Finish</button></li>

										<li><button type="button" class="hidedatabutton  commentsnationaldata  btn btn-primary btn-info-full next-step-mapping ">Map</button></li>
									</ul>

								</div>

								<div class="tab-pane" role="tabpanel" id="step2">
									<div class="col-md-12">
										<div id="commentry">
											<div class="col-md-6 mapping_comments localinactive">
												<input type="text" value="" id="dataitemmapping_comments" class="form-control  dataitemmapping_comments" placeholder="Your Comments" name="dataitemmapping_comments">
											</div>

											<div class="col-md-12 nationalmapping_comments nationalinactive" style="margin-top: 5px;">
												<div  class="modal-content  mymapping-content " style="width: 100%">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
																	aria-hidden="true">&times;</span></button>
														<div class="col-md-2">

														</div>
														<div class="col-md-10">

														</div>
													</div>
													<div class="modal-body rtt-popup">

														<div class="row" >

															<div class="six columns">
																<article>
																	<label for="search">National Data</label>
																	<input id="search" name="search" placeholder="Start Typing Here" type="text" data-list=".default_list" autocomplete="off">
																	<ul class="vertical default_list">
																		@foreach($dditems as $itemData)
																			<li class="col-md-12">
																				{!! Form::radio('mychoice', $itemData->itemName, '', array('class' => 'selection radio-custom mappingdata')) !!} {{ $itemData->itemName }}
																			</li>
																		@endforeach
																	</ul>
																</article>
															</div>
														</div>





													</div>
													{{--<div class="modal-footer">
                                                        <button type="button" class="btn btn-default check-status" data-dismiss="modal">Mapped as local</button>
                                                        <button type="button" class="btn btn-primary submit-form-mapping ">Map</button>
                                                    </div>--}}
												</div>
											</div>
										</div>
									</div>
									<ul class="list-inline pull-right">
										<li><button type="button" class="btn btn-default prev-step">Previous</button></li>

										<li><button type="button" class="btn btn-primary btn-info-full next-step-mapping complete-wizard-final">Next</button></li>

									</ul>

								</div>



								<div class="tab-pane" role="tabpanel" id="complete">
									<h3>Complete</h3>
									<p>You have successfully completed all steps.</p>
									<ul class="list-inline pull-right">
										<li><button type="button" class="btn btn-default prev-step">Previous</button></li>

										<li><button type="button" class="btn btn-success  btn-info-full next-step-mapping complete-mapping">Finish</button></li>
									</ul>
								</div>
								<div class="clearfix"></div>
							</div>

						</div>
					</section>

				</div>

				{!! Form::close() !!}

			</div>
		</div>
	</div>


@endsection
<div class="modal fade wizardcsvDataModelpopup" id="wizardcsvDataModel" tabindex="-1" role="dialog" aria-labelledby="wizardcsvDataModelLabel" style="overflow-y: scroll;" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			{!! Form::open(array('url' => 'dashboard/data-item/store-info','files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data','id'=>'wizard_form_file')) !!}


			<div class="modal-header">
				@if (count($errors) > 0)
					<div class="alert alert-danger">
						@foreach ($errors->all() as $error)
							<p>{{ $error }}</p>
						@endforeach
					</div>
				@endif
				<button type="button" class="close clear-importdata clear-refresh-data" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="wizardcsvDataModelLabel">Import Data </h4>
			</div>
			<div class="modal-body">
				<section>
					<div class="wizard">
						<div class="wizard-inner">
							<div class="connecting-line"></div>
							<ul class="nav nav-tabs" role="tablist">

								<li role="presentation" class="active">
									<a href="#start" data-toggle="tab" aria-controls="step1" role="tab" title="Start">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon glyphicon-file"></i>
                            </span>
									</a>
								</li>

								<li role="presentation" class="disabled">
									<a href="#step0" data-toggle="tab" aria-controls="step0" role="tab" title="Step 0">
                            <span class="round-tab">
                                <i class="glyphicon  glyphicon-info-sign"></i>
                            </span>
									</a>
								</li>


							</ul>
						</div>


						<div class="tab-content">
							<div class="tab-pane active" role="tabpanel" id="start">

								<h3>File Details</h3>
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
								</div>


								<ul class="list-inline pull-right">
									<li><button type="button" class="btn btn-default prev-step">Previous</button></li>

									<li><button type="button" class="btn btn-primary btn-info-full  filevalidation ">Next</button></li>
								</ul>

							</div>

							<div class="tab-pane " role="tabpanel" id="step0">



								<div class="col-md-12">

									<div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">

										<strong id="recordscount">  </strong>
									</div>


								</div>


								<ul class="list-inline pull-right">
									<li><button type="button" class="btn btn-default prev-step">Previous</button></li>


									<li><a href="#start" data-toggle="tab" aria-controls="step2" role="tab" title="Step 1">
											<button type="button" class="btn btn-danger prev-step clear-importdata">Cancel</button></a></li>
									<li><button type="button" class="btn btn-primary btn-info-full next-step-mapping dataset csvfinishbutton" data-dismiss="modal">Finish</button></li>
								</ul>

							</div>



							<div class="clearfix"></div>
						</div>

					</div>
				</section>

			</div>

			{!! Form::close() !!}

		</div>
	</div>
</div>


@section('footer')
	@parent
	<script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script>
	<script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('js/filter/jquery.filtertable.min.js') }}"></script>
	<script src="{{ url('js/filter/jquery.hideseek.min.js') }}"></script>
	<script src="{{ url('js/filter/initializers.js') }}"></script>
	<script src="{{ url('js/jquery.validate.min.js') }}"></script>


	<script>

		$(document).ready(function () {


			$(document).on('change', '#map_dataitem_status', function(e){
				var mapping_status =  $(this).val();
				if(mapping_status=="Map only this Data Item "){
					$('.map_only').show();
					$('.map_associated ').hide();
				}else{
					$('.map_only').hide();
					$('.map_associated').show();
				}
			});

			$('.check_all_list').on('click',function(){
				if(this.checked){
					$('.wizard_list').each(function(){
						this.checked = true;
					});
				}else{
					$('.wizard_list').each(function(){
						this.checked = false;
					});
				}
			});

			$('.clear-refresh-data').on('click',function(){
				window.location.reload();
			});


			$('#search-1').hideseek();
			$('.filtertable_mapping').DataTable( {
				"bPaginate": true,
				"bLengthChange": false,
				"bFilter": true,
				"bInfo": true,
				"bAutoWidth": false
			} );

			$("#wizard_form_file").validate({
				rules: {
					file_title: "required",
					filedescription: "required",
					txtFileUpload: "required",
				},
				messages: {
					file_title: "Please specify File Title",
					file_title: "Please specify File Desctription",
					txtFileUpload: "Please Choose File",

				}
			})


			$('.filtertable').filterTable({
				filterExpression: 'filterTableFindAll'
			});
			$('.filevalidation').click(function(e) {

				var val = $("#txtFileUpload").val();
				if(val == ''){
					alert("Please Choose File");
				}

			});

			$("#txtFileUpload").change(function(){

				var val = $("#txtFileUpload").val();
				if(val == ''){
					$('.filevalidation').addClass('disabled');
				}else{
					$('.filevalidation').removeClass('disabled').addClass('fileinfo next-step-mapping');
				}
			});

			$('.file-data-loader').hide();






			$(document).on('click', '.csvfinishbutton', function(e){

				window.location.reload();
			});$(document).on('click', '.localmapping', function(e){
				setTimeout(function () {
					window.location.reload();
				}, 2000);

			});

			$(document).on('click', 'input[name=data_item]', function(e){

				var test = $(this).val();

				if(test=="Local"){
					$('.commentsdata').removeClass('hidedatabutton ');
					$('.commentsnationaldata').addClass('hidedatabutton ');
				}
				else{
					$('.commentsnationaldata').removeClass('hidedatabutton ');
					$('.commentsdata').addClass('hidedatabutton ');
				}

			});

			$(document).on('change', '.nationalfieldsingle', function(e){
				$('#mapping_comments').val('');
				e.preventDefault();
				var value_ntn = $(this).val();
				var checked = $(this).attr('data-id');


				if(value_ntn == "Local"){


					$('#commentsModal').modal('show');
				}
				else{
					$('#mappingdataModal').modal('show');
				}

			});

			$(document).on('change', '.datasetbelongs', function(e){
				var select_data = $(this).val();
				var checked = []
				$("input[name='wizard_list[]']:checked").each(function () {
					checked.push(parseInt($(this).val()));

				});

				$("#datasetbelongs_"+checked).val(select_data);

			});


			$(document).on('change', '.datasetchange', function(e){
				jQuery('.file-data-loader').show();
				e.preventDefault();

				var checked = $(this).attr('data-id');

				var dataset = $(this).val();
				var mappinginfo =  $('.nationalfield:checked').val();
				var mappingdata =  $('.mappingdata:checked').val();
				var mappingcomments =  $('#mapping_comments').val();

				var token = "{{csrf_token()}}";
				/*$("input[name='wizard_list[]']:checked").each(function () { checked.push(parseInt($(this).val())); });
				 */
				$.ajax({
					url: "{{ url("dashboard/data-item/wizard-dataset") }}",
					data: {"dataset": dataset,"data_selected":checked,"_token": token,
						"mappinginfo":mappinginfo,"mappingdata":mappingdata,"mappingcomments":mappingcomments},
					type: 'POST',
					success: function (data) {
						$('#datasetmessage').html(data);
						jQuery('.file-data-loader').hide();
						setTimeout(function(){
							$('#datasetmessage').remove();
						}, 3000);



					}


				});
			});




			$('.nationaldatasubmit').click(function(e) {
				e.preventDefault();
				jQuery('.file-data-loader').show();
				var checked = $('select#nationalfieldsingle').attr('data-id')
				var dataset = $('select#datasetbelongs option:selected').val();
				var mappinginfo =  $('.nationalfield:checked').val();
				var mappingdata =  $('.mappingdata:checked').val();
				var mappingcomments =  $('#mapping_comments').val();

				var token = "{{csrf_token()}}";

				$.ajax({
					url: "{{ url("dashboard/data-item/wizard-data") }}",
					data: {"dataset": dataset,"data_selected":checked,"_token": token,
						"mappinginfo":mappinginfo,"mappingdata":mappingdata,"mappingcomments":mappingcomments},
					type: 'POST',
					success: function (data) {
						jQuery('.file-data-loader').hide();

					}


				});
			});



			$('.file_details_info').click(function(e) {
				var selected_id = $(this).attr('data-id')
				var token = "{{csrf_token()}}";
				$.ajax({
					url: "{{ url("dashboard/data-definitions/details") }}",
					data: {"data_selected":selected_id,"_token": token,},
					type: 'POST',
					success: function (data) {
						$('#file_status_filter').html(data);
						$('#myModalfileinfo').modal('show');


					}
				});
			});

			$('.commentsubmit').click(function(e) {
				e.preventDefault();
				jQuery('.file-data-loader').show();

				var dataset = $('select#nationalfieldsingle option:selected').val();
				var checked = $('select#nationalfieldsingle').attr('data-id');
				var mappinginfo =  $('.nationalfield:checked').val();
				var mappingdata =  $('.mappingdata:checked').val();
				var mappingcomments =  $('#mapping_comments').val();

				var token = "{{csrf_token()}}";

				$.ajax({
					url: "{{ url("dashboard/data-item/wizard-data") }}",
					data: {"dataset": dataset,"data_selected":checked,"_token": token,
						"mappinginfo":mappinginfo,"mappingdata":mappingdata,"mappingcomments":mappingcomments},
					type: 'POST',
					success: function (data) {
						$('#commentmessage').html(data);
						jQuery('.file-data-loader').hide();
						setTimeout(function(){
							$('#commentmessage').remove();
						}, 3000);

					}


				});
			});


			$('.mapfunctionality').click(function() {
				var checked = []
				$("input[name='maped_list[]']:checked").each(function () { checked.push(parseInt($(this).val())); });
				var nlinfo =  $('.nationalfield:checked').val();

				if(nlinfo == "Local"){
					$('#commentsModal').modal('show');
				}
				else{
					$('#mappingdataModal').modal('show');
				}



			});


			$('.next-step-mapping').click(function() {


				var checked = []
				$("input[name='maped_list[]']:checked").each(function () { checked.push(parseInt($(this).val())); });


				var nlinfo =  $('.nationalfield:checked').val();

				if(nlinfo == "Local"){


					$('.mapping_comments').show();
					$('.nationalmapping_comments').hide();

				}
				else{
					$('.mapping_comments').hide();
					$('.nationalmapping_comments').show();


				}

			});


			$(document).on('click', '.mappingdatabutton ', function(e){


				var checked = []
				$("input[name='wizard_list[]']:checked").each(function () {
					checked.push(parseInt($(this).val()));
				});

				checked.push(parseInt($(this).attr('data-reference')));
				var token = "{{csrf_token()}}";
				if(checked==""){
					checked = $(this).attr('data-reference');
					checked.push(checked);
					var datacount = "single";
				}else{
					var datacount = "multiple";
				}
				$('#mappingDataModel').modal('show');
				$.ajax({
					url: "{{ url("dashboard/mapping/selected-data") }}",
					data: {"data_selected":checked,"_token": token,"datacount":datacount},
					type: 'POST',
					success: function (data) {


						if(data == "Please Select Data"){
							var eachrow = "<tr class='dataqyality-issue'>"
									+ "<td class='text-center ' colspan='5'><h1 class='text-danger'>Please Select Data</h1></td>"
									+ "</tr>";
							$('#tbodyrecords').html(eachrow);
							jQuery('.file-data-loader').hide();
						}else{
							$('.dataqyality-issue').css('display','none');
							var i=0;
							$('.tbodyrecords').html("");
							$('.tbodyrecords_national').html("");
							$('#recordscount').html("");
							$.each(data, function (index, item) {
								var eachrow = "<tr>"

										+ "<td class='text-center selecteddata' style='display:none'><input class='dataitem_list' name='dataitem_list_filter[]' value=" + item['definitionID'] +" type='checkbox' checked='true'></td>"
										+ "<td class='text-center'>" + item['dataItemName'] + "</td>"
										+ "<td class='text-center'>" + item['codedValue'] + "</td>"
										+ "<td class='text-center'>" + item['codedValueType'] + "</td>"
										+ "<td class='text-center'>" + item['codedValueDescription'] + "</td>"


										+ "</tr>";
								var eachrownational = "<tr>"
										+ "<td class='text-center selecteddata' style='display:none'><input class='dataitem_list' name='dataitem_list_filter[]' value=" + item['definitionID'] +" type='checkbox' checked='true'></td>"
										+ "<td class='text-center'>" + item['dataItemName'] + "</td>"
										+ "<td class='text-center'>" + item['codedValue'] + "</td>"
										+ "<td class='text-center'>" + item['codedValueType'] + "</td>"
										+ "<td class='text-center'>" + item['codedValueDescription'] + "</td>"


										+ "</tr>";
								$('.tbodyrecords').append(eachrow);
								$('.tbodyrecords_national').append(eachrownational);
								i++;
							});
							$('#recordscount').append("<span>"+i+" Records Selected</span>");

							jQuery('.file-data-loader').hide();
							$('.filtertable_csv_modal').DataTable( {
								"bPaginate": true,
								"bLengthChange": false,
								"bFilter": true,
								"bInfo": true,
								"bAutoWidth": false
							} );


						}


					}


				});



			})





			$(document).on('click', '.complete-wizard-final', function(e){
				e.preventDefault();
				var checked = []
				var dataset = $('select#datasetbelongs option:selected').val();
				var map_dataitem_status = $('select#map_dataitem_status option:selected').val();
				var mappinginfo =  $('.nationalfield:checked').val();
				var mappingdata =  $('.mappingdata:checked').val();
				var mappingcomments =  $('#dataitemmapping_comments').val();
				var sharepointlink =  $('#sharepoinglink').val();
				$("input[name='dataitem_list_filter[]']:checked").each(function () {
					checked.push(parseInt($(this).val()));
				});

				var token = "{{csrf_token()}}";


				$.ajax({
					url: "{{ url("dashboard/data-item/wizard-data") }}",
					data: {"dataset": dataset,
						"data_selected":checked,"_token": token,
						"mappinginfo":mappinginfo,"mappingdata":mappingdata,
						"mappingcomments":mappingcomments,
						"map_dataitem_status":map_dataitem_status,
						"sharepointlink":sharepointlink,
					},
					type: 'POST',
					success: function (data) {


					}


				});



			});



			$('.showhide').click(function () {

				var id = $(this).attr('id');
				if ($(this).text() == "Show")
					$(this).text("Hide")
				else
					$(this).text("Show");


				$("#coded_values_"+id).toggleClass('invisible-data');
				var data_item = $(this).attr('data-item-name');
				var token = "{{csrf_token()}}";
				$.ajax({
					url: "{{ url("dashboard/data-item/coded-values") }}",
					data: {"_token": token,"data_id":id,"data_item":data_item},
					type: 'POST',
					success: function (data) {
						$("#filterdata"+id).html(data);



					}


				});


			});




			$(document).on('click', '.clear-importdata', function(e){
				e.preventDefault();
				var token = "{{csrf_token()}}";

				$.ajax({
					url: "{{ url("dashboard/data-item/clear-data") }}",
					data: {"_token": token,},
					type: 'POST',
					success: function (data) {
						$("#recordscount").html("");
						$("#tbodyrecords").html("");
						$('.filtertable_csv').DataTable().destroy();

					}


				});



			});

			$(document).on('click', '.complete-wizard', function(e){
				jQuery('.file-data-loader').show();
				e.preventDefault();
				var thisForm = $('#wizard_form');
				var formData = new FormData();

				var common_data = $('#wizard_form').serialize();
				var fileInputElement=jQuery("#txtFileUpload");
				var cv_file = fileInputElement[0]["files"][0];

				formData.append("excel-data", cv_file);
				formData.append("formFields",common_data);


				$.ajax({
					url: "{{ url("dashboard/data-item/wizard-data") }}",
					data: formData,
					type: 'POST',
					headers: {
						'X-CSRF-TOKEN': $('input[name=_token]').val()
					},
					contentType: false,
					processData: false,
					success: function (data) {
						jQuery('.file-data-loader').hide();
						window.location.reload();
					}

				});


			});
			$(document).on('click', '.complete-mapping', function(e){
			window.location.reload();
			});


			$(document).ready(function () {
				//Initialize tooltips
				$('.nav-tabs > li a[title]').tooltip();

				//Wizard
				$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

					var $target = $(e.target);

					if ($target.parent().hasClass('disabled')) {
						return false;
					}
				});

				$(document).on('click', '.next-step-mapping', function(e){
					var $active = $('.wizard .nav-tabs li.active');
					$active.next().removeClass('disabled');
					nextTab($active);

				});

				$(".prev-step").click(function (e) {

					var $active = $('.wizard .nav-tabs li.active');
					prevTab($active);

				});
			});

			function nextTab(elem) {
				$(elem).next().find('a[data-toggle="tab"]').click();
			}
			function prevTab(elem) {
				$(elem).prev().find('a[data-toggle="tab"]').click();
			}





		});
	</script>
@endsection
