@extends('master')
@section('page-title', 'Reference Library Portal')
@section('header')
    @parent

    <link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/jquery.dataTables.min.css')}}">
    <style>
        .details-hover{
            cursor: pointer; cursor: hand;
        }
        .nationalinactive{
            display: none;
        }
        .datagrid {
            margin-bottom: 79px;
        }
        .localinactive{
            display: none;
        }
        .nationalactive{
            display: block;
        }
        .localactive{
            display: block;
        }
        #wizardcsvDataModel .modal-dialog {
            margin: 30px auto;
            width: 900px;
        }
        .filter-table {
            width: 100%;
            float: left;
            margin-left: 16px;
        }
        .vertical.default_list {
            list-style: none;
            margin-top: 8px;
        }
        ARTICLE LABEL {
            background: #0072c6 none repeat scroll 0 0;
            color: white;
            display: block;
            font-size: 16px;
            font-weight: 100;
            line-height: 20px;
            margin-left: 7px;
            padding: 9px 0 10px 10px;
            width: 99%;
        }
        .six.columns input {
            margin-left: 10px;
        }
        .historycontent {
            width: 50%;
            margin-bottom: -27px;
        }
        .default_list li{
            font-size: 12px;
        }
        .dataset-class {
            width: 25%;
        }
        .datasetclass{
            margin-right: 10px;
        }
        .tabBlock-content {

            margin-top: -71px !important;
        }
        .donate-now {
            list-style-type:none;
            margin:1px 0 0 0;
            padding:0;
        }

        .donate-now li {
            float:left;
            margin:0 5px 0 0;
        }

        .donate-now label {
            padding:5px;
            border:1px solid #CCC;
            cursor:pointer;
        }

        .donate-now label:hover {
            background:#DDD;
        }


    </style>


