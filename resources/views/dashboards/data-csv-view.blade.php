@extends('master')
@section('page-title', 'Reference Library Portal')
@section('header')
	@parent
	<link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">
	<style>
		.details-hover{
			cursor: pointer; cursor: hand;
		}
	</style>
@endsection
@section('title', 'Csv Data')


@section('content')
	<div id="content-wrapper" class="container">
		<section class="col-sm-12">
			<div class="row margin-bottom-15">
				<div class="col-xs-12 col-md-6">

				</div>
				<div class="col-xs-12 col-md-6 text-right">
					<a href="{{url('media/uploads/DSfC_Template.csv')}}" class="btn btn-primary btn-sm" download target="_blank">CSV Template</a>
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#csvDataModel">Import Data</button>
				</div>
			</div>
		</section>





		<section class="col-sm-12 table-responsive">
							<div class="panel panel-default">
								<table class="table table-striped table-bordered">
									@if (count($csv_list) > 0)
										<tr>
											<th>File Title</th>
											<th>File Description</th>
											<th>Created Date</th>
											<th>Status</th>
											<th>File Info</th>



										</tr>
										@foreach ($csv_list as $pl)
											<tr>
												<td><a 	class="patient-detail-hover" >{{$pl->fileTitle}}</a></td>
												<td><a 	class="patient-detail-hover">{{$pl->fileDescription}}</a></td>
												<td><a 	class="patient-detail-hover">{{$pl->createdDate}}</a></td>
												<td>
													@if($pl->status==0)
														<button class="btn-danger btn">
															Pending
														</button>
													@else
														<button class="btn-primary btn" >
															Approved
														</button>
													@endif
												</td>
												<td>
													<a href="{{url('dashboard/csv-management/versions/'.$pl->conceptReferenceDataId)}}" class="patient-detail-hover details-hover">Versions</a>
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
							</div>
						</section>








	</div>
@endsection
<div class="modal fade" id="csvDataModel" tabindex="-1" role="dialog" aria-labelledby="csvDataModelLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{!! Form::open(array('url' => 'dashboard/csv-management/csv-data','files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data')) !!}
			<div class="modal-header">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="csvDataModelLabel">Import Data</h4>
			</div>
			<div class="modal-body">

			    <div class="form-group">
					{!! Form::label('filename', 'File Title') !!}
					{!! Form::text('file_title', '', array('class' => 'form-control' , 'autocomplete' => 'off')) !!}
				</div>
				<div class="form-group">
					{!! Form::label('filedescription', 'File Description') !!}
					{!! Form::text('filedescription', '', array('class' => 'form-control' , 'autocomplete' => 'off')) !!}
				</div>
				<div class="validation error" id="subject_errors">&nbsp;</div>
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
	<script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script>
    <script>
        $(document).ready(function () {
            @if (count($errors) > 0)

            $('#csvDataModel').modal('show');
            @endif


        });
    </script>
@endsection