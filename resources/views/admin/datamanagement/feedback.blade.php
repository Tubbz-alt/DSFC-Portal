@extends('admin.home')

@section('title', 'Feed back')
<style>
	.editbox{
		display: none;
	}
	.edit_td{
		cursor: pointer;
	}
</style>

@section('content')
	<div id="content-wrapper" class="container">

		<section class="col-sm-12 table-responsive">
			<div class="panel panel-default ">
				<table class="table table-striped table-bordered mapping-table">
					<thead>
					<tr>
						<th class="text-center ">Summary </th>
						<th class="text-center ">Details</th>
						<th class="text-center ">Title</th>
						<th class="text-center ">URL </th>
						<th class="text-center ">Name  </th>
						<th class="text-center ">Email address </th>

					</tr>
					</thead>
					<tbody>
					@foreach($feedback as $data)
					<tr>
						<td class="text-center ">{{$data->subject}} </td>
						<td class="text-center ">{{$data->description}} </td>
						<td class="text-center ">{{$data->title}} </td>
						<td class="text-center ">{{$data->url}} </td>
						<td class="text-center ">{{$data->name}} </td>

						<td  class="edit_td">
							<div id="investdiv">
								<span  class="text investigated">{{$data->email}}</span>
							</div>
							<input  type="email" data-token="{{ csrf_token() }}" value="{{$data->email}}" class="editbox hiddentext" data-id="{{$data->feedbackId}}" />

						</td>
					</tr>
						@endforeach
					</tbody>


				</table>


			</div>
		</section>


	</div>



@endsection

@section('footer')
	@parent
	<script src="{{ url('js/all.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script>
	<script>
		$(document).ready(function () {


			$(document).on('click', '.edit_td', function(){

				$('.investigated',this).hide();
				$(this).children(".hiddentext").show();
			});

			$(document).on('change', '.hiddentext', function(){
				$(this).hide();
				/*edit text*/
				var ID=$(this).attr('data-id');
				var emailvalue=$(this).val();
				var token = "{{csrf_token()}}";
					$.ajax({
						type: "POST",
						url: "{{ url('admin/reference-data/feedback-update') }}",
						data: {"ID": ID,"emailvalue": emailvalue,"_token": token},
						cache: false,
						success: function(data)
						{
							$("#investdiv").html(data);

						}
					});



			});

			$(document).on('click', '.oneormoremappingfinal', function(e){
				var id = $(this).attr('id');


				var checked = []
				$("input[name='wizard_list[]']:checked").each(function () {
					checked.push(parseInt($(this).val()));
				});

				checked.push(parseInt($(this).attr('data-reference')));
				var token = "{{csrf_token()}}";
				var dataitemname = $(this).attr('data-item');
				var nationalvalue = $(this).attr('data-national');
				if(checked==""){
					checked = $(this).attr('data-reference');
					checked.push(checked);
					var datacount = "single";
				}else{
					var datacount = "multiple";
				}
				$.ajax({
					url: "{{ url("admin/reference-data/selected-data-moremapping-dataitem") }}",
					data: {"data_selected":checked,"_token": token,"datacount":datacount,
						"data_item":dataitemname,"nationalvalue":nationalvalue},
					type: 'POST',
					success: function (data) {
						$("#nationaldata").html(data);
						$('#myModalnationaldata').modal('show');


					}


				});




			});


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