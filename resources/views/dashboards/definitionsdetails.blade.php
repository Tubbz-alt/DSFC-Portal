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
		.rtt-hdr-col{
			background: #d0e9c6 !important;
		}
		.tabBlock-content {

			padding: 14px 0 !important;

		}
		.bg-yellow{
			background: #ffff00;
		}



		.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {

			padding: 7px !important;

		}


		.dd-item-table td:nth-child(1), .dd-item-table th:nth-child(1) {
			width: 4%;
		}
		.dd-item-table td:nth-child(2), .dd-item-table th:nth-child(2) {
			width: 8%;
		}
		.dd-item-table td:nth-child(3), .dd-item-table th:nth-child(3) {
			width: 8%;
		}





		.definitions-table .invisible-data{
			display:none;
		}
		.view-more{
			cursor: pointer;
		}

		/*.check-status{
			display:none;
		}*/

		.rtt-popup {
			height: 300px;
			overflow-y: scroll;
		}

		#mymapping .modal-title {
			color: #888888;
		}

		.alert.alert-info {
			margin: 10px;
		}

		.performance_percentage.green {
			color: #398439 !important;
		}

		.modal-body.rtt-popup > ul {
			list-style: none;
		}
		.mymapping-content{
			width: 50%;
			margin: 0 auto;

		}
		#livefilter-list a {
			color: black;
			text-decoration: none;
		}
		.filtertable td {
			font-size: 12px;
		}
		.datagrid {
			overflow-x: scroll;
			margin-bottom: 14px !important;
		}
		.historycontent {
			width: 50%;
			margin-bottom: -27px;
		}
	</style>


