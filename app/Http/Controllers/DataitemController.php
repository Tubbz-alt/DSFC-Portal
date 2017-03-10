<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\CsvReferenca;
use App\Models\Datawizard;
use App\Models\Dditems;
use App\Models\Aeadata;
use App\Models\Definitions;

use DB;
use Illuminate\Http\Request;
use Input;
use Mail;
use Sentinel;
use Validator;

class DataitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $start_time = date("h:i:sa");
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        if ($user->inRole('administrator')) {
            $csv_list = CsvReferenca::where('crossReferenceId', '=', 0)
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->orderBy('createdDate', 'DESC')->get();

            $csv_list_activated = CsvReferenca::where('status', '=', 1)
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->where('crossReferenceId', '=', 0)
                ->orderBy('createdDate', 'DESC')->get();
            $csv_list_pending = CsvReferenca::where('status', '=', 0)
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->where('crossReferenceId', '=', 0)
                ->orderBy('createdDate', 'DESC')->get();
            $pending_approval = CsvReferenca::
            leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->where('emconceptreferencedata.status', '=', 0)
                ->orderBy('emdefinitionstable.referenceDetailId', 'DESC')->get();
            /*       $approved = CsvReferenca::
                   leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                       ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                       ->where('emconceptreferencedata.status','=',1)
                       ->orderBy('emdefinitionstable.referenceDetailId','DESC')->get();*/
            $approved = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->whereNotIn('definitionID', function ($q) {
                    $q->select('referenceDetailId')->from('emdatawizard');
                })->get();

        } else {
            $csv_list = CsvReferenca::leftjoin('emdefinitionstable', 'emconceptreferencedata.crossReferenceId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->where('emconceptreferencedata.userId', '=', $user_id)
                ->orderBy('emdefinitionstable.createdDate', 'DESC')->get();


            $csv_list_activated = CsvReferenca::where('status', '=', 1)
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->where('crossReferenceId', '=', 0)
                ->where('userId', '=', $user_id)
                ->orderBy('createdDate', 'DESC')->get();
            $csv_list_pending = CsvReferenca::where('status', '=', 0)
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->where('userId', '=', $user_id)
                ->where('crossReferenceId', '=', 0)
                ->orderBy('createdDate', 'DESC')->get();
            $pending_approval = CsvReferenca::
            leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->where('userId', '=', $user_id)
                ->where('emconceptreferencedata.status', '=', 0)
                ->orderBy('emdefinitionstable.referenceDetailId', 'DESC')->get();
            /*     $approved = CsvReferenca::
                 leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                     ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                     ->where('userId','=',$user_id)
                     ->where('emconceptreferencedata.status','=',1)
                     ->orderBy('emdefinitionstable.referenceDetailId','DESC')->get();*/
            $approved = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->where('userId', '=', $user_id)
                ->whereNotIn('definitionID', function ($q) {
                    $q->select('referenceDetailId')->from('emdatawizard');
                })
                ->groupBy('emdefinitionstable.dataItemName')->get();

        }

        $dditems = Dditems::all();


        return view("dashboards.data-item", compact('data', 'csv_list', 'csv_list_activated', 'dditems', 'definitions_data', 'start_time', 'end_time', 'csv_list_pending', 'pending_approval', 'approved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postSelectedData(Request $request)
    {
        $data = $request->all();
        $data_id = $data['data_selected'];
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->where('userId', '=', $user_id)
            ->whereIn('emdefinitionstable.definitionID', $data_id)
            ->whereNotIn('definitionID', function ($q) {
                $q->select('referenceDetailId')->from('emgroupinfo');
            })->get();

        return $definitions_data;


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postStoreInfo(Request $request)
    {
        $data = $request->all();

        $user_id = Sentinel::check()->id;

        $file = array_get($data, 'excel-data');

        $inputData = Input::get('formFields');
        parse_str($inputData, $formFields);

        $fileTitle = $formFields['file_title'];
        $filedescription = $formFields['filedescription'];


        // SET UPLOAD PATH
        $destinationPath = 'media/uploads';
        // GET THE FILE EXTENSION
        $extension = $file->getClientOriginalExtension();
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $file_time = date('H_i_s');
        $fileNameextension = $file->getClientOriginalName();
        $fileName = $file_time . '' . $fileNameextension;

        $fileType = $file->getMimeType();
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $upload_success = $file->move($destinationPath, $fileName);
        $created = date("Y-m-d H:i:s");

        /* csv file upload */
        if ($upload_success) {

            $data = array(
                'userId' => $user_id,
                'fileTitle' => $fileTitle,
                'fileDescription' => $filedescription,
                'fileName' => $fileType,
                'filePath' => $fileName,
                'crossReferenceId' => 0,
                'status' => 0,
                'createdDate' => $created,

            );

            $csvinsert = CsvReferenca::insert($data);
            /*Check if the csv file upload sucessfully*/

            if ($csvinsert) {
                $csv_id = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId', 'DESC')->first();

                $fileD = fopen("media/uploads/$fileName", "r");

                if ($fileD) {


                    /*    $patient = new Definitions();
                        $patient::truncate();*/
                    $line = 0; // 1
                    $empty_value_found = false;
                    $incorrectrecords = 0; // 1
                    $correctrecords = 0;
                    $dataItemId = 1;
                    while (($value = fgetcsv($fileD)) !== false) {
                        if ($line > 0) { // 2
                            // Keep logic here to add to database, line 1 onwards

                            $dataItemName = $value[0];
                            $codedValue = $value[1];
                            $codedValueType = $value[2];
                            $codedValueDescription = $value[3];


                            if (empty($dataItemName)
                                || empty($codedValue)
                                || empty($codedValueType)
                                || empty($codedValueDescription)

                            ) {
                                $empty_value_found = true;
                                $errormsg = "empty field please check";
                                $csv_id_deleted = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId', 'DESC')->first();

                                $datawiard_id = Definitions::select('referenceDetailId')->orderBy('referenceDetailId', 'DESC')->first();

                                /*   Definitions::where('referenceDetailId', '=', $datawiard_id->referenceDetailId)->delete();
                                   CsvReferenca::where('conceptReferenceDataId', '=', $csv_id_deleted->conceptReferenceDataId)->delete();
                                 */ /* return $errormsg;
                                break; // stop our while-loop*/
                                $incorrectrecords++;
                            } else {


                                $inserted_data = array(
                                    'referenceDetailId' => $csv_id->conceptReferenceDataId,
                                    'dataItemName' => strip_tags($dataItemName),
                                    'codedValue' => strip_tags($codedValue),
                                    'codedValueType' => strip_tags($codedValueType),
                                    'codedValueDescription' => strip_tags($codedValueDescription),
                                    'dataItemId' => "00000" . $dataItemId,
                                    'dataItemVersionId' => "0.01",
                                    'codedValueId' => "00000" . $dataItemId . "." . "001",
                                    'codedValueVersionId' => "0.01",
                                    'author' => $user_id,
                                    'createdDate' => $created,
                                    'uploadedDate' => $created

                                );
                                $correctrecords++;
                                $dataItemId++;
                                Definitions::insert($inserted_data);

                            }
                        }

                        $line++;


                    }
                }


                $upload_msg = "sucess";
            }
            $data_additional = Definitions::distinct()->select('dataItemName')->where('referenceDetailId', '=', $csv_id->conceptReferenceDataId)->get();
            $dataitemid = 1;
            foreach ($data_additional as $additionalinfo) {

                $inserted_info = array(
                    'dataItemId' => "00000" . $dataitemid,
                    'codedValueId' => "00000" . $dataitemid . "." . "001",
                );

                Definitions::where('dataItemName', '=', $additionalinfo->dataItemName)->update($inserted_info);
                $dataitemid++;


            }


            $rec_count = Definitions::orderBy('referenceDetailId', 'DESC')->count();

            /*   echo "<span>$rec_count Records Found</span>";*/

            $latestrecord = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId', 'DESC')->first();

            $rec_list = Definitions::orderBy('referenceDetailId', 'DESC')
                ->where('referenceDetailId', '=', $latestrecord->conceptReferenceDataId)->get();

            if ($incorrectrecords >= 1) {
                $qualityIssues = "1";
            } else {
                $qualityIssues = "0";
            }

            $data = array(
                'qualityIssues' => $qualityIssues,
                'qualityIssuesCount' => $incorrectrecords,

            );

            $fileinfo_qualitydata = CsvReferenca::where('conceptReferenceDataId', '=', $csv_id->conceptReferenceDataId)->update($data);

            $datainfo = array('recordlist' => $rec_list,
                'incorrectdata' => $incorrectrecords,
                'totalrecords' => $line - 1,
                'correctrecords' => $correctrecords,
            );


            return $datainfo;


        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function postWizardMappingData(Request $request)
    {
        $data = $request->all();

        if (!empty($data['data_selected'])) {
            $data_id = $data['data_selected'];
            $created = date("Y-m-d H:i:s");
            foreach ($data_id as $info) {
                $dataexist = Datawizard::where('referenceDetailId', '=', $data_id)->first();

                $wizardinfo = array(
                    'referenceDetailId' => $info,
                    'datasetBelongs' => $data['dataset'],
                    'dataItem' => $request->input('mappinginfo'),
                    'mappingInfo' => $request->input('mappingdata'),
                    'mappingComments' => $data['mappingcomments'],
                    'sharePointLink' => $data['sharepointlink'],
                    'createdDate' => $created,

                );

                $uizardupdate = array(
                    'datasetBelongs' => $data['dataset'],
                    'dataItem' => $request->input('mappinginfo'),
                    'mappingInfo' => $request->input('mappingdata'),
                    'mappingComments' => $data['mappingcomments'],
                    'sharePointLink' => $data['sharepointlink'],
                    'createdDate' => $created,

                );


                if (!empty($dataexist)) {
                    Datawizard::where('referenceDetailId', $data_id)->update($uizardupdate);

                } else {
                    Datawizard::insert($wizardinfo);
                }


            }

        } else {
            echo "error";

        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function postWizardData(Request $request)
    {
        $data = $request->all();


        if (!empty($data['data_selected'])) {
            $data_id = $data['data_selected'];
            $created = date("Y-m-d H:i:s");
            foreach ($data_id as $info) {
                $dataexist = Datawizard::where('referenceDetailId', '=', $data_id)->first();
                $datadefinition = Definitions::where('definitionID', '=', $data_id)->first();


                if ($request->input('mappinginfo') == "Local") {
                    $infostatus = array(
                        'isMapped' => 1,
                        'mappedCodedStatus' => 1,
                    );
                    $wizardinfo = array(
                        'referenceDetailId' => $info,
                        'datasetBelongs' => $data['dataset'],
                        'dataItem' => $request->input('mappinginfo'),
                        'status' => 1,
                        'mappedCodedStatus' => 1,


                        'mappingComments' => $data['mappingcomments'],
                        'createdDate' => $created,

                    );

                    $uizardupdate = array(
                        'datasetBelongs' => $data['dataset'],
                        'dataItem' => $request->input('mappinginfo'),
                        'sharePointLink' => $request->input('sharepointlink'),

                        'mappingComments' => $data['mappingcomments'],
                        'createdDate' => $created,

                    );

                } else {
                    $infostatus = array(
                        'isMapped' => 1,
                    );
                    $wizardinfo = array(
                        'referenceDetailId' => $info,
                        'datasetBelongs' => $data['dataset'],
                        'dataItem' => $request->input('mappinginfo'),
                        'status' => 1,
                        'mappedCodedStatus' => 1,
                        'mappingInfo' => $request->input('mappingdata'),
                        'nationalDataId' => $request->input('mappingdata_id'),

                        'mappingComments' => $data['mappingcomments'],
                        'createdDate' => $created,

                    );

                    $uizardupdate = array(
                        'datasetBelongs' => $data['dataset'],
                        'dataItem' => $request->input('mappinginfo'),
                        'mappingInfo' => $request->input('mappingdata'),
                        'nationalDataId' => $request->input('mappingdata_id'),
                        'mappingComments' => $data['mappingcomments'],
                        'createdDate' => $created,

                    );

                }


                if (!empty($dataexist)) {
                    Definitions::where('dataItemName', '=', $datadefinition['dataItemName'])
                        ->update($infostatus);
                    Datawizard::where('referenceDetailId', $data_id)->update($uizardupdate);

                } else {
                    Definitions::where('dataItemName', '=', $datadefinition['dataItemName'])
                        ->update($infostatus);
                    Datawizard::insert($wizardinfo);
                }


                $check_coded = Definitions::where('definitionID', '=', $data_id)->first();
                if (empty($check_coded->codedValue)) {
                    $infostatus_coded = array(
                        'mappedCodedStatus' => 1,
                    );
                    Definitions::where('definitionID', '=', $data_id)
                        ->update($infostatus_coded);
                }


            }

        } else {
            echo "error";

        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function postCodedValues(Request $request)
    {
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        $data = $request->all();

        $approved = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->where('emdefinitionstable.dataItemName', '=', $data['data_item'])
            ->get();

        $mappinginfo = DB::table('emdatawizard')
            ->select('mappingInfo')
            ->where('referenceDetailId', '=', $data['data_id'])
            ->first();


        if (!empty($mappinginfo)) {
            $mappinginfo = $mappinginfo->mappingInfo;
        } else {
            $mappinginfo = "";
        }
        $a = count($approved);
        echo '<div class="container" style="text-align: center">
<table style="display: inline-block;text-align: center;">
<tr class="additionaldata" style="width: 100%;">
<td class="invisible-data " colspan="11" id="coded_values_dataitems_' . $data['data_id'] . '" align="center">';
        echo '<td class="text-center" style="width: 100%;">
                  <table class="table table-striped table-bordered definitions-table remove_last_element"
                                                       style="width: 100%;">';
        echo '<tr style="background-color: #979797;color:white; "
                                                        class="table_header_color_white">
                                                        <th class="text-center ">Coded Value</th>
                                                        <th class="text-left ">Coded Value Description</th>
                                                        <th class="text-center "></th>

                                                    </tr>  ';
        foreach ($approved as $key => $data) {
            echo "<tr class='data-show-table stileone'> 
                    <td class=\"text-center \">$data->codedValue</td>
                    <td class=\"text-left \">$data->codedValueDescription</td>
                ";

            if ($key == 0) {
                echo " <td rowspan='$a' class='text-center' style='width: 106px;background-color: #ffffff !important; vertical-align:middle;'>  
                       <span >
                            <a href='javascript:void(0)'>
                            <span class='oneormoremapping btn check-map check_$data->definitionID'
															data-reference='$data->definitionID'
															data-itemname='$data->dataItemName'
															data-nationalvalue='$mappinginfo'
															 style='border: 1px solid #2e6da4;'>
							Map Coded Values
                            </span >
                            </a >
                           </span > </td >";
            }

            echo "</tr>";
        }

        echo "</table></td></td></tr></table></div>";
    }

    public function postCodedValuesTnr(Request $request)
    {
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        $data = $request->all();

        $aeadatas =Aeadata::
        leftjoin('emtnrconnecteddata','emaeadatadefinition.tnrId','=','emtnrconnecteddata.tnrDataId')
            ->leftjoin('emdefinitionstable','emtnrconnecteddata.dataLocalId','=','emdefinitionstable.definitionID')
            ->where('tnrId','=',$data['data_id'])
            ->orderBy('tnrConnectStatus','DESC')
            ->get();




        echo '<div class="container" style="text-align: center">
            <table style="display: inline-block;text-align: center;">
            <tr class="additionaldata" style="width: 100%;">';
        echo '<td class="text-center" style="width: 100%;">
                  <table class="table table-striped table-bordered definitions-table remove_last_element"
                                                       style="width: 100%;">';
        echo '<tr style="background-color: #979797;color:white; "
                                                        class="table_header_color_white">
                                                        <th class="text-center ">Code </th>
                                                        <th class="text-center" style="width: 80%">Code Description </th>
                                                    

                                                    </tr>  ';
        foreach ($aeadatas as $key => $data) {
            echo "<tr class='data-show-table stileone'> 
                    <td class=\"text-center \">$data->codeTbc</td>
                    <td class=\"text-left \">$data->codeDescriptionTbc</td>
              </tr>";
        }

        echo "</table></td></td></tr></table></div>";
    }

    public function postCodedValuesMapping(Request $request)
    {
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        $data = $request->all();

        $approved = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->where('emdefinitionstable.dataItemName', '=', $data['data_item'])
            ->get();

        $mappinginfo = DB::table('emdatawizard')
            ->select('mappingInfo')
            ->where('referenceDetailId', '=', $data['data_id'])
            ->first();
        if (!empty($mappinginfo)) {
            $mappinginfo = $mappinginfo->mappingInfo;
        } else {
            $mappinginfo = "";
        }
        $a = count($approved);
        foreach ($approved as $key => $data) {
            echo "<tr class='data-show-table'> 
                    <td class=\"text-center \">$data->codedValue</td>
                    <td class=\"text-center \">$data->codedValueDescription</td>
                ";
            if ($key == 0) {
                echo " <td rowspan='$a' class='text-center' style='width: 106px; vertical-align:middle;'>  
                       <span >
                            <a href='javascript:void(0)'>
                            <span class='oneormoremappingfinal btn check - map check_$data->definitionID'
															data-reference='$data->definitionID'
															data-itemname='$data->dataItemName'
															data-nationalvalue='$mappinginfo'
															 style='border: 1px solid #2e6da4;'>
							Map Coded Values
                            </span >
							</a >
                           </span > </td >";
            }

            echo " </tr>";
        }
    }

    public function postCodedValuesGrouping(Request $request)
    {
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        $data = $request->all();

        $approved = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->where('dataItemName', '=', $data['data_item'])
            ->get();

        foreach ($approved as $data) {
            echo "<tr> 
                    <td class=\"text-center \">$data->codedValue</td>
                    <td class=\"text-center \">$data->codedValueDescription</td>
                    <td class=\"text-center\" style=\"width: 106px;\">  
                       <span >
                            <a href=\"javascript:void(0)\">
                            <span class=\"mappingdatabutton btn check-map check_$data->definitionID\"
															data-reference=\"$data->definitionID\"
															 style=\"border: 1px solid #2e6da4;\">
							Group
							</span>
							</a>

                           </span>
                      </td>

                    </tr>";
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
