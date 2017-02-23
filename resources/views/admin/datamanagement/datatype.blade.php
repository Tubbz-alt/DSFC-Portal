<?php
function datatype($str){

	if ($str== "Date") {
		$str = 'date';
	}
    elseif ($str == "varchar") {
        $str = 'Text';
    }
    elseif($str == "int"){
		$str = 'integer';
	}
	elseif($str == "bigint"){
		$str = 'bigint';
	}
	elseif($str == "nvarchar"){
		$str = 'text';
	}
	elseif($str == "date"){
		$str = 'date';
	}
	elseif($str == "time"){
		$str = 'time';
	}
	elseif($str == "datetime"){
		$str = 'datetime';
	}
    else{
        $str ;
    }
	return $str;
}

?>
@extends('admin.home')

@section('title', 'Mapping')
<style>
    .table.table-striped.table-bordered td  {
        border: medium none;
        vertical-align: middle !important;
    }
    .table.table-striped.table-bordered th {
        border-bottom: 1px solid #ccc;

    }
	.data-type tr td{
		padding: 4px !important;
		vertical-align: middle;
	}
	.data-type td:nth-child(1), .table-wrapper th:nth-child(1) {
		width:12% !important;
	}
	.data-type td:nth-child(2), .table-wrapper th:nth-child(2) {
		width:12% !important;
	}
</style>
@section('content')

	<div id="content-wrapper" class="container">
		<div class="col-md-12">

		</div>

		<section class="col-sm-12 table-responsive margin-top-10">
			<table class="table table-striped table-bordered data-type">

				@if (count($definitions_data) > 0)


					<tbody>
                          {{--*/ $temp = array(); /*--}}
					@foreach($definitions_data as $datas)

                            {{--*/ $datachanged = current(explode(' ',datatype($datas->codedValueType))); /*--}}


                            <tr>

								@if($datas->datatypeMapStatus==1)
									<td class="text-center " >{{datatype($datas->dataTypeName)}} </td>
									<td class="text-center " >Mapped To </td>
									<td width="10%" class="text-center" >
									<div  class="col-md-12 ">
										{!! Form::select('dataset_belongs',
                                            $datatypes,$datas->dataTypeMapName,
                                            ['class' => 'form-control col-md-4 datatypechange','id'=>'datatypechange','data-id'=>$datas->definitionID])
                                  !!}
									</div>
									</td>

								@else
									<td class="text-center " >{{datatype($datas->codedValueType)}} </td>
									<td class="text-center " >Mapped To </td>
									<td width="10%" class="text-center" >
									<div  class="col-md-12 ">
										{!! Form::select('dataset_belongs',
                                            $datatypes,'',
                                            ['class' => 'form-control col-md-4 datatypechange','id'=>'datatypechange','data-id'=>$datas->definitionID])
                                  !!}
									</div>
									</td>

								@endif


                                <td width="20%" class="text-center">
									<button type="button " id="datasetbutton_{{$datas->definitionID}}" data-name="{{$datas->codedValueType}}" data-id="{{$datas->definitionID}}" class="btn btn-primary savedata" disabled>Save</button>


								</td>
                            </tr>

                            {{--*/  $temp[] = current(explode(' ',datatype($datas->codedValueType))); /*--}}


					@endforeach
				 @else
					<tr>
						 <td>
							<h4 class="text-center">No records found!</h4>
						</td>
					 </tr>
				 @endif



					</tbody>
					<tbody>

					</tbody>
			</table>
		</section>


	</div>



@endsection

@section('footer')
	@parent

	<script src="{{ url('js/users/index.js') }}"></script>
	<script>
		$(document).ready(function () {

			$(document).on('click', '.oneormoremappingfinal ', function(e){
				var id = $(this).attr('id');

				$(".coded_values_mapping_final_"+id).toggleClass('invisible-data-final');


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
					url: "{{ url("admin/reference-data/selected-data-moremapping-final") }}",
					data: {"data_selected":checked,"_token": token,"datacount":datacount,
						"data_item":dataitemname,"nationalvalue":nationalvalue},
					type: 'POST',
					success: function (data) {
						$(".nationaldata").html(data);



					}


				});




			});





			$(".datatypechange").change(function () {

				var data_id = $(this).attr('data-id');
				$('#datasetbutton_'+data_id).removeAttr("disabled")
			});

			$(".savedata").click(function () {

				var data_id = $(this).attr('data-id');
				var data_name = $(this).attr('data-name');

				$('#datasetbutton_'+data_id).removeAttr("disabled")


				var value = $(this).parent().prev().find('select option:selected').val();



				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/data-type-change")}}',
					data: {"data_id": data_id,"_token": token,"value":value,"data_name":data_name},
					cache: false,
					success: function (data) {
						window.location.reload();
					}
				});


			});

			$(".mappingapproval").click(function () {

				var data_id = $(this).attr('data-id');
				var status = $(this).attr('data-status');

				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/mapping-approval")}}',
					data: {"data_id": data_id,"_token": token,"status":status},
					cache: false,
					success: function (data) {
						window.location.reload();
					}
				});


			});
			$(".destroydata").click(function () {

				var data_id = $(this).attr('data-id');
				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/destroy")}}',
					data: {"data_id": data_id,"_token": token,"status":status},
					cache: false,
					success: function (data) {
						window.location.reload();
					}
				});


			});

			$(".commentbtn").click(function () {

				var data_id = $(this).val();
				var data_parent_comment_id = $(this).attr('data-parent-comment-id');

				var comments = $('#working_comment_'+data_id).val();


				var token = "{{csrf_token()}}";
				$.ajax({
					type: "POST",
					url: '{{url("admin/reference-data/comments")}}',
					data: {"data_id": data_id,"_token": token,"comments":comments,"data_parent_comment_id":data_parent_comment_id},
					cache: false,
					success: function (data) {
						$('.working_comments').val('');
						window.location.reload();
					}
				});


			});

		});

	</script>
@endsection