@include('partials.functions')
@extends('admin.home')
@section('title', 'Patient List')
<link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('css/admin/admintable.css')}}">


@section('content')
    <div id="content-wrapper" class="container">
        <section class="col-sm-12">
            <div class="section-header">
                <h1>Patient List</h1><br>
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
                    {!! $pl_list->render() !!}
                </div>
                <div class="col-xs-12 col-md-6 text-right">
                    {!! Form::open(array('url' => 'admin/whiteboardward/search-list','method' => 'get', 'class' => 'form-inline inline', 'style' => 'display: inline')) !!}
                    <span class="input-group">
						{!! Form::text('search', null,array('required','class'=>'form-control','placeholder'=>'Search for...')) !!}
                        <span class="input-group-btn">
								{!! Form::submit('Go',array('class'=>'btn btn-primary btn-md')) !!}
								</span>
						</span>
                    {!! Form::close() !!}


                </div>
            </div>
        </section>
        <section class="col-sm-12 ">
            @if (count($pl_list) > 0)
                <div class="inner" id="adminDiv" style="overflow-y: scroll;">
                    <table id="patient_list_table_admin" class="table  table-bordered  table-wrapper horizontal_scroll" >

                        <thead style="background: #ffffff">
                        <tr>
                            <th class="item">Name</th>
                            <th>Bed</th>
                            <th>Con</th>
                            <th>Admit DT</th>
                            <th>EDD</th>
                            <th>MED Fit</th>
                            <th>Delayed Dis Reason</th>
                            <th>Ward</th>
                            <th>Side room?</th>
                            <th>EMFFD</th>
                            <th>Physio Decision DT</th>
                            <th>Physio Required</th>
                            <th>Physio Status</th>
                            <th>DT</th>
                            <th>OT Decision DT</th>
                            <th>OT Status</th>
                            <th>DT</th>
                            <th>DART Decision DT</th>
                            <th>DART Status</th>
                            <th>DT</th>
                            <th>MH Decision DT</th>
                            <th>MH Status</th>
                            <th>DT</th>
                            <th>SaLT Decision DT</th>
                            <th>SaLT Status</th>
                            <th>DT</th>
                            <th>DNursing Decision DT</th>
                            <th>DNursing Status</th>
                            <th> DT</th>
                            <th> Dietetics Decision DT</th>
                            <th>Dietetics Status</th>
                            <th>DT</th>
                            <th>Trans DT</th>

                        </tr>
                        </thead>
                        @foreach ($pl_list as $pl)
                            <tr>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->name}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->bed}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->con}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->admit_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->edd}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->med_fit}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dd_reason}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{ward_value($pl->actual_ward)}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->side_room}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->emffd}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->physio_decision_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->physio_required}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->physio_status}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->physio_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->ot_decision_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->ot_status}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->ot_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dart_decision_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dart_status}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dart_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->mh_decision_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->mh_status}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->mh_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->salt_decision_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->salt_status}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->salt_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dnursing_decision_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dnursing_status}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dnursing_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dietetics_decision_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dietetics_status}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->dietetics_dt}}</a>
                                </td>
                                <td><a class="patient-detail-hover"
                                       href="{{url('admin/whiteboardward/patient-detail-view/'.$pl->id)}}">{{$pl->trans_dt}}</a>
                                </td>

                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <h4 class="text-center">No records found!</h4>
            @endif
        </section>
        <div class="col-md-12">
            {!! $pl_list->render() !!}
        </div>
    </div>
@endsection
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(array('url' => 'admin/bed-management/patient-list', 'method'=>'post', 'enctype' => 'multipart/form-data')) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
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
    <script src="{{ url('js/users/index.js') }}"></script>
    <script src="{{ url('js/jquery.stickytableheaders.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // STICKY HEAD

            $('#patient_list_table_admin').stickyTableHeaders();
        });
    </script>
@endsection