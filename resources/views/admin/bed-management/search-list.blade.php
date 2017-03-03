@extends('admin.home')
@section('title', 'Patient List')
<link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('css/admin/admintable.css')}}">
@section('my-wards-list')
<ul style="top: 0px; position: absolute ! important; width: 100%; left: -149px;">
    <li><a href="#" tabindex="-1">Second level link</a></li>
    <li><a href="#" tabindex="-1">Second level link</a></li>
</ul>
@endsection
@section('content')
	<div id="content-wrapper" class="container">
		<section class="col-sm-12">
			<div class="section-header">
				<h1>Patient List</h1><br>
			</div>
			<div class="row">
				<div class="col-xs-12">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							@foreach ($errors->all() as $error)
								<p>{{ $error }}</p>
							@endforeach
						</div>
					@endif
					<div id="success">
						@if (Session::has('success'))
				      		<div class='alert alert-success'>{{ Session::get('success') }}</div>
				    	@endif
			    	</div>
				</div>
			</div>
              <div class="row margin-bottom-15">
				<div class="col-xs-6">
					{!! $query->appends(['search' => $_GET['search'] ])->render() !!}
				</div>
		
			<div class="col-xs-6 text-right">
			{!! Form::open(array('url' => 'admin/whiteboardward/search-list','method' => 'get','class' => 'form-inline inline', 'style' => 'display: inline' , 'novalidate' => 'novalidate')) !!}
			   <span class="input-group">		   
			   		{!! Form::text('search', $keyword,array('required','class'=>'form-control','placeholder'=>'Search for...')) !!}
      				<span class="input-group-btn">
        				{!! Form::submit('Go',array('class'=>'btn btn-primary btn-md')) !!}
      				</span>
                </span>
    		
    		{!! Form::close() !!}
				
			</div>
			</div>
		</section>
		<section class="col-sm-12 table-responsive">
			<input type="hidden" value="<?php echo $_GET["search"]; ?>" id="search">
				<table class="table table-striped table-bordered tableAdmin table-wrapper" id="patient_list_table_admin">
				@if (count($query) > 0)
                        <thead style="background: #ffffff">
						<tr>
						<th class="item">Name</th>
                        <th>Bed</th>
                        <th style="width:225px">Con</th>
                        <th>Admit DT</th>
                        <th>EDD</th>
                        <th>MED Fit</th>
                        <th>Delayed Dis Reason</th>
                        <th>Ward</th>
                        <th>Side room?</th>
                        <th>EMFFD</th>
                        <th>Physio Decision DT</th>
                        <th>Physio Required</th>
                        <th>Physio Status</th>
                        <th>DT</th>
                        <th>OT Decision DT</th>
                        <th>OT Status</th>
                        <th>DT</th>
                        <th>DART Decision DT</th>
                        <th>DART Status</th>
                        <th>DT</th>
                        <th>MH Decision DT</th>
                        <th>MH Status</th>
                        <th>DT</th>
                        <th>SaLT Decision DT</th>
                        <th>SaLT Status</th>
                        <th>DT</th>
                        <th>DNursing Decision DT</th>
                        <th>DNursing Status</th>
                        <th> DT</th>
                        <th> Dietetics Decision DT</th>
                        <th>Dietetics Status</th>
                        <th>DT</th>
                        <th>Trans DT</th> 						

						</tr>
                        </thead>
						@foreach ($query as $pl)
							<tr>
							    <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->name}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->bed}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->con}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->admit_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->edd}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->med_fit}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dd_reason}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->ward}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->side_room}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->emffd}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->physio_decision_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->physio_required}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->physio_status}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->physio_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->ot_decision_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->ot_status}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->ot_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dart_decision_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dart_status}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dart_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->mh_decision_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->mh_status}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->mh_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->salt_decision_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->salt_status}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->salt_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dnursing_decision_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dnursing_status}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dnursing_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dietetics_decision_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dietetics_status}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dietetics_dt}}</a>
                            </td>
                            <td><a class="patient-detail-hover"
                                   href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->trans_dt}}</a>
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
		<div class="col-md-12">
			{!! $query->appends(['search' => $_GET['search'] ])->render() !!}
		</div>
	</div>
@endsection


@section('footer')
@parent
	<script src="{{ url('js/users/highlight.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script> 
	<script src="{{ url('js/users/search.js') }}"></script>
<script>
    $(document).ready(function () {
        // STICKY HEAD

        $('#patient_list_table_admin').stickyTableHeaders();
    });
</script>

@endsection