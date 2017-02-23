@extends('admin.home')

@section('title', 'Reference Data Details')

@section('content')
	<div id="content-wrapper" class="container">

		<section class="col-sm-12 table-responsive">
			<div class="panel panel-default ">
				<table class="table table-striped table-bordered">
					@if (count($dataset) > 0)

						<tr>
							<th class="text-center">Data Item Name</th>
							<th class="text-center">Data Set</th>
							<th class="text-center">Coded Value</th>
							<th class="text-center">Coded Value Type</th>
							<th class="text-center">Coded Value Description</th>

							<th class="text-center">Date Item ID</th>
							<th class="text-center ">Data Item Version ID</th>
							<th class="text-center">Coded Value ID</th>
							<th class="text-center">Coded Value Version ID</th>
							<th class="text-center">Author</th>
						</tr>
						@foreach ($dataset as $pl)

							<tr>
								<td class="text-center">{{$pl->dataItemName}}</td>
								<td class="text-center">{{$pl->datasetBelongs}}</td>

								<td class="text-center">{{$pl->codedValue}}</td>
								<td class="text-center">{{$pl->codedValueType}}</td>

								<td class="text-center">{{$pl->codedValueDescription}}</td>

								<td class="text-center ">{{$pl->dataItemId}}</td>
								<td class="text-center ">{{$pl->dataItemVersionId}}</td>
								<td class="text-center ">{{$pl->codedValueId}}</td>
								<td class="text-center ">{{$pl->codedValueVersionId}}</td>
								<td class="text-center ">{{$pl->username}}</td>
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


	<!-- Comment Modal -->
	<div id="commentModel" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Comments</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<br>
						<textarea style="resize: none" name="working_comment" id="working_comment" rows="4" cols="66"
								  placeholder="Please Enter Your Comments here..." required></textarea>
						<br>
						<br>
						<button type="commentbtn" id="commentbtn" name="commentbtn" value="commentbtn"
								class="btn btn-primary">Submit
						</button>
					</div>
				</div>

			</div>

		</div>
	</div>
@endsection

@section('footer')
	@parent
	<script src="{{ url('js/all.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script>
	<script>
		$(document).ready(function () {
			$(".csvapproval").click(function () {

				var data_id = $(this).attr('data-id');
				var status = $(this).attr('data-status');

				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/data-approval")}}',
					data: {"data_id": data_id,"_token": token,"status":status},
					cache: false,
					success: function (data) {
						window.location.reload();
					}
				});


			});

		});

	</script>
@endsection