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
		.datagrid {
			margin-bottom: 79px;
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
		.vertical.default_list {
			list-style: none;
			margin-top: 8px;
		}
		ARTICLE LABEL {
			background: #0072c6 none repeat scroll 0 0;
			color: white;
			display: block;
			font-size: 16px;
			font-weight: 100;
			line-height: 20px;
			margin-left: 7px;
			padding: 9px 0 10px 10px;
			width: 99%;
		}
		.six.columns input {
			margin-left: 10px;
		}
		.historycontent {
			width: 50%;
			margin-bottom: -27px;
		}
		.default_list li{
			font-size: 12px;
		}
        .dataset-class {
            width: 25%;
        }
		.groupstart{
			margin-right: 10px;
		}
		.groupfinal{
			margin-right: 10px;
		}
		.tabBlock-content {

			margin-top: -71px !important;
		}
		#myModalgrouping .modal-dialog {
			width: 100%;
			margin-left: 7px;
		}


	</style>


@endsection
@section('title', 'Csv Data')
@section('content')
	<div class="file-data-loader">
        <span class="image-loader screen-center">
            <img src="{{ url('images/loading.gif') }}">
        </span>

	</div>
	<div  class="container">
		<div class="col-md-12  text-right">
			<button type="button" class="btn btn-primary btn-sm wizardcsvDataModel " data-toggle="modal" data-target="#csvDataModel">Create Group</button>
		</div>
		<div class="tabBlock">
			</br>
			<ul class="tabBlock-tabs datachallenge-info">

				<li class="tabname tabBlock-tab set-tab is-active">Groups</li>
				<li class="tabname tabBlock-tab set-tab ">To Be Reviewed</li>


			</ul>
			<div class="tabBlock-content" >
				{{--mapped item--}}
				<div class="tabBlock-pane">
					<div class="datagrid">
						<table class=" table  table-striped table-bordered definitions-table horizontal_scroll">
							@if (count($grouped_data) > 0)

								<thead>
								<tr>


									<th class="text-center">Database</th>
									<th class="text-center">Table Name</th>
									<th class="text-center">Data Item Name</th>
									<th class="text-center ">Data Type</th>
									<th class="text-center">Group Name</th>

									<th class="text-center invisible-data">Created Date</th>

									<th class="text-center invisible-data">Details </th>
								</tr>
								</thead>
								<tbody>
								@foreach ($grouped_data as $pl_group)

									<tr>

										<td class="text-center">{{$pl_group->dataBaseName}}</td>
										<td class="text-center">{{$pl_group->tableName}}</td>
										<td class="text-center" >{{$pl_group->dataItemName}}</td>
										<td class="text-center">{{$pl_group->dataType}}</td>
										<td class="text-center ">{{$pl_group->localPatientID}}</td>
										<td class="text-center invisible-data">{{$pl_group->createdDate}}</td>

										<td class="text-center invisible-data">
											<a class="btn btn-small btn-primary btn-sm groupingfilter" data-status="approved" data-patientid="{{$pl_group->localPatientID}}" data-nhsnumber="{{$pl_group->nhsNumber}}" href="javascript:void(0)" >Details</a>
										</td>
									</tr>
								@endforeach
								@else
									<tr>
										<td>
											<h4 class="text-center">No Grouping records found!</h4>
										</td>
									</tr>
								@endif
								</tbody>
						</table>
					</div>
				</div>
			   {{--	pending Approval--}}
				<div class="tabBlock-pane">
					<table class=" table  table-striped table-bordered definitions-table horizontal_scroll">
						@if (count($grouped_pending) > 0)

							<thead>
							<tr>


								<th class="text-center">Database</th>
								<th class="text-center">Table Name</th>
								<th class="text-center">Data Item Name</th>
								<th class="text-center ">Data Type</th>
								<th class="text-center">Group Name</th>

								<th class="text-center invisible-data">Created Date</th>
								<th class="text-center invisible-data">Details </th>
							</tr>
							</thead>
							<tbody>
							@foreach ($grouped_pending as $pl_group_pending)

								<tr>

									<td class="text-center">{{$pl_group_pending->dataBaseName}}</td>
									<td class="text-center">{{$pl_group_pending->tableName}}</td>
									<td class="text-center" >{{$pl_group_pending->dataItemName}}</td>
									<td class="text-center">{{$pl_group_pending->dataType}}</td>
									<td class="text-center ">{{$pl_group_pending->localPatientID}}</td>

									<td class="text-center invisible-data">{{$pl_group_pending->createdDate}}</td>
									<td class="text-center invisible-data">
										<a class="btn btn-small btn-primary btn-sm groupingfilter" data-status="pending" data-patientid="{{$pl_group_pending->localPatientID}}" data-nhsnumber="{{$pl_group_pending->nhsNumber}}" href="javascript:void(0)" >Details</a>
									</td>
								</tr>
							@endforeach
							@else
								<tr>
									<td>
										<h4 class="text-center">No Grouping records found!</h4>
									</td>
								</tr>
							@endif
							</tbody>
					</table>



				</div>


		</div>




	</div>

	<!-- Modal -->
	<div class="modal fade groupingdetails" id="myModalgrouping" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Grouped Data</h4>
				</div>
				<div class="modal-body">
					<table class=" table  table-striped table-bordered definitions-table horizontal_scroll">
						<thead>
						<tr>


							<th class="text-center">Database</th>
							<th class="text-center">Table Name</th>
							<th class="text-center">Data Item Name</th>
							<th class="text-center ">Data Type</th>
							<th class="text-center">Group Name</th>
							<th class="text-center invisible-data">Created Date</th>
						</tr>
						</thead>
						<tbody id="filterdatagrouping">
						</tbody>
					</table>

				</div>

			</div>

		</div>
	</div>

	<div class="modal fade" id="wizardcsvDataModel" tabindex="-1" role="dialog" aria-labelledby="wizardcsvDataModelLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				{!! Form::open(array('url' => 'dashboard/data-wizard/store-info','files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data','id'=>'wizard_form_file')) !!}


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

								</ul>
							</div>


							<div class="tab-content">

								<div class="tab-pane active" role="tabpanel" id="step1">


										<div class="form-group col-md-7">
											{!! Form::label('localpatientid', 'Group Name') !!}
											{!! Form::text('localpatientid', '', array('class' => 'form-control' , 'autocomplete' => 'off')) !!}
										</div>
									<div class="col-md-12">

										<div class="col-md-6">
											<h5 class="text-danger" id="recordscount"></h5>
										</div>

										<div class="datagrid" id="recordslist">
											<table class="table groupingtable  table-striped table-bordered definitions-table horizontal_scroll">
												<thead>
												<tr>

													<th class="text-center">Select</th>
													<th class="text-center">Data Item Name</th>
													<th class="text-center">Coded Value </th>
													<th class="text-center">Coded Value Type </th>
													<th class="text-center">Coded Value Description </th>
													<th class="text-center">Date Item ID </th>
													<th class="text-center ">Data Item Version ID </th>
													<th class="text-center">Coded Value ID </th>
													<th class="text-center">Coded Value Version ID  </th>

												</tr>
												</thead>
												<tbody id="tbodyrecords">

												</tbody>


											</table>


										</div>


									</div>


									<ul class="list-inline pull-right groupstart">
										<li><button type="button" class="btn btn-default prev-step">Previous</button></li>


										<li><button type="button" class="groupcomplete btn btn-primary btn-info-full next-step-mapping complete-wizard-final" data-dismiss="modal ">Apply</button></li>

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


