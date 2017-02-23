@extends('admin.home')
@section('title', 'Patient List')
<link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">
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
				<div class="col-xs-12 col-md-6">
					{!! $pl_list->render() !!}
				</div>
			<div class="col-xs-12 col-md-6 text-right">
			{!! Form::open(array('url' => 'admin/bed-management/search-list','method' => 'get', 'class' => 'form-inline inline', 'style' => 'display: inline')) !!}
						<span class="input-group">
						{!! Form::text('search', null,array('required','class'=>'form-control','placeholder'=>'Search for...')) !!}
								<span class="input-group-btn">
								{!! Form::submit('Go',array('class'=>'btn btn-primary btn-md')) !!}
								</span>
						</span>
					{!! Form::close() !!}
				<a href="{{url('media/bed-management/patient_list.ods')}}" class="btn btn-primary btn-sm" download target="_blank">Download Sample</a>
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Import Data</button>
			</div>
			</div>
		</section>
		<section class="col-sm-12 table-responsive">
			<div class="panel panel-default">
				<table class="table table-striped table-bordered">
				@if (count($pl_list) > 0)
						<tr>
										<th>Patient hospital id</th>
                                        <th>Patient name</th>
                                        <th>IP spell id</th>
                                        <th>Admit dttm</th>
                                        <th>EDS spell discharged died dttm</th>
                                        <th>EDS clinical details complete</th>
                                        <th>EDS drug details complete</th>
                                        <th>ED dttm</th>
                                        <th>MED fit dttm</th>
                                        <th>DISCH dttm</th>
                                        <th>CURR spec desc</th>
                                        <th>CURR hcp name</th>
                                        <th>CURR bay desc</th>
                                        <th>CURR bed desc</th>
                                        <th>WARD start dttm</th>
                                        <th>WARD stay number</th>
                                        <th>DISCH delay rsn desc</th>
                                        <th>HFQ proforma ext id</th>
                                        <th>proforma type</th>
                                        <th>proforma name</th>
                                        <th>Proforma dttm</th>
                                        <th>Dttm decision to refer to physio</th>
                                        <th>Dttm physio  referral sent</th>
                                        <th>Dttm decision to refer to ot</th>
                                        <th>OT referral status</th>
                                        <th>Dttm decision to refer to mental health</th>
                                        <th>Dttm decision to refer to dart</th>
                                        <th>Dttm decision to refer to district nurse</th>
                                        <th>District nurse referral status</th>
                                        <th>Dttm decision to refer to salt</th>
                                        <th>Salt referral status</th>
                                        <th>Bed type</th>
                                        <th>Is side room required</th>
                                        <th>Query discharge date</th>
                                        <th>Transport booked dttm Pt ready after</th>
                                        <th>Area</th>

						</tr>
						@foreach ($pl_list as $pl)
							<tr>
								<td><a 	class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->patient_hosp_id}}</a></td>
								<td><a 	class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->patient_name}}</a></td>
								<td><a 	class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->ip_spell_id}}</a></td>
								<td><a 	class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->admit_dttm}}</a></td>
								<td><a 	class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->eds_spelldischargeddieddatetime}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->eds_clinicaldetailscomplete}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->eds_drugdetailscomplete}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->ed_dttm}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->med_fit_dttm}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->disch_dttm}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->curr_spec_desc}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->curr_hcp_name}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->curr_bay_desc}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->curr_bed_desc}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->ward_start_dttm}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->ward_stay_number}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->disch_delay_rsn_desc}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->hfq_proforma_ext_id}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->proforma_type}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->proforma_name}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->proforma_dttm}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->date_time_decision_to_refer_to_physio}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->date_time_physio_referral_sent}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->date_time_decision_to_refer_to_ot}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->ot_referral_status}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->date_time_decision_to_refer_to_mental_health}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->date_time_decision_to_refer_to_dart}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->date_time_decision_to_refer_to_district_nurse}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->district_nurse_referral_status}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->date_time_decision_to_refer_to_salt}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->salt_referral_status}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->bed_type}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->is_side_room_required}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->query_discharge_date}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->transport_booked_date_time_pt_ready_after}}</a></td>
								<td><a  class="patient-detail-hover" href="{{url('admin/bed-management/patient-details-view/'.$pl->id)}}" >{{$pl->area}}</a></td>

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
			</div>
			</section>
		<div class="col-md-12">
			{!! $pl_list->render() !!}
		</div>
	</div>
@endsection
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{!! Form::open(array('url' => 'admin/bed-management/patient-list', 'method'=>'post', 'enctype' => 'multipart/form-data')) !!}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Import Data</h4>
				</div>
				<div class="modal-body">
					{!! Form::label('chooose file', 'Choose File') !!}
					<input type="file" name="excel-data" id="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Upload"/>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

@section('footer')
@parent
	<script src="{{ url('js/users/index.js') }}"></script>
@endsection