@endsection
@section('title', 'Csv Data')
@section('content')
    <div class="file-data-loader">
        <span class="image-loader screen-center">
            <img src="{{ url('images/loading.gif') }}">
        </span>

    </div>
    <div  class="container">
        {!! Form::open(array('url'=>'admin/units/reading-material-image-upload/1','id'=>'form_pdfupload', 'class'=>'cmxform form-horizontal tasi-form', 'enctype' => 'multipart/form-data', 'files'=>true)) !!}




        <div class="form-group {{ $errors->has('count_amount') ? 'has-error' : ''}}">
            {!!Html::decode(Form::label('reading_material_image','Upload Images  <span class="red-required">*</span>', ['class' => 'control-label col-lg-2'])) !!}
            <div class="col-lg-10">
                {!! Form::file('reading_material_image[]', array('id'=>'reading_material_image', 'class' => 'imageUpload','files' => true, 'multiple' => true, 'accept'=>'image/*')) !!}
            </div>
        </div>
        <input type="hidden" name="course_id" value="{{$cid}}">
        <input type="hidden" name="unit_id" value="{{$uid}}">
        <div style="margin-bottom:40px">
            <div class="imageOutput"  > </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                {!! Form::submit('Upload', ['class' => 'btn btn-primary']) !!}
                <a href="{{ url('admin/units') }}"><button class="btn btn-default" type="button">Cancel</button></a>
            </div>
        </div>

        {!! Form::close() !!}
        <div class="tabBlock">
            </br>
            <ul class="tabBlock-tabs datachallenge-info">

                <li class="tabname tabBlock-tab set-tab is-active">Mapped</li>
                <li class="tabname tabBlock-tab set-tab ">Pending Approval</li>
                <li class="tabname tabBlock-tab set-tab ">To Be Mapped</li>
            </ul>
            <div class="tabBlock-content" >
                {{--mapped item--}}
                <div class="tabBlock-pane">
                    <div class="datagrid">
                        <table class="filtertable_csv  table  table-striped table-bordered definitions-table horizontal_scroll">
                            @if (count($mapped_item) > 0)
                                <thead>
                                <tr>

                                    <th class="text-center">Data Item Name</th>
                                    <th class="text-center">Coded Value </th>
                                    <th class="text-center">Coded Value Type </th>
                                    <th class="text-center">Coded Value Description </th>
                                    <th class="text-center">Date Item ID </th>
                                    <th class="text-center ">Data Item Version ID </th>
                                    <th class="text-center">Coded Value ID </th>
                                    <th class="text-center">Coded Value Version ID  </th>
                                    <th class="text-center">Author   </th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($mapped_item as $pl_mapped)
                                    <tr>

                                        <td class="text-center">{{$pl_mapped->dataItemName}}</td>
                                        <td class="text-center">{{$pl_mapped->codedValue}}</td>
                                        <td class="text-center" >{{$pl_mapped->codedValueType}}</td>

                                        <td class="text-center">{{$pl_mapped->codedValueDescription}}</td>
                                        <td class="text-center ">{{$pl_mapped->dataItemId}}</td>
                                        <td class="text-center ">{{$pl_mapped->dataItemVersionId}}</td>
                                        <td class="text-center ">{{$pl_mapped->codedValueId}}</td>
                                        <td class="text-center ">{{$pl_mapped->codedValueVersionId}}</td>
                                        <td class="text-center ">{{$pl_mapped->author}}</td>


                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <h4 class="text-center">No records found!</h4>
                                        </td>
                                    </tr>
                                @endif

                                </tbody>


                        </table>
                    </div>
                </div>
                {{-- Pending Approval--}}
                <div class="tabBlock-pane">
                    <div class="datagrid">
                        <table class="filtertable_csv  table  table-striped table-bordered definitions-table horizontal_scroll">
                            @if (count($pending_approval) > 0)
                                <thead>
                                <tr>

                                    <th class="text-center">Data Item Name</th>
                                    <th class="text-center">Coded Value </th>
                                    <th class="text-center">Coded Value Type </th>
                                    <th class="text-center">Coded Value Description </th>
                                    <th class="text-center">Date Item ID </th>
                                    <th class="text-center ">Data Item Version ID </th>
                                    <th class="text-center">Coded Value ID </th>
                                    <th class="text-center">Coded Value Version ID  </th>
                                    <th class="text-center">Author   </th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pending_approval as $pl_pending)
                                    <tr>

                                        <td class="text-center">{{$pl_pending->dataItemName}}</td>
                                        <td class="text-center">{{$pl_pending->codedValue}}</td>
                                        <td class="text-center" >{{$pl_pending->codedValueType}}</td>

                                        <td class="text-center">{{$pl_pending->codedValueDescription}}</td>
                                        <td class="text-center ">{{$pl_pending->dataItemId}}</td>
                                        <td class="text-center ">{{$pl_pending->dataItemVersionId}}</td>
                                        <td class="text-center ">{{$pl_pending->codedValueId}}</td>
                                        <td class="text-center ">{{$pl_pending->codedValueVersionId}}</td>
                                        <td class="text-center ">{{$pl_pending->author}}</td>



                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <h4 class="text-center">No records found!</h4>
                                        </td>
                                    </tr>
                                @endif

                                </tbody>


                        </table>
                    </div>
                </div>
                {{-- To Be Mapped--}}
                <div class="tabBlock-pane">
                    <div class="datagrid">
                        <table class="filtertable_csv filtertable_mapping table  table-striped table-bordered definitions-table horizontal_scroll">
                            @if (count($definitions_data) > 0)
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        Select
                                    </th>
                                    <th class="text-center">Data Item Name</th>
                                    <th class="text-center">Coded Value </th>
                                    <th class="text-center">Coded Value Type </th>
                                    <th class="text-center">Coded Value Description </th>
                                    <th class="text-center">Date Item ID </th>
                                    <th class="text-center ">Data Item Version ID </th>
                                    <th class="text-center">Coded Value ID </th>
                                    <th class="text-center">Coded Value Version ID  </th>
                                    <th class="text-center">Author   </th>
                                    <th class="text-center"></th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($definitions_data as $pl)
                                    <tr>
                                        <td class="text-center">
                                            <!-- checkbox to select the particular records -->
                                            {!! Form::checkbox('wizard_list[]', $pl->definitionID, null, ['class' => 'wizard_list'])!!}
                                        </td>
                                        <td class="text-center">{{$pl->dataItemName}}</td>
                                        <td class="text-center">{{$pl->codedValue}}</td>
                                        <td class="text-center" >{{$pl->codedValueType}}</td>

                                        <td class="text-center">{{$pl->codedValueDescription}}</td>
                                        <td class="text-center ">{{$pl->dataItemId}}</td>
                                        <td class="text-center ">{{$pl->dataItemVersionId}}</td>
                                        <td class="text-center ">{{$pl->codedValueId}}</td>
                                        <td class="text-center ">{{$pl->codedValueVersionId}}</td>
                                        <td class="text-center ">{{$pl->author}}</td>
                                        <td class="text-center " style="width: 100px;">

                                        <span>

                                                <a href="javascript:void(0)"><span
                                                            class="wizardcsvDataModel btn-primary btn-sm check-map check_{{$pl->definitionID}}"
                                                            data-reference="{{$pl->definitionID}}"
                                                            data-token="{{ csrf_token() }}">Map </span></a>

                                            </span>
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

                                </tbody>


                        </table>
                    </div>
                </div>
            </div>

        </div>




    </div>


    <div class="modal fade" id="wizardcsvDataModel" tabindex="-1" role="dialog" aria-labelledby="wizardcsvDataModelLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                {!! Form::open(array('url' => 'dashboard/data-item/store-info','files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data','id'=>'wizard_form_file')) !!}


                <div class="modal-header">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="wizardcsvDataModelLabel">Import Data </h4>
                </div>
                <div class="modal-body">
                    <section>
                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>
                                <ul class="nav nav-tabs" role="tablist">

                                    <li role="presentation" class="active">
                                        <a href="#step1" data-toggle="tab" aria-controls="step2" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon  glyphicon-info-sign"></i>
                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                                        </a>
                                    </li>


                                    <li role="presentation" class="disabled">
                                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
										<span class="round-tab">
											<i class="glyphicon glyphicon-ok"></i>
										</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <h3>Local or National </h3>
                                    <div class="col-md-12">
                                        <ul class="donate-now">
                                            <li><label for="Local">
                                                    <input value="Local" type="radio" id="a25" name="data_item" class="nationalfield">Local</label>
                                            </li>
                                            <li><label for="National">
                                                    <input value="National" type="radio" id="a50" name="data_item" class="nationalfield">National</label>
                                            </li>
                                        </ul>




                                        <div class="datagrid" id="recordslist">
                                            <table class="table  table-striped table-bordered definitions-table horizontal_scroll">
                                                <thead>
                                                <tr>

                                                    <th class="text-center">Data Item Name</th>
                                                    <th class="text-center">Coded Value </th>
                                                    <th class="text-center">Coded Value Type </th>
                                                    <th class="text-center">Coded Value Description </th>


                                                </tr>
                                                </thead>
                                                <tbody id="tbodyrecords" class="tbodyrecords_national">

                                                </tbody>


                                            </table>


                                        </div>

                                    </div>
                                    <ul class="list-inline pull-right localnational">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>

                                        <li><button type="button" class="btn btn-primary btn-info-full next-step-mapping">Next</button></li>
                                    </ul>

                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <article>
                                        <label for="search">Dataset this belongs</label>
                                    </article>
                                    <div class="col-md-12">
                                        <div >
                                            <div class="col-md-6 map_only  ">
                                                <div class="form-group dataset-class">
                                                    {!! Form::select('dataset_belongs',
                                                    (
                                                    [""=>"Please Select"]+['A&E' => 'A&E',
                                                    'Ambulance Services' => 'Ambulance Services',
                                                    'Inpatient' => 'Inpatient',
                                                    'Outpatients' => 'Outpatients',
                                                    'Mental Health' => 'Mental Health',
                                                    'Out of Hours' => 'Out of Hours',
                                                     '111' => '111']),'',['class' => 'form-control','id'=>'datasetbelongs']) !!}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>

                                        <li><button type="button" class="mapping_comments localinactive btn btn-primary btn-info-full next-step-mapping complete-wizard-final">Next</button></li>
                                        <li><button type="button" class="nationalmapping_comments nationalinactive btn btn-primary btn-info-full next-step-mapping complete-wizard-final">Map</button></li>


                                    </ul>

                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <input type="text" value="" id="sharepoinglink" class="form-control  sharepoinglink" placeholder="Insert Share Point Link Here" name="sharepoinglink">
                                        </div>


                                        <div id="commentry">
                                            <div class="col-md-6 mapping_comments localinactive">
                                                <input type="text" value="" id="dataitemmapping_comments" class="form-control  dataitemmapping_comments" placeholder="Your Comments" name="dataitemmapping_comments">
                                            </div>

                                            <div class="col-md-12 nationalmapping_comments nationalinactive" style="margin-top: 5px;">
                                                <div  class="modal-content  mymapping-content " style="width: 100%">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        <div class="col-md-2">

                                                        </div>
                                                        <div class="col-md-10">

                                                        </div>
                                                    </div>
                                                    <div class="modal-body rtt-popup">

                                                        <div class="row" >

                                                            <div class="six columns">
                                                                <article>
                                                                    <label for="search">National Data</label>
                                                                    <input id="search" name="search" placeholder="Start Typing Here" type="text" data-list=".default_list" autocomplete="off">
                                                                    <ul class="vertical default_list">
                                                                        @foreach($dditems as $itemData)
                                                                            <li class="col-md-6">
                                                                                {!! Form::radio('mychoice', $itemData->itemName, '', array('class' => 'selection radio-custom mappingdata')) !!} {{ $itemData->itemName }}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </article>
                                                            </div>
                                                        </div>





                                                    </div>
                                                    {{--<div class="modal-footer">
                                                        <button type="button" class="btn btn-default check-status" data-dismiss="modal">Mapped as local</button>
                                                        <button type="button" class="btn btn-primary submit-form-mapping ">Map</button>
                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>

                                        <li><button type="button" class="btn btn-primary btn-info-full next-step-mapping complete-wizard-final">Next</button></li>

                                    </ul>

                                </div>



                                <div class="tab-pane" role="tabpanel" id="complete">
                                    <h3>Complete</h3>
                                    <p>You have successfully completed all steps.</p>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>

                                        <li><button type="button" class="btn btn-success  btn-info-full next-step-mapping complete-mapping">Finish</button></li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </section>

                </div>

                {!! Form::close() !!}

            </div>
        </div>
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

    <script>
        $(window).load(function() {
            setTimeout(function () {
                $(".file-data-loader").hide();
            }, 2000);
        });
        $(document).ready(function () {



            $('#search-1').hideseek();
            $('.filtertable_mapping').DataTable( {
                "bPaginate": true,
                "pageLength": 20,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false
            } );




            $('.filtertable').filterTable({
                filterExpression: 'filterTableFindAll'
            });
            $('.filevalidation').click(function(e) {

                var val = $("#txtFileUpload").val();
                if(val == ''){
                    alert("Please Choose File");
                }

            });

            $("#txtFileUpload").change(function(){

                var val = $("#txtFileUpload").val();
                if(val == ''){
                    $('.filevalidation').addClass('disabled');
                }else{
                    $('.filevalidation').removeClass('disabled').addClass('fileinfo next-step-mapping');
                }
            });

            $('.file-data-loader').hide();





            $('.next-step-mapping').click(function() {


                var checked = []
                $("input[name='maped_list[]']:checked").each(function () { checked.push(parseInt($(this).val())); });


                var nlinfo =  $('.nationalfield:checked').val();

                if(nlinfo == "Local"){


                    $('.mapping_comments').show();
                    $('.nationalmapping_comments').hide();

                }
                else{
                    $('.mapping_comments').hide();
                    $('.nationalmapping_comments').show();


                }

            });


            $(document).on('click', '.wizardcsvDataModel', function(e){


                var checked = []
                $("input[name='wizard_list[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });

                checked.push(parseInt($(this).attr('data-reference')));
                var token = "{{csrf_token()}}";
                if(checked==""){
                    checked = $(this).attr('data-reference');
                    checked.push(checked);
                    var datacount = "single";
                }else{
                    var datacount = "multiple";
                }
                $('#wizardcsvDataModel').modal('show');
                $.ajax({
                    url: "{{ url("dashboard/mapping/selected-data") }}",
                    data: {"data_selected":checked,"_token": token,"datacount":datacount},
                    type: 'POST',
                    success: function (data) {


                        if(data == "Please Select Data"){
                            var eachrow = "<tr class='dataqyality-issue'>"
                                    + "<td class='text-center ' colspan='5'><h1 class='text-danger'>Please Select Data</h1></td>"
                                    + "</tr>";
                            $('#tbodyrecords').html(eachrow);
                            jQuery('.file-data-loader').hide();
                        }else{
                            $('.dataqyality-issue').css('display','none');
                            var i=0;
                            $('.tbodyrecords').html("");
                            $('.tbodyrecords_national').html("");
                            $('#recordscount').html("");
                            $.each(data, function (index, item) {
                                var eachrow = "<tr>"

                                        + "<td class='text-center selecteddata' style='display:none'><input class='wizard_list' name='wizard_list_filter[]' value=" + item['definitionID'] +" type='checkbox' checked='true'></td>"
                                        + "<td class='text-center'>" + item['dataItemName'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValue'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValueType'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValueDescription'] + "</td>"


                                        + "</tr>";
                                var eachrownational = "<tr>"
                                        + "<td class='text-center selecteddata' style='display:none'><input class='dataitem_list' name='dataitem_list_filter[]' value=" + item['definitionID'] +" type='checkbox' checked='true'></td>"
                                        + "<td class='text-center'>" + item['dataItemName'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValue'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValueType'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValueDescription'] + "</td>"


                                        + "</tr>";
                                $('.tbodyrecords').append(eachrow);
                                $('.tbodyrecords_national').append(eachrownational);
                                i++;
                            });
                            $('#recordscount').append("<span>"+i+" Records Selected</span>");

                            jQuery('.file-data-loader').hide();
                            $('.filtertable_csv_modal').DataTable( {
                                "bPaginate": true,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": true,
                                "bAutoWidth": false
                            } );


                        }


                    }


                });



            })



            $(document).on('click', '.complete-wizard-final', function(e){
                e.preventDefault();
                var checked = []
                var dataset = $('select#datasetbelongs option:selected').val();
                var map_dataitem_status = $('select#map_dataitem_status option:selected').val();
                var mappinginfo =  $('.nationalfield:checked').val();
                var mappingdata =  $('.mappingdata:checked').val();
                var mappingcomments =  $('#dataitemmapping_comments').val();
                var sharepointlink =  $('#sharepoinglink').val();

                var token = "{{csrf_token()}}";
                $("input[name='dataitem_list_filter[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });

                $.ajax({
                    url: "{{ url("dashboard/mapping/wizard-data") }}",
                    data: {"dataset": dataset,
                        "data_selected":checked,"_token": token,
                        "mappinginfo":mappinginfo,"mappingdata":mappingdata,
                        "mappingcomments":mappingcomments,
                        "map_dataitem_status":map_dataitem_status,
                        "sharepointlink":sharepointlink,
                    },
                    type: 'POST',
                    success: function (data) {


                    }


                });



            });


            $(document).on('click', '.close', function(e){
                window.location="{{URL::to('dashboard/mapping')}}";


            });

            $(document).on('click', '.complete-mapping', function(e){
                window.location.reload();
            });


            $(document).on('click', '.complete-wizard', function(e){
                window.location="{{URL::to('dashboard/data-definitions')}}";


            });


            $(document).ready(function () {
                //Initialize tooltips
                $('.nav-tabs > li a[title]').tooltip();

                //Wizard
                $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                    var $target = $(e.target);

                    if ($target.parent().hasClass('disabled')) {
                        return false;
                    }
                });

                $(document).on('click', '.next-step-mapping', function(e){
                    var $active = $('.wizard .nav-tabs li.active');
                    $active.next().removeClass('disabled');
                    nextTab($active);

                });

                $(".prev-step").click(function (e) {

                    var $active = $('.wizard .nav-tabs li.active');
                    prevTab($active);

                });
            });

            function nextTab(elem) {
                $(elem).next().find('a[data-toggle="tab"]').click();
            }
            function prevTab(elem) {
                $(elem).prev().find('a[data-toggle="tab"]').click();
            }



        });
    </script>

@endsection