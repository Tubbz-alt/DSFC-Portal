@include('partials.functions')
@extends('admin.home')

@section('title', 'Threshold')


<style>

    .loader-bg {
        background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
        height: 100%;
        position: absolute;
        width: 100%;
        z-index: 1000;

    }
    .threshold input{
        font-size:13px;
        height:33px;
        width: 80px;
        margin: 0 auto;
    }
    .threshold select{
        margin: 0 auto;
        width: 120px;
    }

    .set_threshold {
        width: 100px !important;
    }
    table {
        table-layout: fixed;
    }




</style>

@section('content')
    <div id="content-wrapper" class="container">
        <div class="row" style="margin:20px  auto">
            <div class="col-xs-12 col-md-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <section class="col-sm-12 table-responsive">
            <div class="tab-strip" style="padding: 0px;">
            <div class="tabBlock">
                <ul class="tabBlock-tabs">
                    <li class="tabBlock-tab is-active set-tab" id="edgreen" data-value="lounge">Ed Green</li>
                    <li class="tabBlock-tab  set-tab" id="edamber" data-value="lounge">Ed Amber</li>
                    <li class="tabBlock-tab  set-tab" id="edred" data-value="lounge">Ed Red</li>
                    <li class="tabBlock-tab  set-tab" id="edblack" data-value="lounge">Ed Black</li>
                </ul>
                <div class="tabBlock-content">

                    {{-- ED Green--}}
                    <div class="tabBlock-pane">
                        <div class="panel panel-default threshold">
                    <table class="table table-striped table-bordered col-md-12">
                    <thead>
                    <tr>
                        <th class="text-center">Category</th>
                        <th class="text-center">Patient Safety</th>
                        <th class="text-center">ED Capacity</th>
                        <th class="text-center">ED Flow-Safety and Capacity</th>

                        <th class="text-center"></th>


                    </tr>
                    </thead>
                    <!-- Started Loop for fetching records from DB (for loop) -->
                    <tbody>
                    <tr>


                    @if(count($resus)>=1)

                            {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                            {!! Form::hidden('category', 'Resus') !!}
                            {!! Form::hidden('color', 'green') !!}

                            <th>Resus</th>
                            @foreach($resus as $resus_data)
                            <td>

                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$resus_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$resus_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$resus_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$resus_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$resus_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$resus_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>

                                {!! Form::hidden('id',  $resus_data->id ) !!}
                            @endforeach
                        @else

                            {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                            {!! Form::hidden('category', 'Resus') !!}
                            {!! Form::hidden('color', 'green') !!}

                            <th>Resus</th>

                            <td>
                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>


                        @endif

                            <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                        {!! Form::close() !!}
                    </tr>
                    <tr>


                        @if(count($majors)>=1)
                            {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                            {!! Form::hidden('category', 'Majors') !!}
                            {!! Form::hidden('color', 'green') !!}

                            <th>Majors</th>
                            @foreach($majors as $majors_data)
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$majors_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$majors_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$majors_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$majors_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$majors_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$majors_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>

                                {!! Form::hidden('id',  $majors_data->id ) !!}
                            @endforeach
                        @else
                            {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                            {!! Form::hidden('category', 'Majors') !!}
                            {!! Form::hidden('color', 'green') !!}

                            <th>Majors</th>

                            <td>
                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>


                        @endif


                        <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                    {!! Form::close() !!}
                    </tr>
                    <tr>
                        @if(count($minors)>=1)
                            {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                            {!! Form::hidden('category', 'Minors') !!}
                            {!! Form::hidden('color', 'green') !!}

                            <th>Minors</th>
                            @foreach($minors as $minors_data)
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$minors_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$minors_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$minors_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$minors_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$minors_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$minors_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>

                                {!! Form::hidden('id',  $minors_data->id ) !!}
                            @endforeach
                        @else
                            {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                            {!! Form::hidden('category', 'Minors') !!}
                            {!! Form::hidden('color', 'green') !!}

                            <th>Minors</th>

                            <td>
                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>

                        @endif


                        <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                    {!! Form::close() !!}
                    </tr>

                    <tr>
                        @if(count($paeds)>=1)
                            {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                            {!! Form::hidden('category', 'Paeds ED') !!}
                            {!! Form::hidden('color', 'green') !!}

                            <th>Paeds</th>
                            @foreach($paeds as $paeds_data)
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$paeds_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$paeds_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$paeds_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$paeds_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$paeds_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$paeds_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>

                                {!! Form::hidden('id',  $paeds_data->id ) !!}
                            @endforeach
                        @else
                            {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                            {!! Form::hidden('category', 'Paeds ED') !!}
                            {!! Form::hidden('color', 'green') !!}

                            <th>Paeds</th>

                            <td>
                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>

                        @endif

                        <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                    {!! Form::close() !!}
                    </tr>



                    <tr>
                        @if(count($overall_status)>=1)
                            {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                            {!! Form::hidden('category', 'Overall') !!}
                            {!! Form::hidden('color', 'green') !!}

                            <th>Overall</th>
                            @foreach($overall_status as $overall_data)
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$overall_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$overall_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$overall_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$overall_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>
                                <td>
                                    <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$overall_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                    &nbsp;
                                    <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$overall_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                </td>

                                {!! Form::hidden('id',  $overall_data->id ) !!}
                            @endforeach
                        @else
                            {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                            {!! Form::hidden('category', 'Overall') !!}
                            {!! Form::hidden('color', 'green') !!}

                            <th>Overall</th>

                            <td>
                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>
                            <td>
                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                &nbsp;
                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                            </td>

                        @endif

                        <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                    {!! Form::close() !!}
                    </tr>


                    </tbody>
                </table>

            </div>
                    </div>


                    {{-- ED Amber--}}
                    <div class="tabBlock-pane">
                        <div class="panel panel-default threshold">
                            <table class="table table-striped table-bordered col-md-12">
                                <thead>
                                <tr>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Patient Safety</th>
                                    <th class="text-center">ED Capacity</th>
                                    <th class="text-center">ED Flow-Safety and Capacity</th>

                                    <th class="text-center"></th>


                                </tr>
                                </thead>
                                <!-- Started Loop for fetching records from DB (for loop) -->
                                <tbody>
                                <tr>


                                    @if(count($resus_amber)>=1)

                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Resus') !!}
                                        {!! Form::hidden('color', 'amber') !!}

                                        <th>Resus</th>
                                        @foreach($resus_amber as $resus_data)
                                            <td>

                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$resus_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$resus_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$resus_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$resus_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$resus_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$resus_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $resus_data->id ) !!}
                                        @endforeach
                                    @else

                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Resus') !!}
                                        {!! Form::hidden('color', 'amber') !!}

                                        <th>Resus</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>


                                    @endif

                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>
                                <tr>


                                    @if(count($majors_amber)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Majors') !!}
                                        {!! Form::hidden('color', 'amber') !!}

                                        <th>Majors</th>
                                        @foreach($majors_amber as $majors_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$majors_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$majors_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$majors_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$majors_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$majors_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$majors_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $majors_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Majors') !!}
                                        {!! Form::hidden('color', 'amber') !!}

                                        <th>Majors</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>


                                    @endif


                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>
                                <tr>
                                    @if(count($minors_amber)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Minors') !!}
                                        {!! Form::hidden('color', 'amber') !!}

                                        <th>Minors</th>
                                        @foreach($minors_amber as $minors_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$minors_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$minors_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$minors_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$minors_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$minors_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$minors_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $minors_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Minors') !!}
                                        {!! Form::hidden('color', 'amber') !!}

                                        <th>Minors</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>

                                    @endif


                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>

                                <tr>
                                    @if(count($paeds_amber)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Paeds ED') !!}
                                        {!! Form::hidden('color', 'amber') !!}

                                        <th>Paeds</th>
                                        @foreach($paeds_amber as $paeds_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$paeds_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$paeds_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$paeds_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$paeds_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$paeds_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$paeds_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $paeds_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Paeds ED') !!}
                                        {!! Form::hidden('color', 'amber') !!}

                                        <th>Paeds</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>

                                    @endif

                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>



                                <tr>
                                    @if(count($overall_status_amber)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Overall') !!}
                                        {!! Form::hidden('color', 'amber') !!}

                                        <th>Overall</th>
                                        @foreach($overall_status_amber as $overall_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$overall_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$overall_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$overall_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$overall_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$overall_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$overall_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $overall_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Overall') !!}
                                        {!! Form::hidden('color', 'amber') !!}

                                        <th>Overall</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>

                                    @endif

                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>

                    {{-- ED red--}}
                    <div class="tabBlock-pane">
                        <div class="panel panel-default threshold">
                            <table class="table table-striped table-bordered col-md-12">
                                <thead>
                                <tr>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Patient Safety</th>
                                    <th class="text-center">ED Capacity</th>
                                    <th class="text-center">ED Flow-Safety and Capacity</th>

                                    <th class="text-center"></th>


                                </tr>
                                </thead>
                                <!-- Started Loop for fetching records from DB (for loop) -->
                                <tbody>
                                <tr>


                                    @if(count($resus_red)>=1)

                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Resus') !!}
                                        {!! Form::hidden('color', 'red') !!}

                                        <th>Resus</th>
                                        @foreach($resus_red as $resus_data)
                                            <td>

                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$resus_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$resus_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$resus_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$resus_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$resus_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$resus_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $resus_data->id ) !!}
                                        @endforeach
                                    @else

                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Resus') !!}
                                        {!! Form::hidden('color', 'red') !!}

                                        <th>Resus</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>


                                    @endif

                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>
                                <tr>


                                    @if(count($majors_red)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Majors') !!}
                                        {!! Form::hidden('color', 'red') !!}

                                        <th>Majors</th>
                                        @foreach($majors_red as $majors_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$majors_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$majors_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$majors_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$majors_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$majors_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$majors_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $majors_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Majors') !!}
                                        {!! Form::hidden('color', 'red') !!}

                                        <th>Majors</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>


                                    @endif


                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>
                                <tr>
                                    @if(count($minors_red)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Minors') !!}
                                        {!! Form::hidden('color', 'red') !!}

                                        <th>Minors</th>
                                        @foreach($minors_red as $minors_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$minors_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$minors_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$minors_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$minors_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$minors_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$minors_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $minors_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Minors') !!}
                                        {!! Form::hidden('color', 'red') !!}

                                        <th>Minors</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>

                                    @endif


                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>

                                <tr>
                                    @if(count($paeds_red)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Paeds ED') !!}
                                        {!! Form::hidden('color', 'red') !!}

                                        <th>Paeds</th>
                                        @foreach($paeds_red as $paeds_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$paeds_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$paeds_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$paeds_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$paeds_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$paeds_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$paeds_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $paeds_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Paeds ED') !!}
                                        {!! Form::hidden('color', 'red') !!}

                                        <th>Paeds</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>

                                    @endif

                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>



                                <tr>
                                    @if(count($overall_status_red)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Overall') !!}
                                        {!! Form::hidden('color', 'red') !!}

                                        <th>Overall</th>
                                        @foreach($overall_status_red as $overall_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$overall_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$overall_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$overall_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$overall_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$overall_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$overall_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $overall_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Overall') !!}
                                        {!! Form::hidden('color', 'red') !!}

                                        <th>Overall</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>

                                    @endif

                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>

                    {{-- ED black--}}
                    <div class="tabBlock-pane">
                        <div class="panel panel-default threshold">
                            <table class="table table-striped table-bordered col-md-12">
                                <thead>
                                <tr>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Patient Safety</th>
                                    <th class="text-center">ED Capacity</th>
                                    <th class="text-center">ED Flow-Safety and Capacity</th>

                                    <th class="text-center"></th>


                                </tr>
                                </thead>
                                <!-- Started Loop for fetching records from DB (for loop) -->
                                <tbody>
                                <tr>


                                    @if(count($resus_black)>=1)

                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Resus') !!}
                                        {!! Form::hidden('color', 'black') !!}

                                        <th>Resus</th>
                                        @foreach($resus_black as $resus_data)
                                            <td>

                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$resus_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$resus_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$resus_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$resus_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$resus_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$resus_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $resus_data->id ) !!}
                                        @endforeach
                                    @else

                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Resus') !!}
                                        {!! Form::hidden('color', 'black') !!}


                                        <th>Resus</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>


                                    @endif

                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>
                                <tr>


                                    @if(count($majors_black)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Majors') !!}
                                        {!! Form::hidden('color', 'black') !!}

                                        <th>Majors</th>
                                        @foreach($majors_black as $majors_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$majors_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$majors_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$majors_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$majors_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$majors_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$majors_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $majors_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Majors') !!}
                                        {!! Form::hidden('color', 'black') !!}

                                        <th>Majors</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>


                                    @endif


                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>
                                <tr>
                                    @if(count($minors_black)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Minors') !!}
                                        {!! Form::hidden('color', 'black') !!}

                                        <th>Minors</th>
                                        @foreach($minors_black as $minors_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$minors_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$minors_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$minors_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$minors_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$minors_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$minors_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $minors_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Minors') !!}
                                        {!! Form::hidden('color', 'black') !!}

                                        <th>Minors</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>

                                    @endif


                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>

                                <tr>
                                    @if(count($paeds_black)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Paeds ED') !!}
                                        {!! Form::hidden('color', 'black') !!}

                                        <th>Paeds</th>
                                        @foreach($paeds_black as $paeds_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$paeds_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$paeds_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$paeds_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$paeds_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$paeds_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$paeds_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $paeds_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Paeds ED') !!}
                                        {!! Form::hidden('color', 'black') !!}

                                        <th>Paeds</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>

                                    @endif

                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>



                                <tr>
                                    @if(count($overall_status_black)>=1)
                                        {!! Form::open(array('url' => 'admin/threshold/update-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Overall') !!}
                                        {!! Form::hidden('color', 'black') !!}

                                        <th>Overall</th>
                                        @foreach($overall_status_black as $overall_data)
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="{{$overall_data->patient_safety_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="{{$overall_data->patient_safety_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="{{$overall_data->ed_capacity_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="{{$overall_data->ed_capacity_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>
                                            <td>
                                                <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="{{$overall_data->ed_flow_min}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                                &nbsp;
                                                <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="{{$overall_data->ed_flow_max}}" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            </td>

                                            {!! Form::hidden('id',  $overall_data->id ) !!}
                                        @endforeach
                                    @else
                                        {!! Form::open(array('url' => 'admin/threshold/set-threshold', 'method'=>'post','class'=>'admin-user')) !!}

                                        {!! Form::hidden('category', 'Overall') !!}
                                        {!! Form::hidden('color', 'black') !!}

                                        <th>Overall</th>

                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="patient_safety_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="patient_safety_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_capacity_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_capacity_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>
                                        <td>
                                            <input placeholder="Min Value" class="text-center" name="ed_flow_min" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                            &nbsp;
                                            <input placeholder="Max Value" class="text-center" name="ed_flow_max" type="number" value="" min="0" max="100"  size="20" class="col-md-8 set_timer form-control">
                                        </td>

                                    @endif

                                    <td>{!! Form::submit('Set Threshold', array('class' => 'btn btn-primary set_threshold')) !!}</td>

                                    {!! Form::close() !!}
                                </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>



                </div>
            </div>
          </div>
        </section>


    </div>

@endsection

@section('footer')
    @parent
    <script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
    <script>
        jQuery(document).ready(function (e) {
            var active_tab='#{{$tab_color_selected}}';
            $(active_tab).click();

            $(".set-tab").click(function () {

                var token = "{{csrf_token()}}";
                var data_name =$(this).attr('id');

                $.ajax({
                    url: "<?= URL::to('/admin/threshold/set-tabs') ?>",
                    type: 'POST',
                    dataType: 'html',
                    data: {"data_name": data_name,"_token": token},
                    success:function (data) {


                    }
                });
            });

        });
    </script>


@endsection