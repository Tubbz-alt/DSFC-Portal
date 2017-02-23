@extends('master')

@section('page-title', 'Reference Library Portal')
@section('header')
	@parent
<link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">

@endsection
@section('title', 'Csv Data')
@section('content')
	<div id="content-wrapper" class="container">
		<section class="col-sm-12">
			<div class="row margin-bottom-15">
				<div class="col-xs-12 col-md-6">

				</div>
				<div class="col-xs-12 col-md-6 text-right">


				</div>
			</div>
		</section>
		<section class="col-sm-12">

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

				</div>

			</div>
		</section>
		<section class="col-sm-12 table-responsive">
			<div class="panel panel-default">
				<table class="table table-striped table-bordered">
					@if (count($dataset) > 0)

						<tr>
							<th>Data Item Name</th>
							<th>Data Item Description</th>
							<th>Data Type</th>
							<th>Requirement</th>
							<th>Code</th>
							<th>Code Description</th>
							<th>Is Derived Item</th>
							<th>Derivation Methodology</th>
							<th>Author</th>
							<th>Created Date</th>
						</tr>
						@foreach ($dataset as $pl)

							<tr>
								<td>{{$pl->dataItemName}}</td>
								<td>{{$pl->dataItemDescription}}</td>
								<td>{{$pl->dataType}}</td>
								<td>{{$pl->requirement}}</td>
								<td>{{$pl->code}}</td>
								<td>{{$pl->codeDescription}}</td>
								<td>{{$pl->isDerivedItem}}</td>
								<td>{{$pl->derivationMethodology}}</td>
								<td>{{$pl->author}}</td>
								<td>{{$pl->createdDate}}</td>
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

		</div>
	</div>
@endsection
@foreach($file_status as $fileinfo)

<div class="modal fade" id="csvDataModel" tabindex="-1" role="dialog" aria-labelledby="csvDataModelLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			{!! Form::open(array('url' => 'dashboard/csv-management/csv-data','files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data')) !!}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="csvDataModelLabel">Import Data</h4>
			</div>
			<div class="modal-body">

			    <div class="form-group">
					{!! Form::label('filename', 'File Name') !!}
					{!! Form::text('file_name', $fileinfo->fileTitle, array('class' => 'form-control' , 'autocomplete' => 'off')) !!}
				</div>
				<div class="form-group">
					{!! Form::label('filedescription', 'File Description') !!}
					{!! Form::text('filedescription', $fileinfo->fileDescription, array('class' => 'form-control' , 'autocomplete' => 'off')) !!}
				</div>
				<div class="validation error" id="subject_errors">&nbsp;</div>
				{!! Form::label('chooose file', 'Choose File') !!}
				<input type="file" name="excel-data" id="">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="button" class="btn btn-primary" value="Upload" data-dismiss="modal"/>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endforeach
@section('footer')
	@parent
	<script src="{{ url('js/users/index.js') }}"></script>
@endsection