@section('footer')
	@parent

	<script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script>
	<script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('js/filter/jquery.filtertable.min.js') }}"></script>
	<script src="{{ url('js/filter/jquery.hideseek.min.js') }}"></script>
	<script src="{{ url('js/filter/initializers.js') }}"></script>
	<script src="{{ url('js/jquery.validate.min.js') }}"></script>
	<script src="{{ url('js/alert.js') }}"></script>
	<script>


		$(document).ready(function () {



			setTimeout(function () {
				$(".file-data-loader").hide();
			}, 3000);
			$('#search-1').hideseek();
			$('.filtertable_mapping').DataTable( {
				"bPaginate": true,
				"pageLength": 20,
				"bLengthChange": false,
				"bFilter": true,
				"bInfo": true,
				"bAutoWidth": false
			} );




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


			$(document).on('click', '.wizardcsvDataModel', function(e){
				var checked = []
				$("input[name='wizard_list[]']:checked").each(function () { checked.push(parseInt($(this).val())); });
				var token = "{{csrf_token()}}";
				if(checked==""){
				checked = $(this).attr('data-reference');
				var datacount = "single";
				}else{
				var datacount = "multiple";
				}

				$('#wizardcsvDataModel').modal('show');
				$.ajax({
					url: "{{ url("dashboard/grouping/selected-data") }}",
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
							$('#tbodyrecords').html("");
							$('#recordscount').html("");
							$.each(data, function (index, item) {
								var eachrow = "<tr>"
										+ "<td class='text-center'><input class='wizard_list' name='wizard_list_filter[]' value=" + item['definitionID'] +" type='checkbox'></td>"
										+ "<td class='text-center'>" + item['dataItemName'] + "</td>"
										+ "<td class='text-center'>" + item['codedValue'] + "</td>"
										+ "<td class='text-center'>" + item['codedValueType'] + "</td>"
										+ "<td class='text-center'>" + item['codedValueDescription'] + "</td>"
										+ "<td class='text-center'>" + item['dataItemId'] + "</td>"
										+ "<td class='text-center'>" + item['dataItemVersionId'] + "</td>"
										+ "<td class='text-center'>" + item['codedValueId'] + "</td>"
										+ "<td class='text-center'>" + item['codedValueVersionId'] + "</td>"

										+ "</tr>";
								$('#tbodyrecords').append(eachrow);
								i++;
							});

							jQuery('.file-data-loader').hide();
							$('.groupingtable').DataTable( {
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

			$(document).on('click', '.close', function(e){
				window.location="{{URL::to('dashboard/grouping')}}";


			});




			$(document).on('click', '.complete-wizard-final', function(e){
				e.preventDefault();
				var checked = []
				var patientid = $('#localpatientid').val();
				var nhsnumber =  $('#nhsnumber').val();
				var sex =  $('#sex:checked').val();
				var arrivalmode =  $('#arrivalmode').val();

				var token = "{{csrf_token()}}";
				$("input[name='wizard_list_filter[]']:checked").each(function () { checked.push(parseInt($(this).val())); });

				$.ajax({
					url: "{{ url("dashboard/grouping/group-data") }}",
					data: {"groupdata": checked,"patientid":patientid,"_token": token,
						"nhsnumber":nhsnumber,"sex":sex,
						"arrivalmode":arrivalmode},
					type: 'POST',
					success: function (data) {
							window.location="{{URL::to('dashboard/grouping')}}";
					}


				});



			});


			$(document).on('click', '.groupingfilter', function(e){
				e.preventDefault();

				var nhsNumber = $(this).attr('data-nhsnumber');
				var localPatientID = $(this).attr('data-patientid');
				var status = $(this).attr('data-status');

				$.ajax({
					url: "{{ url("dashboard/grouping/group-filter") }}",
					data: {"localPatientID": localPatientID,"nhsNumber":nhsNumber,"status":status
						},
					type: 'GET',
					success: function (data) {
						$('#filterdatagrouping').html(data);
						$('#myModalgrouping').modal('show');

					}


				});



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