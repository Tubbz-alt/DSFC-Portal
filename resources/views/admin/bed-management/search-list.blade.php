@extends('admin.home')
@section('title', 'Patient List')

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
			{!! Form::open(array('url' => 'admin/bed-management/search-list','method' => 'get','class' => 'form-inline inline', 'style' => 'display: inline')) !!}
			   <span class="input-group">		   
			   		{!! Form::text('search', null,array('required','class'=>'form-control','placeholder'=>'Search for...')) !!}
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
			<div class="panel panel-default">
				<table class="table table-striped table-bordered">
				@if (count($query) > 0)
						<tr>
							<th>Room</th>
							<th>Patient Name</th>
							<th>Bed Name</th>
							<th>Monitored Bed</th>
							<th> Side Room</th>
							<th> Admitted Date and Time</th>
							<th> Estimated Date and Time</th>
							<th> Medically Fit Date and Time</th>
							<th> Patient Hospital Id</th>
							<th> Inpatient Spell Id</th>
							<th> Discharge Date and Time</th>
							<th> Currnt Speciality Description</th>
							<th> Current Bay Description</th>
							<th> Current Bed Description</th>
							<th> Ward Start Date and Time</th>
							<th> Ward Stay</th>
							<th> Discharge Delay Reason Description</th>
							<th> Hfq Proforma External Id</th>
							<th> Proforma Type</th>
							<th> Proforma Name</th>
							<th> Proforma_dttm</th>
							<th> News</th>
							<th> Date and Time</th>
							<th> Actual Ward Pending</th>
							<th> Preferred Ward</th>						

						</tr>
						@foreach ($query as $querys)
							<tr>
								<td>{{$querys->room}}</td>
								<td>{{$querys->patient_name}}</td>
								<td>{{$querys->bed_name}}</td>
								<td>{{$querys->monitored_bed}}</td>
								<td>{{$querys->side_room}}</td>

								<td>{{$querys->admit_dttm}}</td>
								<td>{{$querys->ed_dttm}}</td>
								<td>{{$querys->medfit_dttm}}</td>
								<td>{{$querys->patient_hosp_id}}</td>
								<td>{{$querys->ip_spell_id}}</td>
								<td>{{$querys->disch_dttm}}</td>
								<td>{{$querys->curr_spec_desc}}</td>
								<td>{{$querys->curr_bay_desc}}</td>
								<td>{{$querys->curr_bed_desc}}</td>
								<td>{{$querys->ward_start_dttm}}</td>
								<td>{{$querys->ward_stay}}</td>
								<td>{{$querys->disch_delay_rsn_desc}}</td>
								<td>{{$querys->hfq_proforma_ext_id}}</td>
								<td>{{$querys->proforma_type}}</td>
								<td>{{$querys->proforma_name}}</td>
								<td>{{$querys->proforma_dttm}}</td>
								<td>{{$querys->news}}</td>
								<td>{{$querys->date_time}}</td>
								<td>{{$querys->actual_ward_pending}}</td>
								<td>{{$querys->preferred_ward}}</td>							

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
			{!! $query->appends(['search' => $_GET['search'] ])->render() !!}
		</div>
	</div>
@endsection


@section('footer')
@parent
	<script src="{{ url('js/users/highlight.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script> 
@endsection