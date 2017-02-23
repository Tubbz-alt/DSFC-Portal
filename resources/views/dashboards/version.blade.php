@extends('master')
@section('page-title', 'Reference Library Portal')
@section('header')
	@parent

	<link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/jquery.dataTables.min.css')}}">



@endsection
@section('title', 'Csv Data')
@section('content')

	<div  class="container">

		<table class=" table  table-striped table-bordered definitions-table horizontal_scroll">


			<thead>
			<tr>


				<th class="text-center">Date</th>
				<th class="text-center">Task ID </th>
				<th class="text-center">Description</th>
				<th class="text-center ">Version Number </th>

			</tr>
			</thead>
			<tbody>


			<tr>
				<td class="text-center">2017-02-17</td>
				<td class="text-center">1 </td>
				<td class="text-center">Created date added to reference csv file and export file</td>
				<td class="text-center ">1.0.0001 </td>
			</tr>

			</tbody>
		</table>



	</div>


@endsection


@section('footer')
	@parent

	<script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script>
	<script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('js/filter/jquery.filtertable.min.js') }}"></script>
	<script src="{{ url('js/filter/jquery.hideseek.min.js') }}"></script>
	<script src="{{ url('js/filter/initializers.js') }}"></script>
	<script src="{{ url('js/jquery.validate.min.js') }}"></script>
	<script src="{{ url('js/alert.js') }}"></script>

	<script>


	</script>

@endsection