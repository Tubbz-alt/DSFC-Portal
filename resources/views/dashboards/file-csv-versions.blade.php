@extends('master')
@section('page-title', 'Reference Library Portal')
@section('header')
    @parent
<link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">
<style>
	.details-hover{
		cursor: pointer; cursor: hand;
	}
	.textarea{
		resize: none;
	}

    .chat-window{

        position:fixed;
        float:right;
       
    }
    .chat-window > div > .panel{
        border-radius: 5px 5px 0 0;
    }
    .icon_minim{
        padding:2px 10px;
    }
    .msg_container_base{
        background: #e5e5e5;
        margin: 0;
        padding: 0 10px 10px;
        max-height:300px;
        overflow-x:hidden;
    }
    .top-bar {
        background: #666;
        color: white;
        padding: 10px;
        position: relative;
        overflow: hidden;
    }
    .msg_receive{
        padding-left:0;
        margin-left:0;
    }
    .msg_sent{
        padding-bottom:20px !important;
        margin-right:0;
    }
    .messages {
        background: white;
        padding: 10px;
        border-radius: 2px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        max-width:100%;
    }
    .messages > p {
        font-size: 13px;
        margin: 0 0 0.2rem 0;
    }
    .messages > time {
        font-size: 11px;
        color: #ccc;
    }
    .msg_container {
        padding: 10px;
        overflow: hidden;
        display: flex;
    }
    img {
        display: block;
        width: 100%;
    }
    .avatar {
        position: relative;
    }
    .base_receive > .avatar:after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 0;
        height: 0;
        border: 5px solid #FFF;
        border-left-color: rgba(0, 0, 0, 0);
        border-bottom-color: rgba(0, 0, 0, 0);
    }

    .base_sent {
        justify-content: flex-end;
        align-items: flex-end;
    }
    .base_sent > .avatar:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 0;
        border: 5px solid white;
        border-right-color: transparent;
        border-top-color: transparent;
        box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
    }

    .msg_sent > time{
        float: right;
    }



    .msg_container_base::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    .msg_container_base::-webkit-scrollbar
    {
        width: 12px;
        background-color: #F5F5F5;
    }

    .msg_container_base::-webkit-scrollbar-thumb
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }

    .btn-group.dropup{
        position:fixed;
        left:0px;
        bottom:0;
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

					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#csvDataModel">Import New Data</button>
				</div>
			</div>
		</section>
		<div class="tabBlock">
						<section class="col-sm-12 table-responsive">
							<div class="panel panel-default">
								<table class="table table-striped table-bordered">
									@if (count($csv_list) > 0)
										<tr>
											<th class="text-center">File Title</th>
											<th class="text-center">File Description</th>
											<th class="text-center">Created Date</th>
											<th class="text-center">Version</th>
											<th class="text-center">Comments</th>
											<th class="text-center">File Info</th>



										</tr>
										{{--*/ $j=1 /*--}}
										@foreach ($csv_list as $pl)
											@if($pl->parentCommentId==0)
											<tr>
												<td class="text-center"><a 	class="patient-detail-hover text-center" >{{$pl->fileTitle}}</a></td>
												<td class="text-center"><a 	class="patient-detail-hover text-center">{{$pl->fileDescription}}</a></td>
												<td class="text-center"><a 	class="patient-detail-hover text-center">{{$pl->createdDate}}</a></td>
												<td class="text-center"><a 	class="patient-detail-hover text-center">1.{{$j}}</a></td>
												<td class="text-center">
													@if(!empty($pl->commentText))
													<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModalComments_{{$pl->conceptReferenceDataId}}">Comments</button>
													@endif
												</td>
												<td class="text-center">

													<a href="{{url('dashboard/csv-management/details/'.$pl->conceptReferenceDataId)}}" 	class="patient-detail-hover details-hover">Info</a></td>

											</tr>
											{{--*/ $j++ /*--}}

										<!-- Modal -->
											<div class="modal fade" id="myModalComments_{{$pl->conceptReferenceDataId}}" role="dialog">
												<div class="modal-dialog">

													<!-- Modal content-->
													<div class="modal-content">
                                                            <div class="row chat-window col-xs-5 col-md-12" id="chat_window_1">
                                                                <div class="col-xs-12 col-md-12">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading top-bar">
                                                                            <div class="col-md-8 col-xs-8">
                                                                                <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> NHS DATA Comments</h3>
                                                                            </div>
                                                                            <div class="col-md-4 col-xs-4" style="text-align: right;">
                                                                                <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                                                                                <a href="#"><span class="glyphicon glyphicon-remove icon_close close" data-id="chat_window_1" data-dismiss="modal"></span></a>
                                                                            </div>
                                                                        </div>

                                                                        <div class="panel-body msg_container_base">
                                                                            @foreach($reply_comments as $reply)

                                                                                @if($reply->referenceDetailId ==$pl->referenceDetailId)
                                                                                    @if($reply->userId == Sentinel::check()->id)
                                                                                    <div class="row msg_container base_sent">
                                                                                        <div class="col-md-10 col-xs-10">
                                                                                            <div class="messages msg_sent">
                                                                                                <p>{{$reply->commentText}} </p>
                                                                                                <time datetime="2009-11-13T20:00">{{date('Y F d G:i A', strtotime($reply->commentedDate))}}</time>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-2 col-xs-2 avatar">
                                                                                            <img src="{{url('images/avatar.jpg')}}" class=" img-responsive ">
                                                                                            <p>{{$reply->userName}} </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    @else
                                                                                    <div class="row msg_container base_receive">
                                                                                        <div class="col-md-2 col-xs-2 avatar">
                                                                                            <img src="{{url('images/avatar.jpg')}}" class=" img-responsive ">
                                                                                            <p>{{$reply->userName}} </p>
                                                                                        </div>
                                                                                        <div class="col-md-10 col-xs-10">
                                                                                            <div class="messages msg_receive">
                                                                                                <p>{{$reply->commentText}} </p>
                                                                                                <time datetime="2009-11-13T20:00">{{date('Y F d G:i A', strtotime($reply->commentedDate))}}</time>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                                @endif
                                                                            @endforeach

                                                                        <div class="panel-footer">
                                                                            <div class="input-group">
                                                                                <input  class="form-control input-sm chat_input replycomment" placeholder="Write your message here..." type="text" id="replycomment_{{$pl->commentId}}">
                                                                                <span class="input-group-btn">
                                                                                <button class="btn btn-primary btn-sm reply-comments" id="btn-chat" data-referenceid="{{$pl->conceptReferenceDataId}}" data-commentid ="{{$pl->commentId }}">Send</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
													</div>

												</div>
											</div>
											</div>
											@endif
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




	</div>
@endsection

@foreach($file_status as $fileinfo)

	<div class="modal fade" id="csvDataModel" tabindex="-1" role="dialog" aria-labelledby="csvDataModelLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				{!! Form::open(array('url' => 'dashboard/csv-management/csv-versions','files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data')) !!}
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
						{!! Form::label('filename', 'File Name') !!}
						{!! Form::text('file_title', $fileinfo->fileTitle, array('class' => 'form-control' , 'autocomplete' => 'off','readonly' => 'true')) !!}
						{!! Form::hidden('file_id', $fileinfo->conceptReferenceDataId, array('id' => $fileinfo->conceptReferenceDataId))!!}
					</div>
					<div class="form-group">
						{!! Form::label('filedescription', 'File Description') !!}
						{!! Form::text('filedescription', $fileinfo->fileDescription, array('class' => 'form-control' , 'autocomplete' => 'off','readonly' => 'true')) !!}
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
@endforeach







@section('footer')
	@parent
	<script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
	<script src="{{ url('js/users/index.js') }}"></script>
    <script>
        $(document).ready(function () {
            @if (count($errors) > 0)

            $('#csvDataModel').modal('show');
            @endif



			$(".reply-comments").click(function () {

				var data_id = $(this).attr('data-commentid');
				var referenceDetailId = $(this).attr('data-referenceid');

				var comments = $('#replycomment_'+data_id).val();


				var token = "{{csrf_token()}}";
			   $.ajax({
					type: "POST",
					url: '{{url("dashboard/csv-management/reply-comments")}}',
					data: {"data_id": data_id,"_token": token,"comments":comments,"referenceDetailId":referenceDetailId},
					cache: false,
					success: function (data) {
						$('.replycomment').val('');
						window.location.reload();
					}
				});


			});


        });
    </script>
@endsection