@extends('admin.home')
@section('title', 'Non Admitted Total')

@section('content')
	<div id="content-wrapper" class="container">
		<section class="col-sm-12">
			<div class="section-header">
				<h1>Non Admitted Total</h1><br>
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
					{!! $non_admitted_total->appends(['search' => $_GET['search'] ])->render() !!}
				</div>		
			<div class="col-xs-12 col-md-6 text-right">
				{!! Form::open(array('url' => 'admin/rtt/non-admitted-total-search','method'=>'get','class' => 'form-inline inline', 'style' => 'display: inline', 'novalidate' =>'novalidate')) !!}
				   	<span class="input-group">		   
					   	{!! Form::text('search', $keyword,array('required','class'=>'form-control','placeholder'=>'Search for...')) !!}
		      			<span class="input-group-btn">
		        			{!! Form::submit('Go',array('class'=>'btn btn-primary btn-md')) !!}
		      			</span>
	    			</span>
	    		{!! Form::close() !!}			
				<a href="{{url('media/rtt/rtt_non _admitted_total.ods')}}" class="btn btn-primary btn-sm" download target="_blank">Download Sample</a>
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Import Data</button>				
			</div>
			</div>
		</section>
 		<section class="col-sm-12 table-responsive">
 		<input type="hidden" value="<?php echo $_GET["search"]; ?>" id="search">
				<table class="table table-striped table-bordered tableAdmin">
					@if (count($non_admitted_total) > 0)
						<tr>
							<th>Period</th>
							<th>Provider Code</th>
							<th>Provider Name</th>
							<th>Treatment Function Code</th>
							<th>Treatment Function</th>
							<th> >0-1</th>
							<th> >1-2</th>
							<th> >2-3</th>
							<th> >3-4</th>
							<th> >4-5</th>
							<th> >5-6</th>
							<th> >6-7</th>
							<th> >7-8</th>
							<th> >8-9</th>
							<th> >9-10</th>
							<th> >10-11</th>
							<th> >11-12</th>
							<th> >12-13</th>
							<th> >13-14</th>
							<th> >14-15</th>
							<th> >15-16</th>
							<th> >16-17</th>
							<th> >17-18</th>
							<th> >18-19</th>
							<th> >19-20</th>
							<th> >20-21</th>
							<th> >21-22</th>
							<th> >22-23</th>
							<th> >23-24</th>
							<th> >24-25</th>
							<th> >25-26</th>
							<th> >26-27</th>
							<th> >27-28</th>
							<th> >28-29</th>
							<th> >29-30</th>
							<th> >30-31</th>
							<th> >31-32</th>
							<th> >32-33</th>
							<th> >33-34</th>
							<th> >34-35</th>
							<th> >35-36</th>
							<th> >36-37</th>
							<th> >37-38</th>
							<th> >38-39</th>
							<th> >39-40</th>
							<th> >40-41</th>
							<th> >41-42</th>
							<th> >42-43</th>
							<th> >43-44</th>
							<th> >44-45</th>
							<th> >45-46</th>
							<th> >46-47</th>
							<th> >47-48</th>
							<th> >48-49</th>
							<th> >49-50</th>
							<th> >50-51</th>
							<th> >51-52</th>
							<th> 52_plus</th>
							<th>Patients with unknown clock start date</th>
							<th>Total number of completed pathways (all)</th>
							<th>Total number of completed pathways (with a known clock start)</th>
							<th>Total (with a known clock start) within 18 weeks</th>
							<th>% within 18 weeks</th>
							<th>Average (median) waiting time (in weeks)</th>
							<th>95th percentile waiting time (in weeks)</th>
							<th>Potential patients liable to penalty</th>
							<th>Indicative Penalty</th>
						</tr>

						@foreach ($non_admitted_total as $nat)
							<tr>
								<td>{{$nat->period}}</td>
								<td>{{$nat->provider_code}}</td>
								<td>{{$nat->provider_name}}</td>
								<td>{{$nat->treatment_function_code}}</td>
								<td>{{$nat->treatment_function}}</td>
								<td>{{$nat->bw_0_1}}</td>
								<td>{{$nat->bw_1_2}}</td>
								<td>{{$nat->bw_2_3}}</td>
								<td>{{$nat->bw_3_4}}</td>
								<td>{{$nat->bw_4_5}}</td>
								<td>{{$nat->bw_5_6}}</td>
								<td>{{$nat->bw_6_7}}</td>
								<td>{{$nat->bw_7_8}}</td>
								<td>{{$nat->bw_8_9}}</td>
								<td>{{$nat->bw_9_10}}</td>
								<td>{{$nat->bw_10_11}}</td>
								<td>{{$nat->bw_11_12}}</td>
								<td>{{$nat->bw_12_13}}</td>
								<td>{{$nat->bw_13_14}}</td>
								<td>{{$nat->bw_14_15}}</td>
								<td>{{$nat->bw_15_16}}</td>
								<td>{{$nat->bw_16_17}}</td>
								<td>{{$nat->bw_17_18}}</td>
								<td>{{$nat->bw_18_19}}</td>
								<td>{{$nat->bw_19_20}}</td>
								<td>{{$nat->bw_20_21}}</td>
								<td>{{$nat->bw_21_22}}</td>
								<td>{{$nat->bw_22_23}}</td>
								<td>{{$nat->bw_23_24}}</td>
								<td>{{$nat->bw_24_25}}</td>
								<td>{{$nat->bw_25_26}}</td>
								<td>{{$nat->bw_26_27}}</td>
								<td>{{$nat->bw_27_28}}</td>
								<td>{{$nat->bw_28_29}}</td>
								<td>{{$nat->bw_29_30}}</td>
								<td>{{$nat->bw_30_31}}</td>
								<td>{{$nat->bw_31_32}}</td>
								<td>{{$nat->bw_32_33}}</td>
								<td>{{$nat->bw_33_34}}</td>
								<td>{{$nat->bw_34_35}}</td>
								<td>{{$nat->bw_35_36}}</td>
								<td>{{$nat->bw_36_37}}</td>
								<td>{{$nat->bw_37_38}}</td>
								<td>{{$nat->bw_38_39}}</td>
								<td>{{$nat->bw_39_40}}</td>
								<td>{{$nat->bw_40_41}}</td>
								<td>{{$nat->bw_41_42}}</td>
								<td>{{$nat->bw_42_43}}</td>
								<td>{{$nat->bw_43_44}}</td>
								<td>{{$nat->bw_44_45}}</td>
								<td>{{$nat->bw_45_46}}</td>
								<td>{{$nat->bw_46_47}}</td>
								<td>{{$nat->bw_47_48}}</td>
								<td>{{$nat->bw_48_49}}</td>
								<td>{{$nat->bw_49_50}}</td>
								<td>{{$nat->bw_50_51}}</td>
								<td>{{$nat->bw_51_52}}</td>
								<td>{{$nat->plus_52}}</td>
								<td>{{$nat->patients_with_unknown_clock_start_date}}</td>
								<td>{{$nat->total_number_of_completed_pathways_all}}</td>
								<td>{{$nat->total_number_of_completed_pathways_with_a_known_clock_start}}</td>
								<td>{{$nat->total_with_a_known_clock_start_within_18_weeks}}</td>
								<td>{{$nat->within_18_weeks}}</td>
								<td>{{$nat->average_median_waiting_time_in_weeks}}</td>
								<td>{{$nat->ninetyfifth_percentile_waiting_time_in_weeks}}</td>
								<td>{{$nat->potential_patients_liable_to_penalty}}</td>
								<td>{{$nat->indicative_penalty}}</td>
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
			{!! $non_admitted_total->appends(['search' => $_GET['search'] ])->render() !!}
		</div>
	</div>
@endsection
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{!! Form::open(array('url' => 'admin/rtt/non-admitted-total', 'method'=>'post', 'enctype' => 'multipart/form-data')) !!}
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
	<script src="{{ url('js/users/highlight.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script>
	<script src="{{ url('js/users/search.js') }}"></script>

@endsection