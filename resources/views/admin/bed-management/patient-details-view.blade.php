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
								<div class="dtls-row-content">{{$p_view->patient_hosp_id}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">IP_Spell_ID </div>
								<div class="dtls-row-content">{{$p_view->ip_spell_id}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Admit_Date & Time</div>
								<div class="dtls-row-content">{{$p_view->admit_dttm}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Ed_Date & Time</div>
								<div class="dtls-row-content">{{$p_view->ed_dttm}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Med Fit_Date & Time </div>
								<div class="dtls-row-content">{{$p_view->medfit_dttm}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Disch_Date & Time</div>
								<div class="dtls-row-content">{{$p_view->disch_dttm}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Curr_Spec_Desc</div>
								<div class="dtls-row-content">{{$p_view->curr_spec_desc}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Curr_HCP_Name</div>
								<div class="dtls-row-content">{{$p_view->patient_name}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Curr_Ward_Desc </div>
								<div class="dtls-row-content">{{$p_view->bed_name}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Curr_Bay_Desc</div>
								<div class="dtls-row-content">{{$p_view->curr_bay_desc}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Curr_Bed_Desc</div>
								<div class="dtls-row-content">{{$p_view->curr_bed_desc}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Ward Start Date & Time</div>
								<div class="dtls-row-content">{{$p_view->ward_start_dttm}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Ward Stay Number</div>
								<div class="dtls-row-content">{{$p_view->ward_stay}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Disch_Delay_RSN_Desc</div>
								<div class="dtls-row-content">{{$p_view->disch_delay_rsn_desc}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Hfq_Proforma_Ext_ID</div>
								<div class="dtls-row-content">{{$p_view->hfq_proforma_ext_id}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Proforma_Type</div>
								<div class="dtls-row-content">{{$p_view->proforma_type}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Proforma_Name</div>
								<div class="dtls-row-content">{{$p_view->proforma_name}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Proforma_Date & Time</div>
								<div class="dtls-row-content">{{$p_view->proforma_dttm}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">News(National Early Warning Score)</div>
								<div class="dtls-row-content">{{$p_view->news}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Date & Time</div>
								<div class="dtls-row-content">{{$p_view->date_time}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Actual Ward Pending</div>
								<div class="dtls-row-content">{{$p_view->actual_ward_pending}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Preferred Ward</div>
								<div class="dtls-row-content">{{$p_view->preferred_ward}}</div>
							</div>
							<div class="col-md-4">
								<div class="dtls-row-head">Bed Type</div>
								<div class="dtls-row-content">{{$p_view->monitored_bed}}</div>
							</div>
						</div>
						<!--dtls-row ends--> 

						<!--dtls-row starts-->
						<div class="dtls-row">
							<div class="col-md-4">
								<div class="dtls-row-head">Is Side Room Required?</div>
								<div class="dtls-row-content">{{$p_view->	side_room}}</div>
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
	<!--  side-filter-box starts-->

	<div class="side-filter-box">
		<div class="filter-box-content">

			<form>

				<div class="form-row">

					<input type="text" placeholder="Your Name">

				</div>

				<div class="form-row">


					<input type="text" placeholder="Enter your email id">
				</div>
				<div class="form-row">

					<input type="button"  value="submit">
				</div>
			</form>


			<a class="filter-box closed"></a>
		</div>
	</div>
	@endsection

	@section('footer')
    @parent
        <script src="{{ url('js/dashboards/rtt.js') }}"></script>
	@endsection
