<?php
function datatype($str)
{

    if ($str == "varchar") {
        $str = 'Text';
    } elseif ($str == "int") {
        $str = 'integer';
    } elseif ($str == "bigint") {
        $str = 'integer';
    } elseif ($str == "nvarchar") {
        $str = 'text';
    } elseif ($str == "date") {
        $str = 'date';
    } elseif ($str == "time") {
        $str = 'time';
    } elseif ($str == "datetime") {
        $str = 'datetime';
    }
    return $str;
}

?>
@extends('master')
@section('page-title', 'Reference Library Portal')
@section('header')
    @parent
    <link rel="stylesheet" type="text/css" href="{{url('css/bed-management/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/datawizard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/tipuesearch/tipuesearch.css')}}">



@endsection
@section('title', 'DSfC')

@section('content')
    <style>
      #search_field{
          color: #000000;
      }
    </style>
    {{--*/ $user = Sentinel::getUser(); /*--}}
    <div class="file-data-loader">
        <span class="image-loader screen-center">
            <img src="{{ url('images/loading.gif') }}">
        </span>

    </div>

    <div id="content-wrapper" class="container margin-top-20">


        <div class="tabBlock">
            </br>
            <ul class="tabBlock-tabs datachallenge-info">
                <li class="tabname tabBlock-tab set-tab is-active" id="tnr">TNR Data Definition</li>
                <li class="tabname tabBlock-tab set-tab " id="dataitem">Reference Data</li>
                <li class="tabname tabBlock-tab set-tab" id="mapping">Mapping</li>
                <li class="tabname tabBlock-tab set-tab" id="group">Group</li>
                <li class="tabname tabBlock-tab set-tab" >Search</li>
{{--
                <div >
                    <input type="text" name="q"  id="search_field" placeholder="Search" style="margin-top: 9px;margin-left:18px">
                </div>--}}

            </ul>

            <div class="tabBlock-content" id="contents">
                <div class="aeadata tabBlock-pane">

                    {!! Form::open(array('url' => '/dashboard/data-wizard', 'method'=>'get','id'=>'filterform')) !!}
                    <div class="col-md-12">
                        <div class="pull-left">
                            @if(!empty($database_selected_name))
                            {!! Form::select('database_name', ['' => "Database Name"]  + $aeadatasdatabaelist,$database_selected_name,['class' => 'database_name form-control col-md-4','id' => 'database_name','data-token'=>csrf_token()]
                            ) !!}
                             @else
                                {!! Form::select('database_name', ['' => "Database Name"]  + $aeadatasdatabaelist,null,['class' => 'database_name form-control col-md-4','id' => 'database_name','data-token'=>csrf_token()]
                           ) !!}

                            @endif
                        </div>
                        <div class="pull-left" style="margin-left: 10px;">
                            @if(!empty($table_selected_name))
                            {!! Form::select('table_name', ['' => "Table Name"]  + $aeadatastablelist,$table_selected_name,['class' => 'table_name form-control col-md-4','id' => 'table_name','data-token'=>csrf_token()]
                          ) !!}
                            @else
                                {!! Form::select('table_name', ['' => "Table Name"]  + $aeadatastablelist,null,['class' => 'table_name form-control col-md-4','id' => 'table_name','data-token'=>csrf_token()]
                        ) !!}
                            @endif
                        </div>

                        <div class="pull-right" id="filterdata">

                        </div>
                        {!! Form::close() !!}


                    </div>

                    <section class="ane-items table-responsive col-md-12" style="margin-top:10px;">


                        <div class="panel panel-default">

                            <table class="myTable filtertable_aea table table-striped definitions-table">
                                @if (count($aeadatas) > 0)
                                    <thead class="tableheader">
                                    <tr class="aeadata myHead" style="border: 0px;">


                                        <th class="text-center">Database /<br> Table</th>
                                        <th class="text-center">Column Name/ <br> Description</th>
                                        <th class="text-center">Data Type</th>
                                        {{--<th class="text-center">Required</th>--}}


                                        <th class="text-center">Is Derived? / Methodology</th>
                                        <th class="text-center">Original Source/<br>Created Date</th>

                                        <th class="text-center">Data Dictionary</th>
                                        <th class="text-center">Code /<br> Description</th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>


                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($aeadatas as $aeadata)
                                        <tr class="stileone">

                                            <td class="text-center "><span
                                                        class="boldtext">{{$aeadata->dataBaseName}}</span>
                                                <br>
                                                @if(!empty($aeadata->tableName))
                                                    <span class="extracolumn"></span><br>
                                                    {{$aeadata->tableName}}
                                                @else
                                                    <span class="extracolumn">-</span><br>
                                                @endif

                                            </td>

                                            <td class="text-center ">
                                                <span class="boldtext">{{$aeadata->tnrItemName}}</span>
                                                <br>
                                                @if(!empty($aeadata->tnrDataItemDescription))
                                                    <span class="extracolumn"></span><br>
                                                    {{$aeadata->tnrDataItemDescription}}
                                                @else
                                                    <span class="extracolumn">-</span><br>
                                                @endif

                                            </td>

                                            <td class="text-center">{{$aeadata->dataType}}</td>
                                            {{--<td class="text-center">{{$aeadata->required}}</td>--}}



                                          {{--  <td class="text-center">{{$aeadata->codeTbc}}
                                                <br>{{$aeadata->codeDescriptionTbc}}
                                            </td>--}}


                                            <td class="text-center">{{$aeadata->isDerivedItem}} <br>
                                                @if(!empty($aeadata->derivationMethodology))
                                                    <span class="extracolumn"></span><br>
                                                    {{$aeadata->derivationMethodology}}
                                                @else
                                                    <span class="extracolumn">-</span><br>
                                                @endif
                                            </td>


                                            <td class="text-center">{{$aeadata->authorName}}
                                                <br>{{$aeadata->createdDate}}
                                            </td>


                                            <td class="text-center">

                                                @if(!empty($aeadata->dataDictionaryName))

                                                    {{$aeadata->dataDictionaryName}} <br>
                                                @else
                                                    <span class="extracolumn">-</span><br>
                                                @endif
                                                @if (filter_var($aeadata->dataDictionaryLinks, FILTER_VALIDATE_URL) !== false)

                                                    <a target="_blank" class="extracolumn"
                                                       href="{{$aeadata->dataDictionaryLinks}}">Link</a>
                                                @else


                                                @endif

                                            </td>
                                            @if(!empty($aeadata->codeTbc))
                                                <td class="text-center details-control"
                                                    data-item-name="{{$aeadata->dataItemName}}"
                                                    id="{{$aeadata->tnrId}}"><span
                                                            class="btn btn-primary btn-sm showhidedataitemstnr"
                                                            data-item-name="{{$aeadata->dataItemName}}"
                                                            id="{{$aeadata->tnrId}}">Show</span></td>
                                            @else
                                                <td class="text-center">{{$aeadata->codeTbc}}
                                                    <br>{{$aeadata->codeDescriptionTbc}}
                                                </td>

                                            @endif

                                            <td class="text-center">

                                                @if($aeadata->tnrConnectStatus==1)
                                                    <span class="btn-primary btn tnr-dataconnection-result"
                                                          data-tnrid="{{$aeadata->tnrId}}">Show </span>

                                                @else
                                                    <span class="btn-primary btn tnr-dataconnection"
                                                          data-name="{{$aeadata->tnrItemName}}"
                                                          data-tnrid="{{$aeadata->tnrId}}">Reference Data Item  </span>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                <span><a href="javascript:void(0)">
                                                        <span class="btn-primary btn">Mapping</span></a>
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
                            </table>
                        </div>
                    </section>

                </div>

                <div class="dataitems tabBlock-pane">
                    <section>
                    {!! Form::open(array('url' => '/dashboard/data-wizard', 'method'=>'get','id'=>'dataitemfilterform')) !!}


                        <div class="pull-left">
                            @if(!empty($dataitem_selected_name))
                                {!! Form::select('data_item', ['' => "Data Item"]  + $dataitemlist,$dataitem_selected_name,['class' => 'data_item form-control col-md-4','id' => 'data_item','data-token'=>csrf_token()]
                                ) !!}
                            @else
                                {!! Form::select('data_item', ['' => "Data Item"]  + $dataitemlist,null,['class' => 'data_item form-control col-md-4','id' => 'data_item','data-token'=>csrf_token()]
                           ) !!}

                            @endif
                        </div>
                        {!! Form::close() !!}

                        <div class="text-center">

                            <a href="{{url('media/uploads/Definitions upload 29122016.csv')}}"
                               class="btn btn-primary btn-sm" download target="_blank">Sample Data</a>

                            <button type="button" class="btn btn-primary btn-sm wizardcsvDataModel" data-toggle="modal"
                                    data-target="#wizardcsvDataModel">Import Data
                            </button>
                            <div class="pull-right" id="reference_datas" align="right"></div>


                        </div>
                   


                    </section>

                    <section class=" table-responsive" style="margin-top:10px;">
                        <div class="panel panel-default">

                            <table class="myTable results reference-datatable table table-striped table-bordered definitions-table data-item " id="reference-datatable">

                                @if (count($approved) > 0)
                                    <thead class="tableheader">
                                    <tr class="myHead">

                                        <th class="text-left">Data Item Name</th>
                                        <th class="text-left">Data Item Description</th>
                                        <th class="text-center">Data Set</th>
                                       {{-- <th class="text-center">Version number</th>--}}
                                        <th class="text-center">Data Type</th>
                                        <th class="text-center">SharePoint link</th>
                                        <th class="text-center "> Coded Values</th>


                                        @if($user->inRole('administrator'))
                                            <th class="text-center invisible-data">Coded Value</th>
                                            <th class="text-center invisible-data">Coded Value Description</th>
                                            <th class="text-center invisible-data">Date Item ID</th>
                                            <th class="text-center invisible-data">Data Item Version ID</th>
                                            <th class="text-center invisible-data">Coded Value ID</th>
                                            <th class="text-center invisible-data">Coded Value Version ID</th>
                                            <th class="text-center invisible-data">Author</th>
                                        @endif
                                        <th class="text-center"></th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($approved as $approved_data)

                                        <tr class="stileone alternativecolor">
                                            <td class="text-left ">{{$approved_data->dataItemName}}</td>
                                            <td class="text-left">{{$approved_data->dataItemDescription}}</td>
                                            <td class="text-center">{{$approved_data->datasetBelongs}}</td>
                                           {{-- <td class="text-center">{{$approved_data->codedValueVersionId}}</td>--}}
                                            @if($approved_data->datatypeMapStatus==1)
                                                <td class="text-center">{{datatype(current(explode(' ',$approved_data->dataTypeMapName)))}}</td>
                                            @else
                                                <td class="text-center">{{datatype(current(explode(' ',$approved_data->codedValueType)))}}</td>
                                            @endif

                                            <td class="text-center">
                                                @if (filter_var($approved_data->sharePointLink, FILTER_VALIDATE_URL) !== false)
                                                    <a target="_blank"
                                                       href="{{$approved_data->sharePointLink}}">{{$approved_data->sharePointLink}}</a>
                                                @else
                                                    {{$approved_data->sharePointLink}}
                                                @endif


                                            </td>



                                            @if(!empty($approved_data->codedValueDescription))
                                                <td class="text-center details-control"   data-item-name="{{$approved_data->dataItemName}}" id="{{$approved_data->definitionID}}"><span
                                                            class="btn btn-primary btn-sm showhidedataitems"
                                                            data-item-name="{{$approved_data->dataItemName}}"
                                                            id="{{$approved_data->definitionID}}">Show</span></td>
                                            @else
                                                <td class="text-center"></td>
                                            @endif




                                            @if($user->inRole('administrator'))
                                                <td class="text-center invisible-data">{{$approved_data->codedValue}}</td>
                                                <td class="text-center invisible-data">{{$approved_data->codedValueDescription}}</td>
                                                <td class="text-center invisible-data">{{$approved_data->dataItemId}}</td>
                                                <td class="text-center invisible-data">{{$approved_data->dataItemVersionId}}</td>
                                                <td class="text-center invisible-data">{{$approved_data->codedValueId}}</td>
                                                <td class="text-center invisible-data">{{$approved_data->codedValueVersionId}}</td>
                                                <td class="text-center invisible-data">{{$approved_data->username}}</td>
                                            @endif
                                            <td class="text-center" style="width: 106px;">
                                                @if($approved_data->isMapped==1)
                                                    <span>

                                                    <a href="javascript:void(0)">
                                                        <span class=" btn mapping_details_info"
                                                              style="border:1px solid #2e6da4"
                                                              data-ref-id="{{$approved_data->referenceDetailId}}"
                                                              data-item-name="{{$approved_data->dataItemName}}">Mapped</span>
                                                    </a>

                                                   </span>

                                                @else
                                                    <span>

                                                    <a href="javascript:void(0)"><span
                                                                class="mappingdatabutton  btn-primary btn check-map check_{{$approved_data->definitionID}}"
                                                                data-reference="{{$approved_data->definitionID}}"
                                                                data-itemname="{{$approved_data->dataItemName}}"
                                                                data-token="{{ csrf_token() }}">Map</span></a>

                                                   </span>


                                                @endif
                                            </td>


                                        </tr>
                    {{--                    <tr class="additionaldata">
                                            <td class="invisible-data " colspan="11"
                                                id="coded_values_dataitems_{{$approved_data->definitionID}}"
                                                align="center">
                                                <table class="table table-striped table-bordered definitions-table remove_last_element"
                                                       style="width: 70%;">
                                                    <tr style="background-color: #979797; "
                                                        class="table_header_color_white">
                                                        <th class="text-center ">Coded Value</th>
                                                        <th class="text-left ">Coded Value Description</th>
                                                        <th class="text-center "></th>

                                                    </tr>
                                                    <tbody id="filterdatadataitems{{$approved_data->definitionID}}">

                                                    </tbody>
                                                </table>

                                            </td>

                                        </tr>--}}


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

                <div class="mapping tabBlock-pane">

                    <section>
                        <div class="row" style="margin-left: -15px">
                            {!! Form::open(array('url' => '/dashboard/data-wizard', 'method'=>'get','id'=>'mappingfilterform')) !!}
                            <div class="col-md-12">
                                <div class="pull-left">
                                    @if(!empty($mapped_selected_name))
                                        {!! Form::select('mapping_data_item', ['' => "Data Item"]  + $dataitemlist,$mapped_selected_name,['class' => 'mapping_data_item form-control col-md-4','id' => 'mapping_data_item','data-token'=>csrf_token()]
                                        ) !!}
                                    @else
                                        {!! Form::select('mapping_data_item', ['' => "Data Item"]  + $dataitemlist,null,['class' => 'mapping_data_item form-control col-md-4','id' => 'mapping_data_item','data-token'=>csrf_token()]
                                   ) !!}

                                    @endif
                                </div>


                                    <div id="mapping_datas" align="right"></div>




                                {!! Form::close() !!}


                            </div>
                        </div>

                    </section>






                    <section  style="margin-top:10px;">


                        <div class="panel panel-default">

                            <table class="myTable mapping-datatable table table-striped table-bordered definitions-table mapping-table" id="mapping-datatable">
                                @if (count($mapped_item) > 0)
                                    <thead>
                                    {{--  <tr style="border: 0px;">
                                          <th class="text-center" colspan="3" ><span class="btn" style="background-color: #ed7d31;color: white;">Imported Data Items </span></th>
                                          <th class="text-center" colspan="2" ><span class="btn" style="background-color: #ed7d31;color: white;">National Data Items</span></th>
                                      </tr>--}}
                                    <tr class="myHead">
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        @if($user->inRole('administrator'))
                                            <th class="text-center invisible-data">Coded Value</th>
                                            <th class="text-center invisible-data">Coded Value Description</th>
                                            <th class="text-center invisible-data">Date Item ID</th>
                                            <th class="text-center invisible-data">Data Item Version ID</th>
                                            <th class="text-center invisible-data">Coded Value ID</th>
                                            <th class="text-center invisible-data">Coded Value Version ID</th>
                                            <th class="text-center invisible-data">Author</th>
                                        @endif
                                        <th class="text-center"></th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($mapped_item as $mapped)

                                        <tr class="stileone alternativecolor">

                                            <td class="text-center">{{$mapped->dataItemName}}</td>

                                            @if($mapped->dataItem=="Local")
                                                <td class="text-center"></td>

                                            @else
                                                @if(!empty($mapped->codedValue))
                                                    <td class="text-center"><span
                                                                data-national="{{$mapped->mappingInfo}}"
                                                                data-item="{{$mapped->dataItemName}}"
                                                                class="btn btn-primary btn-sm oneormoremappingfinal showhidedata"
                                                                data-item-name="{{$mapped->dataItemName}}"
                                                                id="{{$mapped->definitionID}}">Show</span></td>
                                                @else
                                                    <td class="text-center"></td>
                                                @endif
                                            @endif


                                            <td class="text-center"><span class="btn  "
                                                                          style="border:1px solid #2e6da4">Mapped To</span>
                                            </td>


                                            @if($user->inRole('administrator'))
                                                <td class="text-center invisible-data">{{$mapped->codedValue}}</td>
                                                <td class="text-center invisible-data">{{$mapped->codedValueDescription}}</td>
                                                <td class="text-center invisible-data">{{$mapped->dataItemId}}</td>
                                                <td class="text-center invisible-data">{{$mapped->dataItemVersionId}}</td>
                                                <td class="text-center invisible-data">{{$mapped->codedValueId}}</td>
                                                <td class="text-center invisible-data">{{$mapped->codedValueVersionId}}</td>
                                                <td class="text-center invisible-data">{{$mapped->username}}</td>
                                            @endif

                                            @if($mapped->dataItem=="Local")
                                                <td class="text-center"><span class="btn  btn-primary">Local</span></td>

                                            @else
                                                <td class="text-center">{{$mapped->mappingInfo}}</td>
                                            @endif


                                        </tr>
                            {{--            <tr class="additionaldata ">

                                            <td class="invisible-data-final " colspan="11"
                                                id="coded_values_mapping_final_{{$mapped->definitionID}}"
                                                align="center">
                                                <table class="table  table-striped table-bordered definitions-table horizontal_scroll">
                                                    --}}{{--<thead>
                                                    <tr style="border: 0px;">
                                                        <th class="text-center" colspan="1" ><span class="btn" style="background-color: #ed7d31;color: white;">Imported Coded Values</span></th>

                                                        <th class="text-center" colspan="1" ><span class="btn" style="background-color: #ed7d31;color: white;">National Coded Values</span></th>
                                                    </tr>
                                                    </thead>--}}{{--

                                                    <tbody id="importedcodedvaluesfinal"
                                                           class="tbodyrecords_national importedcodedvaluesfinal_{{$mapped->definitionID}}">

                                                    </tbody>


                                                </table>

                                            </td>

                                        </tr>--}}


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

                <div class="group tabBlock-pane">

                    <section>

                        {!! Form::open(array('url' => '/dashboard/data-wizard', 'method'=>'get','id'=>'groupfilterform')) !!}

                            <div class="pull-left">
                                @if(!empty($grouped_selected_name))
                                    {!! Form::select('grouped_data_item', ['' => "Group Name"]  + $groupitemlist,$grouped_selected_name,['class' => 'grouped_data_item form-control col-md-4','id' => 'mapping_data_item','data-token'=>csrf_token()]
                                    ) !!}
                                @else
                                    {!! Form::select('grouped_data_item', ['' => "Group Name"]  + $groupitemlist,null,['class' => 'grouped_data_item form-control col-md-4','id' => 'mapping_data_item','data-token'=>csrf_token()]
                               ) !!}

                                @endif
                            </div>


                            {!! Form::close() !!}


                        <div class="text-center">
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm datatypegroupselecter"> Data Type
                                Group</a>

                            <a href="javascript:void(0)" class="btn btn-primary btn-sm codedvaluegroupselecter"> Coded Value
                                Group</a>
                            <div class="pull-right" id="grouping_datas" align="right"></div>
                        </div>


                    </section>




                    <section class=" table-responsive" style="margin-top:10px;">


                        <div class="panel panel-default">

                            @if (count($dataset_group) > 0)

                            <table class="myTable grouping-datatable table table-striped table-bordered definitions-table data-item ">

                                <thead class="tableheader tableFloatingHeaderOriginal active">

                                <tr class="myHead">

                                    <th class="text-center ">Group Name</th>
                                    <th class="text-center ">Group Type</th>
                                    <th class="text-center ">Group ID</th>

                                    <th class="text-center ">Group Values</th>


                                </tr>
                                </thead>
                                <tbody>

                                    @foreach ($dataset_group as $data)

                                        <tr class=' stileone'>


                                            <td class='text-center'>{{$data->groupName}}</td>
                                            @if($data->groupType=="coded")
                                                <td class='text-center'>Coded Value</td>
                                            @else
                                                <td class='text-center'>Data Item</td>
                                            @endif
                                            <td class='text-center'>0000{{$data->groupId}}</td>


                                            <td class="text-center ">
                                                @if($data->groupStatus==1)
                                                    <a class="btn btn-small btn-primary btn-sm groupingfilter showhidegroupdata"
                                                       data-status="approved" data-type="{{$data->groupType}}" data-patientid="{{$data->groupName}}"
                                                       id="{{$data->groupId}}" href="javascript:void(0)">Show</a>
                                                @else
                                                    <a class="btn btn-small btn-primary btn-sm groupdatabutton"
                                                       data-status="approved" href="javascript:void(0)">Create Group</a>
                                                @endif

                                            </td>

                                        </tr>



                                  {{--      <tr class="additionaldata">

                                            <td class="invisible-data-final " colspan="11"
                                                id="group_data_hidden_{{$data->groupId}}" align="center">
                                                <table class="table  table-striped table-bordered  horizontal_scroll "
                                                       style="width: 79%;">
                                                    <thead>
                                                    <tr>


                                                        <th class="text-center">Data Item</th>
                                                        <th class="text-center">Coded Value</th>
                                                        <th class="text-center">Coded Value Description</th>

                                                    </tr>
                                                    </thead>

                                                    <tbody id="filterdatagroupingdata{{$data->groupId}}">

                                                    </tbody>

                                                </table>

                                            </td>

                                        </tr>--}}

                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <h4 class="text-center">No Grouping records found!</h4>
                                        </td>
                                    </tr>

                                @endif


                            </table>
                        </div>
                    </section>


                </div>

                <div class="tabBlock-pane">

                    <form action="">
                        <label>Search:  <input class="" placeholder="" aria-controls="DataTables_Table_1" type="search"></label>
                        <input class="btn btn-primary btn-sm" value="Go" type="button" id="tipue_search_button" >
                    </form>

                </div>



            </div>

        </div>


    </div>



    <!-- Modal -->

    <div class="modal fade" id="codedvaluegroup" tabindex="-1" role="dialog" aria-labelledby="wizardcsvDataModelLabel">
        <div class="modal-dialog" role="document"
             style="overflow-y: scroll; max-height:85%; margin-top: 50px; margin-bottom:50px;">
            <div class="modal-content">

                {!! Form::open(array('url' => 'dashboard/data-wizard/store-info','files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data','id'=>'wizard_form_file')) !!}


                <div class="modal-header">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="wizardcsvDataModelLabel">Coded Value Group </h4>
                </div>
                <div class="modal-body">
                    <section>
                        <div class="wizard">


                            <div class="tab-content">

                                <div class="tab-pane active" role="tabpanel" id="step1">

                                    <div class="col-md-5">

                                    {!! Form::label('groupnamecoded', 'Group Name', array('class' => 'pull-left')) !!}
                                    <div class="form-group pull-left col-md-6">


                                        {!! Form::text('groupnamecoded', '', array('class' => 'form-control col-md-3' , 'autocomplete' => 'off')) !!}
                                    </div>
                                    </div>

                                    <div class="col-md-3" style="margin-left:-74px;">
                                    {!! Form::select('groupitemlist_coded', ['' => "Group Name"]  + $groupitemlist_coded,null,['class' => 'groupitemlist_coded form-control col-md-4','id' => 'groupitemlist_coded','data-token'=>csrf_token()]) !!}
                                    </div>

                                    <div class="col-md-12">

                                        <div class="col-md-6">
                                            <h5 class="text-danger" id="recordscount"></h5>
                                        </div>

                                        <div class="datagrid" id="recordslist">
                                            <table class=" table groupingtable  table-striped table-bordered  horizontal_scroll">
                                                <thead>
                                                <tr>

                                                    <th class="text-center">Select</th>

                                                    <th class="text-center">Data Item </th>
                                                    <th class="text-center">Coded Value</th>

                                                    <th class="text-center">Coded Value Description</th>


                                                </tr>
                                                </thead>
                                                <tbody id="tbodyrecords">

                                                </tbody>


                                            </table>


                                        </div>


                                    </div>


                                    <ul class="list-inline pull-right groupstart">


                                        <li>
                                            <button type="button"
                                                    class="groupcomplete btn btn-primary btn-info-full finishcodedvaluegroup"
                                                    data-dismiss="modal ">Finish
                                            </button>
                                        </li>

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

    <div class="modal fade" id="datatypegroup" tabindex="-1" role="dialog" aria-labelledby="wizardcsvDataModelLabel">
        <div class="modal-dialog" role="document"
             style="overflow-y: scroll; max-height:85%; margin-top: 50px; margin-bottom:50px;">
            <div class="modal-content">

                {!! Form::open(array('url' => 'dashboard/data-wizard/store-info','files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data','id'=>'wizard_form_file')) !!}


                <div class="modal-header">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="wizardcsvDataModelLabel">Data Type Group </h4>
                </div>
                <div class="modal-body">
                    <section>
                        <div class="wizard">


                            <div class="tab-content">

                                <div class="tab-pane active" role="tabpanel" id="step1">


                                    <div class="form-group col-md-6">

                                        {!! Form::label('groupnamegroup', 'Group Name ') !!}
                                        {!! Form::text('groupnamegroup', '', array('class' => 'form-control' , 'autocomplete' => 'off')) !!}
                                    </div>

                                    <div class="form-group col-md-3  pull-right">
                                        <div id="datatypegroupsearch"></div>
                                    </div>

                                    <div class="col-md-12">

                                        <div class="col-md-6">
                                            <h5 class="text-danger" id="recordscount"></h5>
                                        </div>

                                        <div class="datagrid datatypegrouphidesearch" id="recordslist">
                                            <table class=" table groupingtable  table-striped table-bordered  horizontal_scroll">
                                                <thead>
                                                <tr>

                                                    <th class="text-center">Select</th>
                                                    <th class="text-center secondth">Data Item Name</th>


                                                </tr>
                                                </thead>
                                                <tbody id="tbodyrecordsdatatypegroup">

                                                </tbody>


                                            </table>


                                        </div>


                                    </div>


                                    <ul class="list-inline pull-right groupstart">


                                        <li>
                                            <button type="button"
                                                    class="groupcomplete btn btn-primary btn-info-full finishdatatypegroup"
                                                    data-dismiss="modal ">Finish
                                            </button>
                                        </li>

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


    <!-- Modal -->



    <div class="modal fade" id="commentsModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Mapping comments</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-6  ">
                        <input type="text" value="" id="mapping_comments" class="form-control  "
                               placeholder="Your Comments" name="mapping_comments">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary commentsubmit" data-dismiss="modal">Submit</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="mappingdataModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Mapping comments</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="six columns">
                            <article>
                                <label for="search">National data</label>
                                <input id="search" name="search" placeholder="Start Typing Here" type="text"
                                       data-list=".default_list" autocomplete="off">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary nationaldatasubmit" data-dismiss="modal">Submit
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div id="myModalfileinfo" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">File Details</h4>
                </div>
                <div class="modal-body">
                    <div id="file_status_filter">

                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="modal fade" id="mappingDataModel" tabindex="-1" role="dialog" aria-labelledby="wizardcsvDataModelLabel">
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="mappingdataitem"></h4>
                </div>
                <div class="modal-body">
                    <section>
                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>
                                <ul class="nav nav-tabs" role="tablist">

                                    <li role="presentation" class="active">
                                        <a href="#step1" data-toggle="tab" aria-controls="step2" role="tab"
                                           title="Step 1">
                                        <span class="round-tab">
                                           Step 1
                                        </span>
                                        </a>
                                    </li>


                                    <li role="presentation" class="disabled">
                                        <a href="#step2" data-toggle="tab" aria-controls="step3" role="tab"
                                           title="Step 3">
                                        <span class="round-tab">
                                            Step 2
                                        </span>
                                        </a>
                                    </li>


                                </ul>
                            </div>


                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">

                                    <div class="col-md-12">
                                        <article>
                                            <label for="search">Is this a National or Local Data Item?</label>
                                        </article>
                                        <ul class="donate-now">
                                            <li><label for="Local">
                                                    <input value="Local" type="radio" id="a25" name="data_item"
                                                           class="nationalfield">Local</label>
                                            </li>
                                            <li><label for="National">
                                                    <input value="National" type="radio" id="a50" name="data_item"
                                                           class="nationalfield">National</label>
                                            </li>
                                        </ul>


                                        <div style="width: 100%;float: left">
                                            <article>
                                                <label for="search">Please select the data set this Data Item belongs to
                                                    from drop down below</label>
                                            </article>
                                            <div>
                                                <div class="map_only" style="width: 100%">
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

                                        <div style="width: 100%;float: left">
                                            <article>
                                                <label for="search">Please provide commentary regarding this Data
                                                    Item</label>
                                            </article>
                                            <div class="mapping_comments">
                                                <textarea cols="40" rows="2" value="" id="dataitemmapping_comments"
                                                          class="form-control  dataitemmapping_comments"
                                                          placeholder="Add Comments Here"
                                                          name="dataitemmapping_comments"></textarea>
                                            </div>


                                        </div>

                                        <div style="width: 100%;float: left;margin-top: 10px;">
                                            <article>
                                                <label for="search">Please provide a SharePoint link specific to this
                                                    Data Item</label>
                                            </article>
                                            <div class="sharepointlinks">
                                                <textarea cols="40" rows="2" name="sharepoinglink" id="sharepoinglink"
                                                          class="form-control" value=""
                                                          placeholder="Insert Share Point Link Here"></textarea>

                                            </div>

                                        </div>


                                        {{--<div class="datagrid" id="recordslist">
                                            <table class="table  table-striped table-bordered definitions-table horizontal_scroll">
                                                <thead>
                                                <tr>

                                                    <th class="text-center">Data Item Name</th>
                                                    <th class="text-center">Coded Value </th>
                                                    <th class="text-center">Coded Value Type </th>
                                                    <th class="text-center">Coded Value Description </th>


                                                </tr>
                                                </thead>
                                                <tbody  class="tbodyrecords_national">

                                                </tbody>


                                            </table>

                                        </div>--}}

                                    </div>

                                    <div class="datagrid" id="recordslist" style="display: none">
                                        <table class="table  table-striped table-bordered definitions-table horizontal_scroll">
                                            <thead>
                                            <tr>

                                                <th class="text-center">Data Item Name</th>
                                                <th class="text-center">Coded Value</th>
                                                <th class="text-center">Coded Value Type</th>
                                                <th class="text-center">Coded Value Description</th>


                                            </tr>
                                            </thead>
                                            <tbody id="nationalfiltertable" class="nationalfiltertable">

                                            </tbody>


                                        </table>


                                    </div>
                                    <div class="col-md-12">
                                        <ul class="list-inline pull-right localnational">


                                            <li>
                                                <button type="button"
                                                        class="mapping-finish hidedatabutton commentsdata  btn btn-primary btn-info-full complete-wizard-final localmapping">
                                                    Finish
                                                </button>
                                            </li>

                                            <li>
                                                <button type="button"
                                                        class="mapping-map hidedatabutton  commentsnationaldata  btn btn-primary btn-info-full next-step-mapping ">
                                                    Map
                                                </button>
                                            </li>


                                        </ul>
                                    </div>


                                </div>

                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div>

                                        <div id="commentry">
                                            <div class="col-md-6 mapping_comments localinactive">
                                                <input type="text" value="" id="dataitemmapping_comments"
                                                       class="form-control  dataitemmapping_comments"
                                                       placeholder="Your Comments" name="dataitemmapping_comments">
                                            </div>

                                            <div class=" nationalmapping_comments nationalinactive"
                                                 style="margin-top: 5px;">
                                                <div class="modal-content  mymapping-content " style="width: 100%">

                                                    <div class="modal-body rtt-popup">


                                                        <div class="row">


                                                            <div class="six columns">
                                                                <article>
                                                                    <label class="national-label" for="search"><span>National Data Items</span>
                                                                        <form id="live-search" action="" class="styled"
                                                                              method="post">
                                                                            <fieldset>
                                                                                <input type="text" class="text-input"
                                                                                       id="filter" value=""
                                                                                       placeholder="Start Typing Here"/>
                                                                                <span id="filter-count"></span>
                                                                            </fieldset>
                                                                        </form>
                                                                    </label>

                                                                    <nav>
                                                                        <ul class="vertical default_list">
                                                                            @foreach($dditems as $itemData)
                                                                                <li class="col-md-12">
                                                                                    {!! Form::radio('mychoice', $itemData->itemName, '', array('class' => 'selection radio-custom mappingdata','id'=>$itemData->id)) !!} {{ $itemData->itemName }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </nav>


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
                                        <li>
                                            <button type="button" class="btn btn-default prev-step">Previous</button>
                                        </li>

                                        <li>
                                            <button type="button"
                                                    class="btn btn-primary btn-info-full next-step-mapping complete-wizard-final">
                                                Finish
                                            </button>
                                        </li>

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

    <div class="modal fade" id="groupingDataModel" tabindex="-1" role="dialog"
         aria-labelledby="wizardcsvDataModelLabel">
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="wizardcsvDataModelLabel">Create Group </h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">


                        <div>
                            <article>
                                <label for="search">Group Name</label>
                            </article>

                            <div class="">
                                <input type="text" value="" id="groupname" class="form-control  groupname"
                                       placeholder="Group Name" name="Group Name">
                            </div>


                        </div>


                    </div>
                    <br>
                    <br>
                    <div class="modal-footer" style="border-top: medium none !important;margin-top: 52px;">
                        <button type="button"
                                class="  btn btn-primary btn-info-full complete-wizard-group-grouping localgrouping">
                            Finish
                        </button>
                    </div>


                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

    <div class="modal fade" id="oneoremoremappingDataModel" tabindex="-1" role="dialog"
         aria-labelledby="wizardcsvDataModelLabel">
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="mappingdataitemname"></h4>
                </div>
                <div class="modal-body">
                    <section>
                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>

                            </div>


                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">

                                    <div class="col-md-12">
                                        <div class="col-md-12">


                                            <table class="table  table-striped table-bordered definitions-table-modal horizontal_scroll">
                                                <thead>
                                                <tr style="border: 0px;">
                                                    <th class="text-center" colspan="1"><span class="btn"
                                                                                              style="background-color: #ed7d31;color: white;">Imported Coded Values</span>
                                                    </th>

                                                    <th class="text-center" colspan="1"><span class="btn"
                                                                                              style="background-color: #ed7d31;color: white;">National Coded Values</span>
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody id="importedcodedvalues" class="tbodyrecords_national">

                                                </tbody>


                                            </table>


                                        </div>
                                        {{--           <div class="col-md-6">
                                                       <article>
                                                           <label for="search">NATIONAL CODED VALUES</label>
                                                       </article>
                                                       <table class="table  table-striped table-bordered definitions-table horizontal_scroll">
                                                           <thead>
                                                           <tr>
                                                               <th class="text-center">Coded Value  </th>
                                                               <th class="text-center">Coded Value Description </th>

                                                           </tr>
                                                           </thead>
                                                           <tbody id="nationalcodedvalues" class="tbodyrecords_national">

                                                           </tbody>


                                                       </table>

                                                   </div>--}}





                                        {{--<div class="datagrid" id="recordslist">
                                            <table class="table  table-striped table-bordered definitions-table horizontal_scroll">
                                                <thead>
                                                <tr>

                                                    <th class="text-center">Data Item Name</th>
                                                    <th class="text-center">Coded Value </th>
                                                    <th class="text-center">Coded Value Type </th>
                                                    <th class="text-center">Coded Value Description </th>


                                                </tr>
                                                </thead>
                                                <tbody  class="tbodyrecords_national">

                                                </tbody>


                                            </table>

                                        </div>--}}
                                    </div>

                                    <ul class="list-inline pull-right localnational">


                                        <li>
                                            <button type="button"
                                                    class="btn btn-primary btn-info-full complete-wizard-local-national">
                                                Finish
                                            </button>
                                        </li>


                                    </ul>

                                </div>

                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <div class="col-md-12">
                                        <div id="commentry">
                                            <div class="col-md-6 mapping_comments localinactive">
                                                <input type="text" value="" id="dataitemmapping_comments"
                                                       class="form-control  dataitemmapping_comments"
                                                       placeholder="Your Comments" name="dataitemmapping_comments">
                                            </div>

                                            <div class="col-md-12 nationalmapping_comments nationalinactive"
                                                 style="margin-top: 5px;">
                                                <div class="modal-content  mymapping-content " style="width: 100%">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        <div class="col-md-2">

                                                        </div>
                                                        <div class="col-md-10">

                                                        </div>
                                                    </div>
                                                    <div class="modal-body rtt-popup">

                                                        <div class="row">

                                                            <div class="six columns">
                                                                <article>
                                                                    <label for="search">National Data</label>
                                                                    <input id="search" name="search"
                                                                           placeholder="Start Typing Here" type="text"
                                                                           data-list=".default_list" autocomplete="off">
                                                                    <ul class="vertical default_list">
                                                                        @foreach($dditems as $itemData)
                                                                            <li class="col-md-12">
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
                                        <li>
                                            <button type="button" class="btn btn-default prev-step">Previous</button>
                                        </li>

                                        <li>
                                            <button type="button"
                                                    class="btn btn-primary btn-info-full next-step-mapping complete-wizard-final">
                                                Next
                                            </button>
                                        </li>

                                    </ul>

                                </div>


                                <div class="tab-pane" role="tabpanel" id="complete">
                                    <h3>Complete</h3>
                                    <p>You have successfully completed all steps.</p>
                                    <ul class="list-inline pull-right">
                                        <li>
                                            <button type="button" class="btn btn-default prev-step">Previous</button>
                                        </li>

                                        <li>
                                            <button type="button"
                                                    class="btn btn-success  btn-info-full next-step-mapping complete-mapping">
                                                Finish
                                            </button>
                                        </li>
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

    <div id="myModalmappingdetails" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Mapped Information</h4>
                </div>
                <div class="modal-body">
                    <table class="table  table-striped table-bordered definitions-table horizontal_scroll">
                        <thead>
                        <tr style="border: 0px;">
                            <th>Dataset Belongs</th>
                            <th>National / Local</th>
                            <th>National Info</th>
                            <th>SharePoint <br> link </th>
                            <th>Mapping Comments</th>
                        </tr>
                        </thead>

                        <tbody id="mappinginforamtion" class="tbodyrecords_national">

                        </tbody>


                    </table>

                </div>

            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade groupingdetails" id="myModalgrouping" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Grouped Data</h4>
                </div>
                <div class="modal-body">
                    <table class=" table  table-striped table-bordered definitions-table horizontal_scroll">
                        <thead>
                        <tr>


                            <th class="text-center">Data Item</th>
                            <th class="text-center">Coded Value</th>
                            <th class="text-center">Coded Value Description</th>
                            <th class="text-center ">Data Type</th>
                            <th class="text-center">Group Name</th>
                            <th class="text-center invisible-data">Created Date</th>
                        </tr>
                        </thead>
                        <tbody id="filterdatagroupingl">
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>



    <!-- tNR DATA CONNECTION Modal -->
    <div id="tnrdataconnection" class="modal fade" role="dialog">
        <div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Connect TND Data Definition :<span id="dataitemtitle"></span></h4>
                </div>
                <div class="modal-body">
                    <div id="hidfielddiv"></div>
                    <div class="">

                        <table class="table table-striped table-bordered  " id="connecttntdatatablepopup">
                            @if (count($approved) > 0)
                                <thead class="tableheader">
                                <tr>

                                    <th class="text-center ">Data Item ID</th>
                                    <th class="text-center ">Data Item</th>


                                    <th class="text-center"> Connect</th>
                                </tr>
                                </thead>
                                <tbody id="tnrconnecteddataset">
                                {{--*/ $k = 0 /*--}}
                                {{--*/ $l = 1 /*--}}
                                {{--*/ $temp = array(); /*--}}
                                @foreach ($approved as $approved_data)
                                    <tr class="stileone alternativecolor">
                                        @if (!in_array($approved_data->dataItemName, $temp))
                                            {{--*/  $k++; /*--}}
                                            {{--*/ $l = 1 /*--}}
                                        @endif

                                        <td class='text-center'>0000{{$k}}</td>
                                        <td class='text-center'>{{$approved_data->dataItemName}}</td>


                                        <td class="text-center">

                                            <span class="btn-primary btn connect-this-tnr "
                                                  data-id="{{$approved_data->definitionID}}">Connect </span>
                                        </td>
                                    </tr>
                                    {{--*/  $l++; /*--}}


                                @endforeach
                                </tbody>
                            @else
                                <tr>
                                    <td>
                                        <h4 class="text-center">No records found!</h4>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary connect-this-tnr-finish" data-dismiss="modal">Finish
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- tNR DATA CONNECTION Modal -->
    <div id="tnrdataconnectionresult" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Connect TNR Data Item </h4>
                </div>
                <div class="modal-body">
                    <div id="hidfielddiv"></div>
                    <div class="">

                        <table class="table table-striped table-bordered definitions-table data-item">
                            @if (count($approved) > 0)
                                <thead class="tableheader">
                                <tr>

                                    <th class="text-left">Data Item Name</th>
                                    <th class="text-center ">Coded Value</th>
                                    <th class="text-center ">Coded Value Description</th>
                                    <th class="text-center ">Version</th>

                                    <th class="text-center">Data Type</th>

                                </tr>
                                </thead>
                                <tbody id="tnrfilterresult">

                                </tbody>
                            @else
                                <tr>
                                    <td>
                                        <h4 class="text-center">No records found!</h4>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
<div class="modal fade wizardcsvDataModelpopup" id="wizardcsvDataModel" tabindex="-1" role="dialog"
     aria-labelledby="wizardcsvDataModelLabel" style="overflow-y: scroll;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            {!! Form::open(array('url' => 'dashboard/data-wizard/store-info','files' => true, 'method'=>'post', 'enctype' => 'multipart/form-data','id'=>'wizard_form_file')) !!}


            <div class="modal-header">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <button type="button" class="close  clear-refresh-data" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="wizardcsvDataModelLabel">Import Data </h4>
            </div>
            <div class="modal-body">
                <section>
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#start" data-toggle="tab" aria-controls="step1" role="tab" title="Start">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon glyphicon-file"></i>
                            </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step0" data-toggle="tab" aria-controls="step0" role="tab" title="Step 0">
                            <span class="round-tab">
                                <i class="glyphicon  glyphicon-info-sign"></i>
                            </span>
                                    </a>
                                </li>


                            </ul>
                        </div>


                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="start">

                                <h3>File Details</h3>
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('filename', 'File Title') !!}
                                            {!! Form::text('file_title', '', array('class' => 'form-control' , 'autocomplete' => 'off','required' => 'required','id'=>'file_title')) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('filedescription', 'File Description') !!}
                                            {!! Form::text('filedescription', '', array('class' => 'form-control' , 'autocomplete' => 'off','required' => 'required','id'=>'filedescription')) !!}
                                        </div>
                                        <div class="validation error" id="subject_errors">&nbsp;</div>
                                        {!! Form::label('chooose file', 'Choose File') !!}
                                        <input type="file" name="excel-data" id="txtFileUpload">
                                    </div>
                                </div>


                                <ul class="list-inline pull-right">
                                    <li>
                                        <button type="button" class="btn btn-default prev-step">Previous</button>
                                    </li>

                                    <li>
                                        <button type="button" class="btn btn-primary btn-info-full  filevalidation ">
                                            Next
                                        </button>
                                    </li>
                                </ul>

                            </div>

                            <div class="tab-pane " role="tabpanel" id="step0">


                                <div class="col-md-12">

                                    <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">

                                        <strong id="recordscount"> </strong>
                                    </div>

                                    <div id="versionmessage">

                                    </div>


                                    {{--   <div class="modifyupload col-md-12">
                                           <h6 class=""><strong>Add extra columns to this</strong></h6>
                                           <div class="form-group col-md-6">
                                               <div class="form-group">
                                                   <div id="ticketsDemosss" class="tickets">
                                                       <div class="col-md-12">
                                                           <input type="text" name="extracolumndata[]" id="extracolumndata" >
                                                       </div>

                                                   </div>

                                               </div>
                                               <div class="form-group col-md-6">
                                                   <span class="glyphicon glyphicon-plus addingextradata" style="cursor: pointer;"></span>
                                               </div>
                                            </div>


                                       </div>--}}


                                </div>


                                <ul class="list-inline pull-right">
                                    <li>
                                        <button type="button" class="btn btn-default prev-step">Previous</button>
                                    </li>


                                    <li><a href="#start" data-toggle="tab" aria-controls="step2" role="tab"
                                           title="Step 1">
                                            <button type="button" class="btn btn-danger prev-step clear-importdata">
                                                Cancel
                                            </button>
                                        </a></li>
                                    <li>
                                        <button type="button"
                                                class="btn btn-primary btn-info-full next-step-mapping dataset csvfinishbutton"
                                                data-dismiss="modal">Finish
                                        </button>
                                    </li>
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


@section('footer')
    @parent
    <script src="{{ url('js/dashboards/SimpleTabs.js') }}"></script>
    <script src="{{ url('js/users/index.js') }}"></script>
    <script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('js/filter/jquery.filtertable.min.js') }}"></script>
    <script src="{{ url('js/filter/jquery.hideseek.min.js') }}"></script>
    <script src="{{ url('js/filter/initializers.js') }}"></script>
    <script src="{{ url('js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('js/jquery.stickytableheaders.min.js') }}"></script>
    <script src="{{ url('js/tipuesearch/tipuesearch.js') }}"></script>


    <script>

        $(document).ready(function () {


            $('#search_field').on('keyup', function() {
                var value = $(this).val();
                var patt = new RegExp(value, "i");

                $('.myTable').find('tr').each(function() {
                    if (!($(this).find('td').text().search(patt) >= 0)) {
                        $(this).not('.myHead').hide();
                    }
                    if (($(this).find('td').text().search(patt) >= 0)) {
                        $(this).show();
                    }
                });

            });






            $(document).on('click', '.datatypegroupselecter', function (e) {
                var checked = []
                $("input[name='wizard_list[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });
                var token = "{{csrf_token()}}";
                if (checked == "") {
                    checked = $(this).attr('data-reference');
                    var datacount = "single";
                } else {
                    var datacount = "multiple";
                }

                $('#datatypegroup').modal('show');
                $('.groupingtable').DataTable().destroy();
                $.ajax({
                    url: "{{ url("dashboard/grouping/selected-data") }}",
                    data: {"data_selected": checked, "_token": token, "datacount": datacount},
                    type: 'POST',
                    success: function (data) {
                        if (data == "Please Select Data") {
                            var eachrow = "<tr class='dataqyality-issue'>"
                                    + "<td class='text-center ' colspan='5'><h1 class='text-danger'>Please Select Data</h1></td>"
                                    + "</tr>";
                            $('#tbodyrecordsdatatypegroup').html(eachrow);
                            jQuery('.file-data-loader').hide();
                        } else {
                            $('.dataqyality-issue').css('display', 'none');
                            var i = 0;
                            $('#tbodyrecordsdatatypegroup').html("");
                            $('#recordscount').html("");
                            $.each(data, function (index, item) {
                                var eachrow = "<tr>"
                                        + "<td class='text-center'><input class='wizard_list' name='wizard_list_filter[]' value=" + item['definitionID'] + " type='checkbox'></td>"
                                        + "<td class='text-center'>" + item['dataItemName'] + "</td>"


                                        + "</tr>";
                                $('#tbodyrecordsdatatypegroup').append(eachrow);
                                i++;
                            });

                            jQuery('.file-data-loader').hide();
                                $('.groupingtable').DataTable({
                                "bPaginate": true,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": true,
                                "bAutoWidth": false
                            });
                


                        }


                    }


                });


            })


            $(document).on('click', '.codedvaluegroupselecter', function (e) {
                var checked = []
                $("input[name='wizard_list[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });
                var token = "{{csrf_token()}}";
                if (checked == "") {
                    checked = $(this).attr('data-reference');
                    var datacount = "single";
                } else {
                    var datacount = "multiple";
                }

                $('#codedvaluegroup').modal('show');
                $('.groupingtable').DataTable().destroy();
                $.ajax({
                    url: "{{ url("dashboard/grouping/selected-data-coded ") }}",
                    data: {"data_selected": checked, "_token": token, "datacount": datacount},
                    type: 'POST',
                    success: function (data) {
                        if (data == "Please Select Data") {
                            var eachrow = "<tr class='dataqyality-issue'>"
                                    + "<td class='text-center ' colspan='5'><h1 class='text-danger'>Please Select Data</h1></td>"
                                    + "</tr>";
                            $('#tbodyrecords').html(eachrow);
                            jQuery('.file-data-loader').hide();
                        } else {
                            $('.dataqyality-issue').css('display', 'none');
                            var i = 0;
                            $('#tbodyrecords').html("");
                            $('#recordscount').html("");
                            $.each(data, function (index, item) {
                                var eachrow = "<tr>"
                                        + "<td class='text-center'><input class='wizard_list_filter_coded' name='wizard_list_filter_coded[]' value=" + item['definitionID'] + " type='checkbox'></td>"

                                        + "<td class='text-center'>" + item['dataItemName'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValue'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValueDescription'] + "</td>"


                                        + "</tr>";
                                $('#tbodyrecords').append(eachrow);
                                i++;
                            });

                            jQuery('.file-data-loader').hide();
                            $('.groupingtable').DataTable({
                                "bPaginate": true,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": true,
                                "bAutoWidth": false
                            });


                        }


                    }


                });


            })


            $(document).on('change', '#groupitemlist_coded', function (e) {
                var mapping_status = $(this).val();
                var checked = []
                $("input[name='wizard_list[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });
                var token = "{{csrf_token()}}";
                if (checked == "") {
                    checked = $(this).attr('data-reference');
                    var datacount = "single";
                } else {
                    var datacount = "multiple";
                }

                $('#codedvaluegroup').modal('show');
                $('.groupingtable').DataTable().destroy();
                $.ajax({
                    url: "{{ url("dashboard/grouping/selected-data-coded-filter ") }}",
                    data: {"data_selected": checked, "_token": token, "datacount": datacount,"mapping_status":mapping_status},
                    type: 'POST',
                    success: function (data) {
                        if (data == "Please Select Data") {
                            var eachrow = "<tr class='dataqyality-issue'>"
                                    + "<td class='text-center ' colspan='5'><h1 class='text-danger'>Please Select Data</h1></td>"
                                    + "</tr>";
                            $('#tbodyrecords').html(eachrow);
                            jQuery('.file-data-loader').hide();
                        } else {
                            $('.dataqyality-issue').css('display', 'none');
                            var i = 0;
                            $('#tbodyrecords').html("");
                            $('#recordscount').html("");
                            $.each(data, function (index, item) {
                                var eachrow = "<tr>"
                                        + "<td class='text-center'><input class='wizard_list_filter_coded' name='wizard_list_filter_coded[]' value=" + item['definitionID'] + " type='checkbox'></td>"

                                        + "<td class='text-center'>" + item['dataItemName'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValue'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValueDescription'] + "</td>"


                                        + "</tr>";
                                $('#tbodyrecords').append(eachrow);
                                i++;
                            });

                            jQuery('.file-data-loader').hide();
                            $('.groupingtable').DataTable({
                                "bPaginate": true,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": true,
                                "bAutoWidth": false
                            });


                        }


                    }


                });


            })


            $(document).on('click', '.group_list_filterdata', function (e) {

                if ($(this).is(':checked')) {
                    var value = $(this).val();

                    $(this).closest(".datatypegrouptr").css('background-color', '#A9A9A9');

                }
            });

            $(".group_list_filterdata").removeAttr("checked");




            $('.tnr-dataconnection').click(function () {
                var id = $(this).attr('data-tnrid');
                var dataitemanme = $(this).attr('data-name');
                $('#hidfielddiv').html("");

                $('<input>').attr({
                    type: 'hidden',
                    id: 'tnrdatait',
                    name: 'superwitness',
                    value: id
                }).appendTo("#hidfielddiv");
                $('#dataitemtitle').html(dataitemanme);
                $('#tnrdataconnection').modal('show');

            });


            $(document).on('click', '.connect-this-tnr', function (e) {
                var data_item_id = $(this).attr('data-id');
                var tnr_id = $('#tnrdatait').val();
                var token = "{{csrf_token()}}";

                $.ajax({
                    url: "{{ url("dashboard/data-wizard/tnr-connect") }}",
                    data: {"_token": token, "data_item_id": data_item_id, "tnr_id": tnr_id},
                    type: 'POST',
                    success: function (data) {

                        $("#tnrconnecteddataset").html(data);


                    }

                });


            });
            $('.connect-this-tnr-finish').click(function () {
                window.location.reload();

            });


            $('.tnr-dataconnection-result').click(function () {

                var data_item_id = $(this).attr('data-tnrid');


                $.ajax({
                    url: "{{ url("dashboard/data-wizard/tnr-connect-data") }}",
                    data: {"data_item_id": data_item_id},
                    type: 'GET',
                    success: function (data) {
                        $('#tnrfilterresult').html(data);
                        $('#tnrdataconnectionresult').modal('show');

                    }

                });


            });

            $(".table_name").change(function () {
                $("form#filterform").submit();
            });
            $(".database_name").change(function () {
                $("form#filterform").submit();
            });

            $(".data_item").change(function () {
                $("form#dataitemfilterform").submit();
            });
            $(".mapping_data_item").change(function () {
                $("form#mappingfilterform").submit();
            });
            $(".grouped_data_item").change(function () {
                $("form#groupfilterform").submit();
            });

            $('.addingextradata').click(function () {
                $('#ticketsDemosss').append($('<div style="margin-top:5px;" class="col-md-12"> <input type="text" name="extracolumndata[]" id="extracolumndata" placeholder="Add your Extra Columns "> </div>'));
            });

            $(window).on("scroll", function () {
                if ($(window).scrollTop() > 50) {
                    $(".tableheader").addClass("active");
                } else {
                    //remove the background property so it comes transparent again (defined in your css)
                    $(".tableheader").removeClass("active");
                }
            });

            $(function () {
                $(".definitions-table").stickyTableHeaders();
            });

            $(function () {
                $(".aeatable").stickyTableHeaders();
            });


            /*table tr highlight on hover*/
            $(document).on('mouseover', 'tr.stileone', function () {
                $(this).addClass("fill");
            });
            $(document).on('mouseleave', 'tr.stileone', function () {
                $(this).removeClass("fill");
            });


            /*filter mapping data*/
            $("#filter").keyup(function () {

                // Retrieve the input field text and reset the count to zero
                var filter = $(this).val(), count = 0;

                // Loop through the comment list
                $("nav ul li").each(function () {

                    // If the list item does not contain the text phrase fade it out
                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                        $(this).fadeOut();

                        // Show the list item if the phrase matches and increase the count by 1
                    } else {
                        $(this).show();
                        count++;
                    }
                });
            });


            // Update the count


            $('#search-1').hideseek();


            $(document).on('change', '#map_dataitem_status', function (e) {
                var mapping_status = $(this).val();
                if (mapping_status == "Map only this Data Item ") {
                    $('.map_only').show();
                    $('.map_associated ').hide();
                } else {
                    $('.map_only').hide();
                    $('.map_associated').show();
                }
            });

            $('.check_all_list').on('click', function () {
                if (this.checked) {
                    $('.wizard_list').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.wizard_list').each(function () {
                        this.checked = false;
                    });
                }
            });

            $('.clear-refresh-data').on('click', function () {
                window.location.reload();
            });


            $('#search-1').hideseek();
            $('.filtertable_mapping').DataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false
            });
            @if (count($approved) > 0)
            $('#connecttntdatatablepopup').DataTable({
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,
                "searching": true
            });
            @endif
           @if (count($aeadatas) > 0)
            var aea_datatable = $('.filtertable_aea').DataTable({
                "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                "bPaginate": true,
                "searching": true,

                "dom": '<"top"f>rt<"bottom"ilp><"clear">',
                "bFilter": false,
                "bInfo": false,
                "bAutoWidth": false,
                "order": [[7, "desc"]],
                columnDefs: [{
                    targets: "_all",
                    orderable: false
                }],
                oLanguage: {
                    sLengthMenu: "_MENU_",
                },






            });
            @endif

              $('.filtertable_aea').on('click', '.showhidedataitemstnr', function () {
                var tr = $(this).parents('tr');
                var row = aea_datatable.row( tr );
                var id = $(this).attr('id');
                if ($(this).text() == "Show")
                    $(this).text("Hide")
                else
                    $(this).text("Show");
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {




                    $("#coded_values_dataitems_" + id).toggleClass('invisible-data');
                    var data_item = $(this).attr('data-item-name');
                    var token = "{{csrf_token()}}";
                    $.ajax({
                        url: "{{ url("dashboard/data-item/coded-values-tnr") }}",
                        data: {"_token": token, "data_id": id, "data_item": data_item},
                        type: 'POST',
                        success: function (data) {
                            var d = $("#filterdatadataitems" + id).html(data);
                            row.child( data ).show();
                            tr.addClass('shown');
                        }

                    });



                }
            } );


          @if (count($approved) > 0)
            var reference_datatable = $('.reference-datatable').DataTable({
                "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                "bPaginate": true,
                "searching": true,

                "dom": '<"top"f>rt<"bottom"ilp><"clear">',
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,

                /*"order": [[8, "desc"]],*/
                oLanguage: {
                    sLengthMenu: "_MENU_"
                }

            });
            /*$('div#DataTables_Table_0_filter').appendTo("#filterdata_reference_data");*/
            @endif


            $('.reference-datatable').on('click', '.showhidedataitems', function () {

                if ($(this).text() == "Show")
                    $(this).text("Hide")
                else
                    $(this).text("Show");
                var tr = $(this).parents('tr');
                var row = reference_datatable.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {

                    var id = $(this).attr('id');



                    $("#coded_values_dataitems_" + id).toggleClass('invisible-data');
                    var data_item = $(this).attr('data-item-name');
                    var token = "{{csrf_token()}}";
                    $.ajax({
                        url: "{{ url("dashboard/data-item/coded-values") }}",
                        data: {"_token": token, "data_id": id, "data_item": data_item},
                        type: 'POST',
                        success: function (data) {
                            var d = $("#filterdatadataitems" + id).html(data);
                            row.child( data ).show();
                            tr.addClass('shown');
                        }

                    });

                    // Open this row (the format() function would return the data to be shown)

                }
            } );


          @if (count($dataset_group) > 0)
            var grouping_datatable = $('.grouping-datatable').DataTable({
                "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                "bPaginate": true,
                "searching": true,
                "dom": '<"top"f>rt<"bottom"ilp><"clear">',
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,
                oLanguage: {
                    sLengthMenu: "_MENU_"
                }

            });
            @endif

            $('.grouping-datatable').on('click', '.showhidegroupdata', function () {
                var tr = $(this).parents('tr');
                var row = grouping_datatable.row( tr );
                var id = $(this).attr('id');
                if ($(this).text() == "Show")
                    $(this).text("Hide")
                else
                    $(this).text("Show");
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {




                    $("#group_data_hidden_" + id).toggleClass('invisible-data-final');
                    var localPatientID = $(this).attr('data-patientid');
                    var status = $(this).attr('data-status');
                    var type = $(this).attr('data-type');

                    $.ajax({
                        url: "{{ url("dashboard/grouping/group-filter") }}",
                        data: {
                            "localPatientID": localPatientID, "status": status,"type":type
                        },
                        type: 'GET',
                        success: function (data) {
                            $('#filterdatagroupingdata' + id).html(data);
                            row.child( data ).show();
                            tr.addClass('shown');

                        }


                    });

                }
            } );



           @if (count($mapped_item) > 0)
            var mapping_datatable = $('.mapping-datatable').DataTable({
                "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                "bPaginate": true,
                "searching": true,
                "dom": '<"top"f>rt<"bottom"ilp><"clear">',
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,
                oLanguage: {
                    sLengthMenu: "_MENU_"
                },

            });
            @endif

           $('.mapping-datatable').on('click', '.oneormoremappingfinal', function () {
                var tr = $(this).parents('tr');
                var row = mapping_datatable.row( tr );
                var id = $(this).attr('id');
                if ($(this).text() == "Show")
                    $(this).text("Hide")
                else
                    $(this).text("Show");

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {




                    $("#coded_values_mapping_final_" + id).toggleClass('invisible-data-final');

                    var checked = []
                    $("input[name='wizard_list[]']:checked").each(function () {
                        checked.push(parseInt($(this).val()));
                    });

                    checked.push(parseInt($(this).attr('data-reference')));
                    var token = "{{csrf_token()}}";
                    var dataitemname = $(this).attr('data-item');

                    var nationalvalue = $(this).attr('data-national');

                    if (checked == "") {
                        checked = $(this).attr('data-reference');
                        checked.push(checked);
                        var datacount = "single";
                    } else {
                        var datacount = "multiple";
                    }
                    $.ajax({
                        url: "{{ url("dashboard/mapping/selected-data-moremapping-final") }}",
                        data: {
                            "data_selected": checked, "_token": token, "datacount": datacount,
                            "data_item": dataitemname, "nationalvalue": nationalvalue
                        },
                        type: 'POST',
                        success: function (data) {
                            $(".importedcodedvaluesfinal_" + id).html(data);
                            row.child( data ).show();
                            tr.addClass('shown');

                        }


                    });

                }
            } );

     /*       reference_datatable.rows().every( function () {
                this.child($( '<tr>'+'<td>1</td>'+'</tr>')).show();
        } );*/
            $('div#DataTables_Table_0_filter').appendTo("#filterdata");
            $('div#reference-datatable_filter').appendTo("#reference_datas");
            $('div#mapping-datatable_filter').appendTo("#mapping_datas");
            $('div#DataTables_Table_1_filter').appendTo("#grouping_datas");


            $("#wizard_form_file").validate({
                rules: {
                    file_title: "required",
                    filedescription: "required",
                    txtFileUpload: "required",
                },
                messages: {
                    file_title: "Please specify File Title",
                    file_title: "Please specify File Desctription",
                    txtFileUpload: "Please Choose File",

                }
            })


            $('.filtertable').filterTable({
                filterExpression: 'filterTableFindAll'
            });
            $('.filevalidation').click(function (e) {

                var val = $("#txtFileUpload").val();
                if (val == '') {
                    alert("Please Choose File");
                }

            });

            $("#txtFileUpload").change(function () {

                var val = $("#txtFileUpload").val();
                if (val == '') {
                    $('.filevalidation').addClass('disabled');
                } else {
                    $('.filevalidation').removeClass('disabled').addClass('fileinfo next-step-mapping');
                }
            });

            $('.file-data-loader').hide();

            $(document).on('click', '.fileinfo', function (e) {
                $('#extracolumndata').val("");
                jQuery('.file-data-loader').show();
                e.preventDefault();
                var thisForm = $('#wizard_form_file');
                var formData = new FormData();

                var common_data = $('#wizard_form_file').serialize();
                var fileInputElement = jQuery("#txtFileUpload");
                var cv_file = fileInputElement[0]["files"][0];

                formData.append("excel-data", cv_file);
                formData.append("formFields", common_data);
                /*     $.each(common_data, function (key, input) {
                 formData.append(input.name, input.value);
                 });*/

                $.ajax({
                    url: thisForm.attr('action'),
                    data: formData,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name=_token]').val()
                    },
                    contentType: false,
                    processData: false,
                    success: function (data) {

                        if (data == "empty field please check") {
                            var eachrow = "<tr class='dataqyality-issue'>"
                                    + "<td class='text-center ' colspan='5'><h1 class='text-danger'>Data Quality Issue. Please Check.</h1></td>"
                                    + "</tr>";
                            $('#tbodyrecords').html(eachrow);
                            jQuery('.file-data-loader').hide();
                        }else if(data == "Mime type error"){
                            var eachrow = "<tr class='dataqyality-issue'>"
                                    + "<td class='text-center ' colspan='5'><h3 class='text-danger text-center'>Sorry only CSV file type allowed to be imported.</h3></td>"
                                    + "</tr>";
                            $('.tbodyrecords').html("");
                            $('.tbodyrecordsnational').html("");
                            $('#versionmessage').hide();

                            $('#recordscount').html(eachrow);
                            jQuery('.file-data-loader').hide();

                        }
                        else if(data == "Column Error"){
                            var eachrow = "<tr class='dataqyality-issue'>"
                                    + "<td class='text-center ' colspan='5'><h3 class='text-danger text-center'>Sorry Please check your CSV Column.</h3></td>"
                                    + "</tr>";
                            $('.tbodyrecords').html("");
                            $('.tbodyrecordsnational').html("");
                            $('#versionmessage').hide();

                            $('#recordscount').html(eachrow);
                            jQuery('.file-data-loader').hide();

                        }
                        else {
                            $('.dataqyality-issue').css('display', 'none');
                            var i = 0;
                            $('.tbodyrecords').html("");
                            $('.tbodyrecordsnational').html("");
                            $('#versionmessage').html("");

                            $.each(data['recordlist'], function (index, item) {
                                var eachrow = "<tr>"


                                        + "<td class='text-center'>" + item['dataBaseName'] + "</td>"
                                        + "<td class='text-center'>" + item['tableName'] + "</td>"
                                        + "<td class='text-center'>" + item['dataItemName'] + "</td>"
                                        + "<td class='text-center'>" + item['dataItemDescription'] + "</td>"
                                        + "<td class='text-center'><select class='form-control valid datasetchange' id='datasetbelongs_" + item['definitionID'] + "' name='dataset_belongs' data-id=" + item['definitionID'] + ">" +
                                        "<option value=''>Please Select Data</option>" +
                                        "<option value='A&amp;E'>A&amp;E</option>" +
                                        "<option value='Ambulance'>Ambulance</option>" +
                                        "<option value='Inpatient'>Inpatient</option>" +
                                        "<option value='Mental Health'>Mental Health</option>" +
                                        "<option value='Out of Hours'>Out of Hours</option>" +
                                        "<option value='111'>111</option></select></td>"

                                        + "</tr>";
                                var eachrownational = "<tr>"


                                        + "<td class='text-center'>" + item['dataBaseName'] + "</td>"
                                        + "<td class='text-center'>" + item['tableName'] + "</td>"
                                        + "<td class='text-center'>" + item['dataItemName'] + "</td>"
                                        + "<td class='text-center'>" + item['dataItemDescription'] + "</td>"
                                        + "<td class='text-center'><select id='nationalfieldsingle' class='form-control valid nationalfieldsingle' name='dataset_belongs' data-id=" + item['definitionID'] + ">" +
                                        "<option value=''>Please Choose Data</option>" +
                                        "<option value='Local'>Local</option>" +
                                        "<option value='National'>National</option>" +
                                        "</select></td>" + +"</tr>";
                                $('.tbodyrecords').append(eachrow);
                                $('.tbodyrecordsnational').append(eachrownational);
                                i++;
                            });
                            $('#recordscount').html("<p style='text-align: justify'>You have a total of  " + data['totalrecords'] + " records of which " + data['correctrecords'] + " rows have been uploaded correctly and  " + data['incorrectdata'] + " rows with an error. <br> Click Finish to import the " + data['correctrecords'] + " correct rows " +
                                    "and ignore the " + data['incorrectdata'] + " rows with an error OR Cancel to fix and re-import data</p>");
                            $('#versionmessage').html(data['versionscontrol']);
                            jQuery('.file-data-loader').hide();
                            $('.filtertable_csv').DataTable({
                                "bPaginate": true,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": true,
                                "bAutoWidth": false
                            });


                        }
                    } /*else close here*/


                });


            });







            $('.showhidemapping').click(function () {

                var id = $(this).attr('id');
                if ($(this).text() == "Show")
                    $(this).text("Hide")
                else
                    $(this).text("Show");

                $("#coded_values_mapping_" + id).toggleClass('invisible-data');
                var data_item = $(this).attr('data-item-name');
                var token = "{{csrf_token()}}";
                $.ajax({
                    url: "{{ url("dashboard/data-item/coded-values-mapping") }}",
                    data: {"_token": token, "data_id": id, "data_item": data_item},
                    type: 'POST',
                    success: function (data) {
                        $("#filterdatamapping" + id).html(data);

                    }

                });


            });

            $('.showhidegrouping').click(function () {

                var id = $(this).attr('id');
                if ($(this).text() == "Show")
                    $(this).text("Hide")
                else
                    $(this).text("Show");


                $("#coded_values_grouping_" + id).toggleClass('invisible-data');
                var data_item = $(this).attr('data-item-name');
                var token = "{{csrf_token()}}";
                $.ajax({
                    url: "{{ url("dashboard/data-item/coded-values-grouping") }}",
                    data: {"_token": token, "data_id": id, "data_item": data_item},
                    type: 'POST',
                    success: function (data) {
                        $("#filterdatagrouping" + id).html(data);

                    }

                });


            });


            $(document).on('change', '.nationalfieldsingle', function (e) {
                $('#mapping_comments').val('');
                e.preventDefault();
                var value_ntn = $(this).val();
                var checked = $(this).attr('data-id');
                if (value_ntn == "Local") {


                    $('#commentsModal').modal('show');
                }
                else {
                    $('#mappingdataModal').modal('show');
                }

            });

            $(document).on('change', '.datasetbelongs', function (e) {
                var select_data = $(this).val();
                var checked = []
                $("input[name='wizard_list[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));

                });

                $("#datasetbelongs_" + checked).val(select_data);

            });


            $(document).on('change', '.datasetchange', function (e) {
                jQuery('.file-data-loader').show();
                e.preventDefault();

                var checked = $(this).attr('data-id');

                var dataset = $(this).val();
                var mappinginfo = $('.nationalfield:checked').val();
                var mappingdata = $('.mappingdata:checked').val();
                var mappingcomments = $('#mapping_comments').val();

                var token = "{{csrf_token()}}";
                /*$("input[name='wizard_list[]']:checked").each(function () { checked.push(parseInt($(this).val())); });
                 */
                $.ajax({
                    url: "{{ url("dashboard/data-wizard/wizard-dataset") }}",
                    data: {
                        "dataset": dataset, "data_selected": checked, "_token": token,
                        "mappinginfo": mappinginfo, "mappingdata": mappingdata, "mappingcomments": mappingcomments
                    },
                    type: 'POST',
                    success: function (data) {
                        $('#datasetmessage').html(data);
                        jQuery('.file-data-loader').hide();
                        setTimeout(function () {
                            $('#datasetmessage').remove();
                        }, 3000);

                    }


                });
            });


            $('.nationaldatasubmit').click(function (e) {
                e.preventDefault();
                jQuery('.file-data-loader').show();
                var checked = $('select#nationalfieldsingle').attr('data-id')
                var dataset = $('select#datasetbelongs option:selected').val();
                var mappinginfo = $('.nationalfield:checked').val();
                var mappingdata = $('.mappingdata:checked').val();
                var mappingcomments = $('#mapping_comments').val();

                var token = "{{csrf_token()}}";

                $.ajax({
                    url: "{{ url("dashboard/data-wizard/wizard-data") }}",
                    data: {
                        "dataset": dataset, "data_selected": checked, "_token": token,
                        "mappinginfo": mappinginfo, "mappingdata": mappingdata, "mappingcomments": mappingcomments
                    },
                    type: 'POST',
                    success: function (data) {
                        jQuery('.file-data-loader').hide();

                    }


                });
            });


            $('.file_details_info').click(function (e) {
                var selected_id = $(this).attr('data-id')
                var token = "{{csrf_token()}}";
                $.ajax({
                    url: "{{ url("dashboard/data-definitions/details") }}",
                    data: {"data_selected": selected_id, "_token": token,},
                    type: 'POST',
                    success: function (data) {
                        $('#file_status_filter').html(data);
                        $('#myModalfileinfo').modal('show');


                    }
                });
            });

            $('.commentsubmit').click(function (e) {
                e.preventDefault();
                jQuery('.file-data-loader').show();

                var dataset = $('select#nationalfieldsingle option:selected').val();
                var checked = $('select#nationalfieldsingle').attr('data-id');
                var mappinginfo = $('.nationalfield:checked').val();
                var mappingdata = $('.mappingdata:checked').val();
                var mappingcomments = $('#mapping_comments').val();

                var token = "{{csrf_token()}}";

                $.ajax({
                    url: "{{ url("dashboard/data-wizard/wizard-data") }}",
                    data: {
                        "dataset": dataset, "data_selected": checked, "_token": token,
                        "mappinginfo": mappinginfo, "mappingdata": mappingdata, "mappingcomments": mappingcomments
                    },
                    type: 'POST',
                    success: function (data) {
                        $('#commentmessage').html(data);
                        jQuery('.file-data-loader').hide();
                        setTimeout(function () {
                            $('#commentmessage').remove();
                        }, 3000);

                    }


                });
            });


            $('.mapfunctionality').click(function () {
                var checked = []
                $("input[name='maped_list[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });
                var nlinfo = $('.nationalfield:checked').val();

                if (nlinfo == "Local") {
                    $('#commentsModal').modal('show');
                }
                else {
                    $('#mappingdataModal').modal('show');
                }


            });


            $('.next-step-mapping').click(function () {


                var checked = []
                $("input[name='maped_list[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });


                var nlinfo = $('.nationalfield:checked').val();

                if (nlinfo == "Local") {


                    $('.mapping_comments').show();
                    $('.nationalmapping_comments').hide();

                }
                else {
                    $('.mapping_comments').hide();
                    $('.nationalmapping_comments').show();


                }

            });

            $(document).on('click', '.mappingdatabutton ', function (e) {


                var checked = []
                $(".nationalfiltertable input[name='wizard_list[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });

                var dataitem = $(this).attr('data-itemname');

                checked.push(parseInt($(this).attr('data-reference')));
                var token = "{{csrf_token()}}";
                if (checked == "") {
                    checked = $(this).attr('data-reference');
                    checked.push(checked);
                    var datacount = "single";
                } else {
                    var datacount = "multiple";
                }
                $('#mappingdataitem').html("Mapping Wizard " + dataitem);

                $('#mappingDataModel').modal('show');
                $.ajax({
                    url: "{{ url("dashboard/mapping/selected-data") }}",
                    data: {"data_selected": checked, "_token": token, "datacount": datacount},
                    type: 'POST',
                    success: function (data) {


                        if (data == "Please Select Data") {
                            var eachrow = "<tr class='dataqyality-issue'>"
                                    + "<td class='text-center ' colspan='5'><h1 class='text-danger'>Please Select Data</h1></td>"
                                    + "</tr>";
                            $('#tbodyrecords').html(eachrow);
                            jQuery('.file-data-loader').hide();
                        } else {
                            $('.dataqyality-issue').css('display', 'none');
                            var i = 0;
                            $('.tbodyrecords').html("");
                            $('.tbodyrecords_national').html("");
                            $('#recordscount').html("");
                            $.each(data, function (index, item) {
                                var eachrow = "<tr>"


                                        + "<td class='text-center'>" + item['dataItemName'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValue'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValueType'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValueDescription'] + "</td>"


                                        + "</tr>";
                                var eachrownational = "<tr>"
                                        + "<td class='text-center selecteddata' style='display:none'><input class='dataitem_list' name='dataitem_list_filter_mapping[]' value=" + item['definitionID'] + " type='checkbox' checked='true'></td>"
                                        + "<td class='text-center'>" + item['dataItemName'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValue'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValueType'] + "</td>"
                                        + "<td class='text-center'>" + item['codedValueDescription'] + "</td>"


                                        + "</tr>";

                                $('.nationalfiltertable').append(eachrownational);
                                i++;
                            });
                            $('#recordscount').append("<span>" + i + " Records Selected</span>");

                            jQuery('.file-data-loader').hide();
                            $('.filtertable_csv_modal').DataTable({
                                "bPaginate": true,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": true,
                                "bAutoWidth": false
                            });


                        }


                    }


                });


            })

            $(document).on('click', '.oneormoremapping ', function (e) {

                var dataitemname = $(this).attr('data-itemname');


                var checked = []
                $("input[name='wizard_list[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });

                checked.push(parseInt($(this).attr('data-reference')));
                var token = "{{csrf_token()}}";
                var dataitemname = $(this).attr('data-itemname');
                var nationalvalue = $(this).attr('data-nationalvalue');
                if (checked == "") {
                    checked = $(this).attr('data-reference');
                    checked.push(checked);
                    var datacount = "single";
                } else {
                    var datacount = "multiple";
                }

                $('#mappingdataitemname').html("Map Coded Values for " + dataitemname)
                $('#oneoremoremappingDataModel').modal('show');
                $.ajax({
                    url: "{{ url("dashboard/mapping/selected-data-moremapping") }}",
                    data: {
                        "data_selected": checked, "_token": token, "datacount": datacount,
                        "data_item": dataitemname, "nationalvalue": nationalvalue
                    },
                    type: 'POST',
                    success: function (data) {
                        $('#importedcodedvalues').html(data);


                    }


                });


            })





            $(document).on('click', '.groupdatabutton ', function (e) {

                $('#groupname').val("");
                $('#groupingDataModel').modal('show');
            })


            $(document).on('click', '.complete-wizard-group-grouping', function (e) {
                e.preventDefault();
                var checked = []
                var groupname = $('#groupname').val();
                var nhsnumber = $('#nhsnumber').val();
                var sex = $('#sex:checked').val();
                var arrivalmode = $('#arrivalmode').val();

                var token = "{{csrf_token()}}";
                $("input[name='group_list_filterdata[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });

                $.ajax({
                    url: "{{ url("dashboard/grouping/group-data") }}",
                    data: {
                        "groupdata": checked, "patientid": groupname, "_token": token,
                        "nhsnumber": nhsnumber, "sex": sex,
                        "arrivalmode": arrivalmode
                    },
                    type: 'POST',
                    success: function (data) {
                        window.location.reload();
                    }


                });


            });


            /* mapping information on popup */
            $(document).on('click', '.mapping_details_info ', function (e) {
                var token = "{{csrf_token()}}";
                var dataitemname = $(this).attr('data-item-name');
                var dataid = $(this).attr('data-ref-id');
                $.ajax({
                    url: "{{ url("dashboard/mapping/mapping-information") }}",
                    data: {"_token": token, "dataitemname": dataitemname, "dataid": dataid},
                    type: 'POST',
                    success: function (data) {

                        $('#mappinginforamtion').html(data);
                        $('#myModalmappingdetails').modal('show');

                    }
                });

            })


            $(document).on('click', '.complete-wizard-final', function (e) {
                e.preventDefault();
                var checked = []
                var dataset = $('select#datasetbelongs option:selected').val();
                var map_dataitem_status = $('select#map_dataitem_status option:selected').val();
                var mappinginfo = $('.nationalfield:checked').val();
                var mappingdata = $('.mappingdata:checked').val();
                var mappingdata_id = $('.mappingdata:checked').attr('id');
                var mappingcomments = $('#dataitemmapping_comments').val();
                var sharepointlink = $('#sharepoinglink').val();
                $("input[name='dataitem_list_filter_mapping[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });


                var token = "{{csrf_token()}}";


                $.ajax({
                    url: "{{ url("dashboard/data-item/wizard-data") }}",
                    data: {
                        "dataset": dataset,
                        "data_selected": checked, "_token": token,
                        "mappinginfo": mappinginfo, "mappingdata": mappingdata,
                        "mappingcomments": mappingcomments,
                        "map_dataitem_status": map_dataitem_status,
                        "sharepointlink": sharepointlink,
                        "mappingdata_id": mappingdata_id,
                    },
                    type: 'POST',
                    success: function (data) {
                        window.location.reload();


                    }


                });


            });


            $(document).on('click', '.replacedata', function (e) {
                e.preventDefault();
                var checked = []
                jQuery('.file-data-loader').show();
                var extradata = $('input[name="extracolumndata[]"]').map(function () {
                    return this.value
                }).get()

                var token = "{{csrf_token()}}";
                $("input[name='group_list_filter[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });

                $.ajax({
                    url: "{{ url("dashboard/data-wizard/replace-data") }}",
                    data: {"_token": token, "extradata": extradata},
                    type: 'POST',
                    success: function (data) {
                        jQuery('.file-data-loader').show();
                        window.location.reload();
                    }


                });


            });

            /* $(document).on('click', '.csvfinishbutton', function(e){

             window.location.reload();
             });*/


            $(document).on('click', '.csvfinishbutton', function (e) {
                e.preventDefault();
                var checked = []
                jQuery('.file-data-loader').show();

                var extradata = $('input[name="extracolumndata[]"]').map(function () {
                    return this.value
                }).get()


                var token = "{{csrf_token()}}";
                $("input[name='group_list_filter[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });

                $.ajax({
                    url: "{{ url("dashboard/data-wizard/add-new-data") }}",
                    data: {"_token": token, "extradata": extradata},
                    type: 'POST',
                    success: function (data) {
                        jQuery('.file-data-loader').hide();
                        window.location.reload();

                    }


                });


            });

            $(document).on('click', '.addnewdata', function (e) {
                e.preventDefault();
                var checked = []

                var token = "{{csrf_token()}}";
                $("input[name='group_list_filter[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });

                $.ajax({
                    url: "{{ url("dashboard/data-wizard/add-new-data") }}",
                    data: {"_token": token,},
                    type: 'POST',
                    success: function (data) {
                        window.location.reload();

                    }


                });


            });


            $(document).on('click', '.clear-importdata', function (e) {
                e.preventDefault();
                var token = "{{csrf_token()}}";

                $.ajax({
                    url: "{{ url("dashboard/data-wizard/clear-data") }}",
                    data: {"_token": token,},
                    type: 'POST',
                    success: function (data) {
                        $("#recordscount").html("");
                        $("#tbodyrecords").html("");
                        $('.filtertable_csv').DataTable().destroy();

                    }


                });


            });


            /* show hide map button local or national*/

            $(document).on('click', 'input[name=data_item]', function (e) {

                var test = $(this).val();

                if (test == "Local") {
                    $('.commentsdata').removeClass('hidedatabutton ');
                    $('.commentsnationaldata').addClass('hidedatabutton ');
                }
                else {
                    $('.commentsnationaldata').removeClass('hidedatabutton ');
                    $('.commentsdata').addClass('hidedatabutton ');
                }

            });


            /* csv file upload using ajax*/

            $(document).on('click', '.complete-wizard', function (e) {
                jQuery('.file-data-loader').show();
                e.preventDefault();
                var thisForm = $('#wizard_form');
                var formData = new FormData();

                var common_data = $('#wizard_form').serialize();
                var fileInputElement = jQuery("#txtFileUpload");
                var cv_file = fileInputElement[0]["files"][0];

                formData.append("excel-data", cv_file);
                formData.append("formFields", common_data);


                $.ajax({
                    url: "{{ url("dashboard/data-wizard/wizard-data") }}",
                    data: formData,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name=_token]').val()
                    },
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        jQuery('.file-data-loader').hide();
                        window.location.reload();
                    }

                });


            });


            $(document).on('click', '.complete-mapping', function (e) {
                window.location.reload();
            });


            $(document).on('click', '.complete-wizard-local-national', function (e) {

                window.location.reload();
            });


            /* hold the tabs even after the page refresh*/
            $(document).ready(function () {
                $(".set-tab").click(function () {
                    var data_tab_id = $(this).attr('id');

                    $.ajax({
                        url: '{{url("dashboard/data-wizard/set-tab")}}',
                        type: 'GET',
                        data: {"data_tab_id": data_tab_id},
                        success: function (data) {

                        }
                    });

                });
            });
            var active_tab = '#{{$tab_id_wizard}}';
            $(active_tab).click();


            $(document).on('click', '.localchecked', function (e) {

                if ($(this).is(':checked')) {
                    var value = $(this).val();

                    $(this).closest(".localtable").css('background-color', '#A9A9A9');
                    $(this).closest(".localtable").find('.local_national_mapping').addClass('btn-primary');
                }
            });

            $(document).on('click', 'input[name=selectednationalvalue]', function (e) {


                $(this).closest(".nationaltable").css('background-color', '#A9A9A9');
            });


            /* local data to national data mapping*/
            $(document).on('click', '.local_national_mapping', function (e) {
                var colorcode;

                var checked = []
                var localid = $('input[name=selectedlocalvalue]:checked').val();
                var nationalid = $('input[name=selectednationalvalue]:checked').val();
                var localdataname = $(this).attr('data-localname');
                var nationaldataname = $(this).attr('data-nationalname');
                var token = "{{csrf_token()}}";

                var token = "{{csrf_token()}}";
                $("input[name='selectedlocalvalue[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });

                $.ajax({
                    url: "{{ url("dashboard/mapping/localto-national") }}",
                    data: {
                        "local_id": localid, "national_id": nationalid, "_token": token,
                        "colorcode": colorcode, "localdataname": localdataname,
                        "nationaldataname": nationaldataname, "checked": checked
                    },
                    type: 'POST',
                    success: function (data) {
                        $('#importedcodedvalues').html(data);

                    }


                });


            });


            $(document).on('click', '.finishdatatypegroup', function (e) {
                e.preventDefault();
                var checked = []
                var patientid = $('#localpatientidgroup').val();
                var groupname = $('#groupnamegroup').val();
                var sex = $('#sexgroup:checked').val();
                var addressformatcode = $('#addressformatcodegroup').val();

                var token = "{{csrf_token()}}";
                $("input[name='wizard_list_filter[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });
                $.ajax({
                    url: "{{ url("dashboard/grouping/group-data") }}",
                    data: {
                        "groupdata": checked, "patientid": patientid, "_token": token,
                        "groupname": groupname, "sex": sex,
                        "addressformatcode": addressformatcode
                    },
                    type: 'POST',
                    success: function (data) {
                        window.location.reload();
                    }


                });


            });


            $(document).on('click', '.finishcodedvaluegroup', function (e) {
                e.preventDefault();
                var checked = []
                var patientid = $('#localpatientidcoded').val();
                var groupname = $('#groupnamecoded').val();
                var sex = $('#sexcoded:checked').val();
                var addressformatcode = $('#addressformatcodecoded').val();

                var token = "{{csrf_token()}}";
                $("input[name='wizard_list_filter_coded[]']:checked").each(function () {
                    checked.push(parseInt($(this).val()));
                });

                $.ajax({
                    url: "{{ url("dashboard/grouping/group-data-coded") }}",
                    data: {
                        "groupdata": checked, "patientid": patientid, "_token": token,
                        "groupname": groupname, "sex": sex,
                        "addressformatcode": addressformatcode
                    },
                    type: 'POST',
                    success: function (data) {
                        window.location.reload();
                    }


                });


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

                $(document).on('click', '.next-step-mapping', function (e) {
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