@endsection
@section('title', 'Csv Data')
@section('content')
	<div  class="container">

        <div >
            <div >
                <div class="container">
                    <div class="section-header">
                        <h2>File Details</h2>


                    </div>
                </div>
                <!--patients details strats-->

                <!--dtls-row starts-->

                <div class="col-md-10 col-md-offset-1">
                    <div class="dtls-row">
                        <div class="col-md-4">
                            <div class="dtls-row-head">Import date and time</div>
                            <div class="dtls-row-content">{{$file_info->createdDate}}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="dtls-row-head">User details </div>
                            <div class="dtls-row-content">{{$file_info->username}}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="dtls-row-head">Status </div>
                            <div class="dtls-row-content">
                                @if($file_info->status==0)
                                    <span class="alert text-danger ">
														Pending
									</span>
                                @else
                                    <span class="alert text-success " >
														Approved
									</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--dtls-row ends-->

                    <!--dtls-row starts-->
                    <div class="dtls-row">
                        <div class="col-md-4">
                            <div class="dtls-row-head">Approved By</div>
                            <div class="dtls-row-content">Admin</div>
                        </div>
                        <div class="col-md-4">
                            <div class="dtls-row-head">Total number of records uploaded</div>
                            <div class="dtls-row-content">{{$total_records}}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="dtls-row-head">Any data quality issues</div>
                            <div class="dtls-row-content">
                                @if($file_info->qualityIssues==1)
                                    <span class="alert text-danger ">
														Yes
									</span>
                                    {{$file_info->qualityIssuesCount}}
                                @else
                                    <span class="alert text-success " >
														No
									</span>
                                @endif


                            </div>
                        </div>
                    </div>
                    <!--dtls-row ends-->



                </div>
                <!--patients details ends-->

            </div>
        </div >


	</div>




	<div class="modal fade" id="checkMap" tabindex="-1" role="dialog" aria-labelledby="Check Mapping">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				{!! Form::open(array('url' => '','method'=>'post')) !!}
				<div class="modal-header">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							@foreach ($errors->all() as $error)
								<p>{{ $error }}</p>
							@endforeach
						</div>
					@endif
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="CheckMapping">Comment</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						{!! Form::label('mapping_comment', 'Comment') !!}
						{!! Form::textarea('mapping_comment', null, ['class' => 'form-control mapping_comment']) !!}

					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
						<input type="button" class="btn btn-primary marked-local" value="Save"/>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="local_commentmodal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Commentary </h4>
				</div>
				<div class="modal-body">
					<section>
						<div class="wizard">
							<div class="wizard-inner">
								<div class="connecting-line"></div>
								<ul class="nav nav-tabs" role="tablist">

									<li role="presentation" class="active">
										<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
										</a>
									</li>

									<li role="presentation" class="disabled">
										<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
										</a>
									</li>
									<li role="presentation" class="disabled">
										<a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
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
							{!! Form::open(array('method'=>'POST','url' =>'admin/user/delete-all', 'id' => 'mapping_information')) !!}

							<div class="tab-content">
								<div class="tab-pane active" role="tabpanel" id="step1">
									<h3>Dataset this belongs</h3>
									<div class="col-md-12">
										<div class="form-group col-md-6">
											{!! Form::select('dataset',
                                            (
                                            ['A&E' => 'A&E',
                                            'Ambulance' => 'Ambulance',
                                            'Inpatient' => 'Inpatient',
                                            'Mental Health' => 'Mental Health',
                                            'Out of Hours' => 'Out of Hours',
                                             '111' => '111']),'',['class' => 'form-control']) !!}
										</div>
									</div>


									<ul class="list-inline pull-right">
										<li><button type="button" class="btn btn-default prev-step">Previous</button></li>

										<li><button type="button" class="btn btn-primary btn-info-full next-step-mapping">Next</button></li>
									</ul>

								</div>
								<div class="tab-pane" role="tabpanel" id="step2">
									<h3>Local or National </h3>
									<div class="col-md-12">
										<div class="form-group col-md-12">
											{!! Form::radio('data_item', 'Local',['class' => 'nationalfield'],array('class'=>'nationalfield')) !!}
											{!! Form::label('local', 'Local') !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											{!! Form::radio('data_item', 'National',['class' => 'nationalfield'],array('class'=>'nationalfield')) !!}
											{!! Form::label('national', 'National') !!} &nbsp;&nbsp;&nbsp;
										</div>
									</div>
									<ul class="list-inline pull-right">
										<li><button type="button" class="btn btn-default prev-step">Previous</button></li>

										<li><button type="button" class="btn btn-primary btn-info-full next-step-mapping">Next</button></li>
									</ul>

								</div>
								<div class="tab-pane" role="tabpanel" id="step3">
									<div class="col-md-12">
										<div id="commentry">

										</div>
									</div>
									<ul class="list-inline pull-right">
										<li><button type="button" class="btn btn-default prev-step">Previous</button></li>

										<li><button type="button" class="btn btn-primary btn-info-full next-step-mapping">Next</button></li>
									</ul>

								</div>
								<div class="tab-pane" role="tabpanel" id="complete">
									<h3>Complete</h3>
									<p>You have successfully completed all steps.</p>
									<ul class="list-inline pull-right">
										<li><button type="button" class="btn btn-default prev-step">Previous</button></li>

										<li><button type="button" class="btn btn-success  btn-info-full next-step-mapping">Finish!</button></li>
									</ul>
								</div>
								<div class="clearfix"></div>
							</div>
							{!!  Form::close() !!}
						</div>
					</section>
				</div>

			</div>

		</div>
	</div>
@endsection


@section('footer')
	@parent
	<script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script>
	<script src="{{ url('js/filter/jquery.filtertable.min.js') }}"></script>
	<script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
	<script>
		$(document).ready(function () {

			$('.filtertable_definitions').DataTable( {
				"bPaginate": true,
				"bLengthChange": false,
				"bFilter": true,
				"bInfo": true,
				"bAutoWidth": false
			} );

			$('.mapping-data').click(function() {
				var checked = []

				if($('.maped_list:checked').length > 0){
					$("input[name='maped_list[]']:checked").each(function () { checked.push(parseInt($(this).val())); });
					$('#local_commentmodal').modal('show');

				}else{
					alert("Please Select Data");
				}



			});

			$('.next-step-mapping').click(function() {

				var checked = []
				$("input[name='maped_list[]']:checked").each(function () { checked.push(parseInt($(this).val())); });


				var nlinfo =  $('.nationalfield:checked').val();
				if(nlinfo == "Local"){
					$('#commentry').html('<div id="myid" class="col-md-8">' +
							'<input type="text" class="form-control" placeholder="Your Comments" name="mapping_comments"> ' +
							'</div>');
				}else{
					$.ajax({
						url: '{{url("/dashboard/data-definitions/mapping-list")}}',
						type: 'GET',

						success: function (data) {
							$('#commentry').html(data);
						}
					});



				}



			});






			/*$('.nationalfield').change(function() {
			 if($(this).is(":checked")) {
			 var returnVal = $(this).val();
			 if(returnVal =="Local"){
			 $('#local_commentmodal').modal('show');

			 }else{

			 $('#mymapping').modal('show');
			 }


			 }

			 });*/
			/*filter table data*/
			$('.filtertable').filterTable({
				filterExpression: 'filterTableFindAll'
			});

			$.ajaxSetup({
				headers:
				{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
			});
			@if (count($errors) > 0)

            $('#csvDataModel').modal('show');
			@endif
             $('#show').click(function () {
				$('#show').hide();
				$('#hide').show();
				$('.invisible-data').show();
			});
			$('#hide').click(function () {
				$('#hide').hide();
				$('#show').show();
				$('.invisible-data').hide();
			});
			$('.check-status').on('click',function(){
				$(".loader-bg").show();
				$('#checkMap').modal('show');
			});

			$('.check-map').on('click', function (event) {
				$(".loader-bg").show();
				$('input[name=mappingReferenceId]').val($(this).attr('data-reference'));
				$('#mymapping').modal('show');
			});
			$('.submit-form-mapping').on('click',function(){

				var selectedMap =  $('input[name=mychoice]:checked').val();
				var reference_id =  $('input[name=mappingReferenceId]').val();
				var selected_button = $('.check_'+reference_id);
				if(selectedMap){
					var token = $(this).attr('data-token');
					$.ajax({
						url: "{{ url("dashboard/data-definitions/check-mapping") }}",
						type: 'POST',
						data: {"selectedMap": selectedMap,"marked":"Gobal","_token": token,'reference_id':reference_id},
						success: function (data) {
							if(data=='Success'){
								$('#mymapping').modal('hide');
								selected_button.text('Gobal');
								if (selected_button.hasClass("check-map")) {
									selected_button.removeClass('check-map');
								}

							}
						}
					});
				}else{
					alert("Please Select Any Option");
				}

			});
			$('.marked-local').on('click',function(){
				var token = $(this).attr('data-token');
				var mapping_comment =  $('.mapping_comment').val();
				var reference_id =  $('input[name=mappingReferenceId]').val();
				var selected_button = $('.check_'+reference_id);
				if(mapping_comment){
					$.ajax({
						url: "{{ url("dashboard/data-definitions/check-mapping") }}",
						type: 'POST',
						data: {"marked":"Local","_token": token,'comment':mapping_comment,'reference_id':reference_id},
						success: function (data) {
							if(data=='Success'){
								$('#checkMap').modal('hide');
								selected_button.text('Local');
								if (selected_button.hasClass("check-map")) {
									selected_button.removeClass('check-map');
								}
							}
						}
					});
				}
				else{
					alert("Please Enter Comment");
				}

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

				$(".next-step-mapping").click(function (e) {

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