@extends('admin.home')
@section('title', 'Patient Details View')
<link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">
@section('my-wards-list')
<ul style="top: 0px; position: absolute ! important; width: 100%; left: -149px;">
    <li><a href="#" tabindex="-1">Second level link</a></li>
    <li><a href="#" tabindex="-1">Second level link</a></li>
</ul>
@endsection
@section('content')


			<div class="inner-cover">
				<div class="rtt-content-header">
					<div class="container">
						<div class="section-header">
							<h2>Patient Details View</h2>


						</div>
					</div>
					<!--patients details strats--> 

					<!--dtls-row starts-->

					<div class="col-md-10 col-md-offset-1">
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Patient_Hosp_ID</div>
								<div class="dtls-row-content">{{$p_view->patient_id}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Patient Name</div>
								<div class="dtls-row-content">{{$p_view->name}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Admit_Date & Time</div>
								<div class="dtls-row-content">{{$p_view->admit_dt}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Ed_Date & Time</div>
								<div class="dtls-row-content">{{$p_view->edd}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Med Fit_Date & Time </div>
								<div class="dtls-row-content">{{$p_view->med_fit}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Delayed Dis Reason</div>
								<div class="dtls-row-content">{{$p_view->dd_reason}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Preferred Ward</div>
								<div class="dtls-row-content">{{$p_view->ward}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Is side room required?</div>
								<div class="dtls-row-content">{{$p_view->side_room}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">EMFFD </div>
								<div class="dtls-row-content">{{$p_view->emffd}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Date and time decision to refer to Physio</div>
								<div class="dtls-row-content">{{$p_view->physio_decision_dt}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Physiotherapy service required</div>
								<div class="dtls-row-content">{{$p_view->physio_required}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Physio referral status</div>
								<div class="dtls-row-content">{{$p_view->physio_status}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Date and time decision to refer to OT</div>
								<div class="dtls-row-content">{{$p_view->ot_decision_dt}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">OT referral status</div>
								<div class="dtls-row-content">{{$p_view->ot_status}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Date and time decision to refer to DART</div>
								<div class="dtls-row-content">{{$p_view->dart_decision_dt}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">DART referral status</div>
								<div class="dtls-row-content">{{$p_view->dart_status}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Date and time decision to refer to Mental Health</div>
								<div class="dtls-row-content">{{$p_view->mh_decision_dt}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Mental Health referral status</div>
								<div class="dtls-row-content">{{$p_view->mh_status}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Date and time decision to refer to SaLT</div>
								<div class="dtls-row-content">{{$p_view->salt_decision_dt}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">SaLT referral status</div>
								<div class="dtls-row-content">{{$p_view->salt_status}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Reason for Patient Flow involvement</div>
								<div class="dtls-row-content">{{$p_view->patient_flow_involvement}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Patient Flow Comments</div>
								<div class="dtls-row-content">{{$p_view->patient_flow_comment}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Is monitored bed required?</div>
								<div class="dtls-row-content">{{$p_view->monitored_bed}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Patient needs transport on discharge</div>
								<div class="dtls-row-content">{{$p_view->trans_dt}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 
					</div>
					<!--patients details ends--> 

				</div>
			</div>
			<div class="footer-strip">
				<div class="container-fluid">
					<div class="col-md-6">
						<ul>
							<li><a href="">About Us</a></li>
							<li><a href="">Privacy</a></li>
							<li><a href="">Contact us</a></li>
						</ul>
					</div>
					<div class="col-md-6 text-right">
						<p>&copy; Copyright ibox , 2014 </p>
					</div>
				</div>
			</div>
		</div>

	@endsection

	@section('footer')
    @parent
        <script src="{{ url('js/dashboards/rtt.js') }}"></script>
	@endsection
