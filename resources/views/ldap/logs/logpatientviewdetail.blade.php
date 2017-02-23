@extends('admin.home')
@section('title', 'User Clicks Details')
@section('content')
    <div class="loader-bg">
        <span class="image-loader screen-center">
            <img src="{{ url('images/loading-detail.gif') }}">
        </span>
    </div>
<style>
    .odd, .even{
        height:45px !important;
    }
    #userlogstbl{
        margin-top:25px;
    }
    .dataTables_length, .dataTables_filter{
         margin-top:25px;
    }
    .dataTables_length{
        margin-left:30px;
    }
    .dataTables_filter{
        margin-right:30px;
    }
    .text-center{
        background-color: #1482D0;
        color: #ffffff;
    }
    .dataTables_wrapper.no-footer{
        width: 98%;
        margin-left: 1%;
    }
    .exportbtn{
        margin: 10px 10px 5px 0px;
        float: right;
        padding: 6px 10px;
    }
            td{
        height: 45px;
    }
  /*   .searchbtn{
    padding: 1px 20px;
    margin-right: 8px;
    vertical-align: initial !important;
    margin-top: 2px;
    }*/
    .searchbtn {
    padding: 1px 20px;
    margin-right: 8px;
    vertical-align: initial !important;
      margin-top: 4px;
    height: 31px;
}

    .margin-top-40{
        margin-top: 40px;
    }
    .header_title{
            height: 20px;
    }
     .searchclear {
    position: absolute;
    right: 115px;
    top: 0;
    bottom: 0;
    height: 14px;
    margin: auto;
    font-size: 14px;
    cursor: pointer;
    color: #ccc;
}
.formclass{
    height: 33px;
    float:right;
}
.inputheight{
    height: 32px;
}
.searchclear a:hover, a:visited, a:link, a:active
{
    text-decoration: none;
}
</style>
<link rel="stylesheet" href="{{ url('css/jquery.dataTables.min.css') }}" type="text/css">

	<div id="content-wrapper" class="container">
		<section class="col-sm-12">
		<!-- 	<div class="section-header">
				<h1>User Click Details</h1><br>
			</div> -->
            {{--   <div class="col-sm-9 header_title">
              <h3 style="margin-top:11px; ">User Click</h3><br>
            </div>--}}

		</section>
		<div class="row">
			<div class="col-xs-12 col-md-12">
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
			<div class="panel panel-default row">
                    <div class="col-xs-12 col-md-12">
            <div class="col-md-6 pull-left" style="margin-top: 10px;">
           <!--  @if(isset($logpatientdetailCount))
             Showing {{ count($logpatientdetail) }}  of {{ $logpatientdetailCount }}
            @endif -->
            {!! $logpatientdetail->render() !!}
            </div>
                     <div class=" col-md-3 pull-right  ">
                         <div class="pull-left search_div">
        {!! Form::open(array('url' => 'admin/logs/search-logs-user-click', 'method'=>'get','id'=>'', 'class'=>'formclass')) !!}
                 
                    {!! Form::text('search', (Session::has('SearchLogsUserClick'))? Session::get('SearchLogsUserClick') :null, 
                     array('required', 
                            'placeholder'=>'Search','class'=>'inputheight')) !!}
                 {!! csrf_field() !!}
                     @if(Session::has('SearchLogsUserClick'))
                   <a href="{{url('admin/logs/logs-patient-view-detail')}}" class='glyphicon glyphicon-remove-circle searchclear'></a>
                    @endif
                         <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"
                                                                             aria-hidden="true"></span></button>
           {{--     {!! Form::submit('Search',  array('class'=>' searchbtn btn btn-primary')) !!}--}}
                {!! Form::close() !!}
                             </div>
                         <div class="pull-right">
                             <a href="{{url('admin/logs/export-patient-view-detail')}}" class='exportcsv'></a>
                         </div>

                     </div>
         </div>
				<table id="userlogstbl" class="table table-striped table-bordered"  style="width:100%;">
					@if(count($logpatientdetail)>0)
                                        <thead>
						<tr>
                                                        <th class="text-center">Sl.No</th>
							                            <th class="text-center">User Name</th>
                                                        <th class="text-center">Patient Name</th>
														<th class="text-center">Patient Hospital Number</th>
                                                        <th class="text-center">Bed No</th>
                                                        <th class="text-center">Item</th>
                                                        <th class="text-center">Page Title</th>
                                                        <th class="text-center">Date and Time</th>

						</tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        $page = Input::get('page');
                                        if($page> 0 ){
                                            $page=$page-1;
                                            $i=$page*25;
                                        }
                                        ?>
						@foreach($logpatientdetail as $value)
						<tr>
                                                    <td><?php echo $i;?> {{--{{ $value->id }}--}}</td>

							<td>{{ $value->username }}</td>

							                          

                                                        <td>{{ $value->patient_name }}</td>
														 <td>{{ $value->patient_id}}</td>
                                                        <td>{{ $value->bed_no }}</td>
                                                        <td>{{ $value->item_click}}</td>
                                                        <td>{{ $value->page_title}}</td>
                                                        <td>{{ $value->view_time }}</td>
                                                        
                                                        
                                                    <?php $i=$i+1;?>
						</tr>                                               
						@endforeach
					@else
						<tr><h4 class="text-center margin-top-40" >"Sorry no records found!"</h4></tr>
					@endif                                      
                        
                                       </tbody>
				</table>
                 <div class="pull-left" style="margin-top: 10px; margin-left: 10px; margin-bottom: 10px;">
        
        {!! $logpatientdetail->render() !!}
            </div>
			</div>
              
            
	</div>
@endsection
@section('footer')
@parent
<script src="{{ url('js/groups/index.js') }}"></script>
<script src="{{ url('js/common.js') }}"></script>


<script src="{{ url('js/jquery-1.12.0.min.js') }}"></script>
<script src="{{ url('js/jquery.dataTables.min.js') }}"></script>







@endsection