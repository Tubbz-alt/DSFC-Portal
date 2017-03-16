<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CsvReferenca;
use App\Models\CsvReferenceDetails;
use App\Models\Comments;
use App\Models\Definitions;
use App\Models\Groupinginfo;
use App\Models\Dditems;
use App\Models\Datawizard;
use App\Models\HelpModel;
use App\Models\Aeadata;
use App\Models\DefinitionsTemp;


use Sentinel;
use Validator;
use Input;
use DB;
use Mail;
use Session;


class DatawizardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $datare = $request->all();
        $start_time = date("h:i:sa");
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        if($user->inRole('administrator')){
            $csv_list = CsvReferenca::where('crossReferenceId','=',0)
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->orderBy('createdDate','DESC')->get();

            $csv_list_activated = CsvReferenca::where('status','=',1)
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('crossReferenceId','=',0)
                ->orderBy('createdDate','DESC')->get();
            $csv_list_pending = CsvReferenca::where('status','=',0)
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('crossReferenceId','=',0)
                ->orderBy('createdDate','DESC')->get();
            $pending_approval = CsvReferenca::
            leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')

                ->where('emconceptreferencedata.status','=',0)
                ->orderBy('emdefinitionstable.referenceDetailId','DESC')->get();
     /*       $approved = CsvReferenca::
            leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('emconceptreferencedata.status','=',1)
                ->orderBy('emdefinitionstable.referenceDetailId','DESC')->get();*/




            if(!empty($datare['data_item'])){

                Session::put('dataitem_selected_name', $datare['data_item']);
                $approved = DB::table('emconceptreferencedata')
                    ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                    ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                    ->leftjoin('emdatatypemapp', 'emdefinitionstable.definitionID', '=', 'emdatatypemapp.dataMappedId')
                    ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                    ->where('emconceptreferencedata.status','=',1)
                    /* ->where('emdefinitionstable.mappedCodedComplete','=',0)*/
                    ->where('emdefinitionstable.dataItemName', '<>', '')

                    ->orderBy('emdefinitionstable.isMapped','DESC')
                    ->groupBy('emdefinitionstable.dataItemName')
                    ->get();


            }else{

                $approved = DB::table('emconceptreferencedata')
                    ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                    ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                    ->leftjoin('emdatatypemapp', 'emdefinitionstable.definitionID', '=', 'emdatatypemapp.dataMappedId')
                    ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                    ->where('emconceptreferencedata.status','=',1)
                    /* ->where('emdefinitionstable.mappedCodedComplete','=',0)*/
                    ->where('emdefinitionstable.dataItemName', '<>', '')
                    ->orderBy('emdefinitionstable.isMapped','DESC')
                    ->groupBy('emdefinitionstable.dataItemName')
                    ->get();

            }






            $approved_grouped = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('emconceptreferencedata.status','=',1)
                ->whereNotIn('definitionID', function($q){
                    $q->select('referenceDetailId')->from('emgroupinfo');
                }) ->groupBy('emdefinitionstable.dataItemName')->get();


            if(!empty($datare['mapping_data_item'])){
                Session::put('mapped_selected_name', $datare['mapping_data_item']);
            $mapped_item = CsvReferenca::
            leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->join('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('emdatawizard.status','=',1)
                ->where('emdefinitionstable.mappedCodedStatus','=',1)
                ->where('emdefinitionstable.dataItemName','=',$datare['mapping_data_item'])
                ->orderBy('emdefinitionstable.referenceDetailId','DESC')
                ->get();
            }else{
                $mapped_item = CsvReferenca::
                leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                    ->join('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                    ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                    ->where('emdatawizard.status','=',1)
                    ->where('emdefinitionstable.mappedCodedStatus','=',1)
                    ->orderBy('emdefinitionstable.referenceDetailId','DESC')
                    ->get();

            }

        }else{
            $csv_list = CsvReferenca::leftjoin('emdefinitionstable','emconceptreferencedata.crossReferenceId','=','emdefinitionstable.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('emconceptreferencedata.userId','=',$user_id)
                ->orderBy('emdefinitionstable.createdDate','DESC')->get();


            $csv_list_activated = CsvReferenca::where('status','=',1)
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('crossReferenceId','=',0)
                ->where('userId','=',$user_id)
                ->orderBy('createdDate','DESC')->get();
            $csv_list_pending = CsvReferenca::where('status','=',0)
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                 ->where('userId','=',$user_id)
                 ->where('crossReferenceId','=',0)
                ->orderBy('createdDate','DESC')->get();
            $pending_approval = CsvReferenca::
            leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('userId','=',$user_id)
                ->where('emconceptreferencedata.status','=',0)
                ->orderBy('emdefinitionstable.referenceDetailId','DESC')->get();


            $approved = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('emdatatypemapp', 'emdefinitionstable.definitionID', '=', 'emdatatypemapp.dataMappedId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('userId','=',$user_id)
                ->where('emconceptreferencedata.status','=',1)
                ->where('emdefinitionstable.dataItemName', '<>', '')
                ->orderBy('emdefinitionstable.isMapped','DESC')
                ->groupBy('emdefinitionstable.dataItemName')
                ->get();




            $approved_grouped = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('userId','=',$user_id)
                ->where('emconceptreferencedata.status','=',1)
                ->whereNotIn('definitionID', function($q){
                    $q->select('referenceDetailId')->from('emgroupinfo');
                }) ->groupBy('emdefinitionstable.dataItemName')->get();

            $mapped_item = CsvReferenca::
            leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->join('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('emdatawizard.status','=',1)
                ->where('userId','=',$user_id)
                ->where('emdefinitionstable.mappedCodedStatus','=',1)
                ->orderBy('emdefinitionstable.referenceDetailId','DESC')->get();



        }

        $dditems =Dditems::all();







        if(!empty($datare['database_name'])){
            Session::put('database_selected_name', $datare['database_name']);
        }
        if(!empty($datare['table_name'])){
            Session::put('table_selected_name', $datare['table_name']);
        }

        if(!empty($datare['table_name'])){
            Session::put('table_selected_name', $datare['table_name']);
            $aeadatas =Aeadata::
            leftjoin('emtnrconnecteddata','emaeadatadefinition.tnrId','=','emtnrconnecteddata.tnrDataId')
                ->leftjoin('emdefinitionstable','emtnrconnecteddata.dataLocalId','=','emdefinitionstable.definitionID')

                ->orderBy('tnrConnectStatus','DESC')
                ->where('tableName','=',$datare['table_name'])
                ->get();

        }elseif(!empty($datare['database_name'])){

            Session::put('database_selected_name', $datare['database_name']);
            $aeadatas =Aeadata::
            leftjoin('emtnrconnecteddata','emaeadatadefinition.tnrId','=','emtnrconnecteddata.tnrDataId')
                ->leftjoin('emdefinitionstable','emtnrconnecteddata.dataLocalId','=','emdefinitionstable.definitionID')
                ->where('dataBaseName','=',$datare['database_name'])
                ->orderBy('tnrConnectStatus','DESC')

                ->get();
        }else{
            $aeadatas =Aeadata::
                  leftjoin('emtnrconnecteddata','emaeadatadefinition.tnrId','=','emtnrconnecteddata.tnrDataId')
                ->leftjoin('emdefinitionstable','emtnrconnecteddata.dataLocalId','=','emdefinitionstable.definitionID')
                ->orderBy('tnrConnectStatus','DESC')
                ->get();
        }




        $aeadatasdatabaelist=Aeadata::lists('dataBaseName','dataBaseName')->all();
        $aeadatastablelist=Aeadata::lists('tableName','tableName')->all();

        $dataitemlist = CsvReferenca::
        leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
           // ->join('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
           // ->where('emdatawizard.status','=',1)
          //  ->where('emdefinitionstable.mappedCodedStatus','=',1)
            ->orderBy('emdefinitionstable.dataItemName','ASC')
            ->lists('dataItemName','dataItemName')->all();



//        $groupitemlist = Definitions::join('emgroupinfo_data', 'emdefinitionstable.definitionID', '=', 'emgroupinfo_data.	reference_data_id')
//            ->groupBy('emgroupinfo.groupName')
//            ->orderBy('emgroupinfo.groupName', 'ASC')
//            ->lists('groupName','groupName')->all();
        $groupitemlist =array();
                $groupitemlist_data = DB::table('emgroupinfo')
                    ->join('emgroupinfo_data', 'emgroupinfo_data.group_id', '=', 'emgroupinfo.groupId')
                    ->groupBy('emgroupinfo.groupId')
                    ->orderBy('emgroupinfo.groupName', 'ASC')
                    ->get();
                foreach($groupitemlist_data as $data)
                {
                        $groupitemlist[$data->groupName]=$data->groupName;
                }


         $groupitemlist_coded = CsvReferenca::leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->where('emconceptreferencedata.status','=',1)
            ->where('emdefinitionstable.codedValue', '<>','')
            ->whereNotIn('definitionID', function($q){
                $q->select('referenceDetailId')
                    ->from('emgroupinfo')
                    ->where('emgroupinfo.groupType', '=', 'coded');
            })->lists('emdefinitionstable.dataItemName','emdefinitionstable.dataItemName')->all();

        $tab_id_wizard = Session::get('data_tab_id_wizard');


       /* $dataset_group = CsvReferenca::
        leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
            ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
            ->where('userId','=',$user_id)
            ->where('emgroupinfo.status','=',1)
            ->groupBy('emgroupinfo.localPatientID')
            ->orderBy('emdefinitionstable.referenceDetailId','DESC')
            ->get();*/



     /*   $dataset_group = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')

            ->orderBy('emgroupinfo.groupId','DESC')
            ->get();*/

        if(!empty($datare['grouped_data_item'])){

            Session::put('grouped_selected_name', $datare['grouped_data_item']);

            $dataset_group = Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
            ->where('emdefinitionstable.dataItemName','=',$datare['grouped_data_item'])
            ->groupBy('emgroupinfo.groupName')
            ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
            ->get();

        }else{
            $dataset_group =DB::table('emgroupinfo')
                ->join('emgroupinfo_data', 'emgroupinfo.groupId', '=', 'emgroupinfo_data.group_id')
                ->join('emdefinitionstable', 'emdefinitionstable.definitionID', '=', 'emgroupinfo_data.reference_data_id')
                ->groupBy('emgroupinfo.groupId')
                ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
                ->get();


//            $dataset_group = Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
//                ->groupBy('emgroupinfo.groupName')
//                ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
//                ->get();
        }

        $dataset_group_nongroup =DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')

            ->whereNotIn('definitionID', function($q){
                $q->select('referenceDetailId')->from('emgroupinfo');
            })->get();

        $datatypegroup =DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->whereNotIn('definitionID', function($q){
                $q->select('referenceDetailId')->from('emgroupinfo');
            })->get();


        $table_selected_name = Session::get('table_selected_name');
        $database_selected_name = Session::get('database_selected_name');
        $dataitem_selected_name = Session::get('dataitem_selected_name');
        $mapped_selected_name = Session::get('mapped_selected_name');
        $grouped_selected_name = Session::get('grouped_selected_name');

        return view("dashboards.data-wizard", compact('data','csv_list','csv_list_activated','dditems',
            'definitions_data','start_time','end_time','csv_list_pending','pending_approval','approved',
            'approved_grouped','mapped_item','aeadatas','aeadatasdatabaelist','aeadatastablelist',
            'tab_id_wizard','dataset_group','dataset_group_nongroup','datatypegroup',
            'database_selected_name','table_selected_name','dataitemlist','dataitem_selected_name','mapped_selected_name',
            'grouped_selected_name','groupitemlist','groupitemlist_coded'));


    }

    /**
     * Show the form for creating a new resource.
     *
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

        $mimes = array('text/plain','text/csv','text/tsv');
        if(in_array($fileType,$mimes)){



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
                'status' => 1,
                'createdDate' => $created,

            );

            $csvinsert = CsvReferenca::insert($data);
            /*Check if the csv file upload sucessfully*/

            if($csvinsert){
                $csv_id = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId','DESC')->first();

                $fileD = fopen("media/uploads/$fileName","r");

                if ($fileD) {



                /*    $patient = new Definitions();
                    $patient::truncate();*/
                    $line = 0; // 1
                    $empty_value_found = false;
                    $incorrectrecords = 0; // 1
                    $correctrecords = 0;
                    $dataItemId =1;
                    $patient = new DefinitionsTemp();
                    $patient::truncate();
                    while ( ($value = fgetcsv($fileD)) !== false ) {

                        $columns = count($value);
                        if($columns==6){
                            if ($line > 0) { // 2
                                // Keep logic here to add to database, line 1 onwards

                                $dataItemName = $value[0];
                                $dataitemdescription = $value[1];
                                $codedValue = $value[2];
                                $codedValueType = $value[3];
                                $codedValueDescription = $value[4];
                                $createddate = $value[5];


                                if (empty($dataItemName)
                                    || empty($codedValueType)
                                ) {
                                    $empty_value_found = true;
                                    $errormsg="empty field please check";
                                    $csv_id_deleted = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId','DESC')->first();

                                    $datawiard_id = Definitions::select('referenceDetailId')->orderBy('referenceDetailId','DESC')->first();

                                    /*   Definitions::where('referenceDetailId', '=', $datawiard_id->referenceDetailId)->delete();
                                       CsvReferenca::where('conceptReferenceDataId', '=', $csv_id_deleted->conceptReferenceDataId)->delete();
                                     */ /* return $errormsg;
                                break; // stop our while-loop*/
                                    $incorrectrecords++;
                                }

                                else {


                                    $inserted_data=array(
                                        'referenceDetailId'=>$csv_id->conceptReferenceDataId,
                                        'dataItemName'=>strip_tags($dataItemName),
                                        'dataItemDescription'=>$dataitemdescription,
                                        'codedValue'=>strip_tags($codedValue),
                                        'codedValueType'=>strip_tags($codedValueType),
                                        'codedValueDescription'=>strip_tags($codedValueDescription),
                                        'dataItemId'=>"00000".$dataItemId,
                                        'dataItemVersionId'=>"1.00",
                                        'codedValueId'=>"00000".$dataItemId."."."001",
                                        'codedValueVersionId'=>"1.00",
                                        'author'=>$user_id,
                                        'createdDate'=>$created,
                                        'uploadedDate'=>$createddate

                                    );
                                    $correctrecords++;
                                    $dataItemId++;

                                    /*  Definitions::insert($inserted_data);*/
                                    DefinitionsTemp::insert($inserted_data);

                                }
                            }

                            $line++;

                        }else{

                            $datainfo = "Column Error";
                            return $datainfo;

                        }






                    }
                }


            $upload_msg="sucess";
            }

            $dataversion = DB::select("SELECT codedValue,dataItemName,count(dataItemName)
                FROM (
                SELECT codedValue, dataItemName FROM emdefinitionstable_temp
                UNION ALL
                SELECT codedValue,dataItemName FROM emdefinitionstable 
                ) tbl
                GROUP BY codedValue,dataItemName
                HAVING tbl.dataItemName in(select distinct(dataItemName) from  emdefinitionstable)");

            $count_data = count($dataversion);

            if($count_data>0){

                $versionsdata = "<div class=\"alert alert-success fade in alert-dismissable\" style=\"margin-top:18px;\">
								<strong id=\"recordscount\"><p style=\"text-align: justify\">There is a data item with the same name </p></strong>
									<button type=\"button\" class=\"btn btn-danger prev-step  next-step-mapping  replacedata\" >Replace</button>
									<button type=\"button\" class=\"btn btn-primary btn-info-full next-step-mapping dataset addnewdata\" data-dismiss=\"modal\">Add</button>
								</div>";

            }else{
                $versionsdata = "";
            }


            $data_additional =  Definitions::distinct()->select('dataItemName')->where('referenceDetailId','=',$csv_id->conceptReferenceDataId)->get();
            $dataitemid = 1;
            foreach($data_additional as $additionalinfo){

                $inserted_info=array(
                    'dataItemId'=>"00000".$dataitemid,
                    'codedValueId'=>"00000".$dataitemid."."."001",
                );

                Definitions::where('dataItemName', '=', $additionalinfo->dataItemName)->update($inserted_info);
                $dataitemid++;


            }


            $rec_count =  Definitions::orderBy('referenceDetailId','DESC')->count();

         /*   echo "<span>$rec_count Records Found</span>";*/

            $latestrecord = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId','DESC')->first();

            $rec_list=  Definitions::orderBy('referenceDetailId','DESC')
                ->where('referenceDetailId','=',$latestrecord->conceptReferenceDataId)->get();

             if($incorrectrecords>=1){
                 $qualityIssues="1";
             }else{
                 $qualityIssues="0";
             }

            $data = array(
                 'qualityIssues' => $qualityIssues,
                'qualityIssuesCount' => $incorrectrecords,


            );

            $fileinfo_qualitydata = CsvReferenca::where('conceptReferenceDataId','=',$csv_id->conceptReferenceDataId)->update($data);

            $datainfo = array('recordlist'=>$rec_list,
                              'incorrectdata'=>$incorrectrecords,
                              'totalrecords'=>$line-1,
                              'correctrecords'=>$correctrecords,
                              'versionscontrol' => $versionsdata,
            );




            return $datainfo;



        }

        }

        else {

            $datainfo = "Mime type error";




            return $datainfo;

        }


    }

    public function postReplaceData(Request $request){

        $data = $request->all();
        if(!empty($data['extradata'])){
            $additionalinfo = implode(" ",$data['extradata']);
        }else{
            $additionalinfo =null;

        }

        $dataversion = DB::select("SELECT `referenceDetailId` FROM (
                               SELECT  referenceDetailId,codedValue, codedValueType, codedValueDescription, dataItemName FROM emdefinitionstable
                               UNION ALL
                               SELECT  referenceDetailId,codedValue, codedValueType, codedValueDescription, dataItemName FROM emdefinitionstable_temp
                            ) t
                            GROUP BY dataItemName LIMIT 1
                            ");

        Definitions::where('referenceDetailId',$dataversion[0]->referenceDetailId)->delete();
        CsvReferenca::where('conceptReferenceDataId',$dataversion[0]->referenceDetailId)->delete();
        $info = DefinitionsTemp::all();
        foreach ($info as  $data) {

            $inserted_data=array(
                'referenceDetailId'=>$data->referenceDetailId,
                'dataItemName'=>$data->dataItemName,
                'codedValue'=>$data->codedValue,
                'dataItemDescription'=>$data->dataItemDescription,
                'codedValueType'=>$data->codedValueType,
                'codedValueDescription'=>$data->codedValueDescription,
                'dataItemId'=>$data->dataItemId,
                'dataItemVersionId'=>$data->dataItemVersionId,
                'codedValueId'=>$data->codedValueId,
                'codedValueVersionId'=>$data->codedValueVersionId,
                'additionalData'=>$additionalinfo,
                'author'=>$data->author,
                'createdDate'=>$data->createdDate,
                'uploadedDate'=>$data->uploadedDate,

            );
            Definitions::insert($inserted_data);

        }


    }

    public function postAddNewData(Request $request){
        $data = $request->all();
        if(!empty($data['extradata'])){
            $additionalinfo = implode(" ",$data['extradata']);
        }else{
            $additionalinfo =null;

        }


        $info = DefinitionsTemp::all();
        foreach ($info as  $data) {

            $inserted_data=array(
                'referenceDetailId'=>$data->referenceDetailId,
                'dataItemName'=>$data->dataItemName,
                'codedValue'=>$data->codedValue,
                'dataItemDescription'=>$data->dataItemDescription,
                'codedValueType'=>$data->codedValueType,
                'codedValueDescription'=>$data->codedValueDescription,
                'dataItemId'=>$data->dataItemId,
                'dataItemVersionId'=>$data->dataItemVersionId,
                'codedValueId'=>$data->codedValueId,
                'codedValueVersionId'=>$data->codedValueVersionId,
                'author'=>$data->author,
                'additionalData'=>$additionalinfo,
                'createdDate'=>$data->createdDate,
                'uploadedDate'=>$data->uploadedDate,

            );
            Definitions::insert($inserted_data);

        }
        echo "sucess";


    }

    public function postUpdateInfo(Request $request){

        $data = $request->all();

        $definitions_data =  Definitions::leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->orderBy('emdatawizard.datasetBelongs',' DESC')
            ->orderBy('emdefinitionstable.referenceDetailId',' DESC')
            ->get();

        $dditems =Dditems::all();
        $selected=[];
        return view("dashboards.definitionsdetails", compact('definitions_data','dditems','selected'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postWizardMappingData(Request $request){
        $data = $request->all();


        if(!empty($data['data_selected'])){
            $data_id = $data['data_selected'];
            $created = date("Y-m-d H:i:s");
            foreach($data_id as $info){
                $dataexist = Datawizard::where('referenceDetailId', '=',  $data_id)->first();

                $wizardinfo=array(
                    'referenceDetailId'=>$info,
                    'datasetBelongs'=>$data['dataset'],
                    'dataItem'=>$request->input('mappinginfo'),
                    'mappingInfo'=>$request->input('mappingdata'),
                    'mappingComments'=>$data['mappingcomments'],
                    'createdDate' => $created,

                );

                $uizardupdate=array(
                    'datasetBelongs'=>$data['dataset'],
                    'dataItem'=>$request->input('mappinginfo'),
                    'mappingInfo'=>$request->input('mappingdata'),
                    'mappingComments'=>$data['mappingcomments'],
                    'createdDate' => $created,

                );


                if(!empty($dataexist))
                {
                    Datawizard::where('referenceDetailId',$data_id)->update($uizardupdate);

                }
                else{
                    Datawizard::insert($wizardinfo);
                }


            }

        }else{
            echo "error";

        }


    }

    public function postWizardDataset(Request $request){
        $data = $request->all();


        if(!empty($data['data_selected'])){
            $data_id = $data['data_selected'];
            $created = date("Y-m-d H:i:s");

                $wizardinfo=array(
                    'referenceDetailId'=>$data_id,
                    'datasetBelongs'=>$data['dataset'],
                    'createdDate' => $created,

                );
                Datawizard::insert($wizardinfo);




        echo "<span class='text-success' style=' margin-left: 42%;'>Record Updated Sucessfully</span>";
        }else{
            echo "error";

        }






    }

    public function getDetails($id){


        $dataset = CsvReferenca::
        leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
            ->where('emdefinitionstable.referenceDetailId', $id)
            ->orderBy('emdefinitionstable.referenceDetailId','DESC')->get();


        return view("dashboards.wizard-details", compact('dataset'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postClearData(Request $request)
    {
        $csv_id_deleted = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId','DESC')->first();

        $datawiard_id = DefinitionsTemp::select('referenceDetailId')->orderBy('referenceDetailId','DESC')->first();

        DefinitionsTemp::where('referenceDetailId', '=', $datawiard_id->referenceDetailId)->delete();
        CsvReferenca::where('conceptReferenceDataId', '=', $csv_id_deleted->conceptReferenceDataId)->delete();
        return "sucess";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postSelectedData(Request $request){
        $data = $request->all();
        $data_id = $data['data_selected'];
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
            ->where('userId','=',$user_id)
            ->where('emconceptreferencedata.status','=',1)
            ->whereIn('emdefinitionstable.definitionID',$data_id)
            ->whereNotIn('definitionID', function($q){
                $q->select('referenceDetailId')->from('emgroupinfo');
            })->get();

        return $definitions_data;


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postTnrConnect(Request $request)
    {
        $data=$request->all();
        $created = date("Y-m-d H:i:s");
        $getid = DB::table('emtnrconnecteddata')->where('tnrDataId', '=', $data['tnr_id'])->get();

        if(!empty($getid)){
            $inserted_data=array(

                'dataLocalId'=>$data['data_item_id'],
                'tnrDataId'=>$data['tnr_id'],
                'tnrConnectStatus'=>1,
                'createdDate'=>$created,

            );

            DB::table('emtnrconnecteddata')->where('tnrDataId',$data['tnr_id'])->update($inserted_data);

        }else{

            $inserted_data=array(

                'dataLocalId'=>$data['data_item_id'],
                'tnrDataId'=>$data['tnr_id'],
                'tnrConnectStatus'=>1,
                'createdDate'=>$created,

            );
            DB::table('emtnrconnecteddata')->insert($inserted_data);

        }

        $approved_connected = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->leftjoin('emdatatypemapp', 'emdefinitionstable.definitionID', '=', 'emdatatypemapp.dataMappedId')
            ->leftjoin('emtnrconnecteddata', 'emdefinitionstable.definitionID', '=', 'emtnrconnecteddata.dataLocalId')
            ->where('emconceptreferencedata.status','=',1)
            ->where('emdefinitionstable.dataItemName', '<>', '')
            ->orderBy('emtnrconnecteddata.tnrConnectStatus','DESC')
            ->groupBy('emdefinitionstable.dataItemName')
            ->get();
        $k = 0;
        foreach ($approved_connected as $item) {
            echo "<tr class='stileone alternativecolor'>
                <td class='text-center'>0000$k</td>
                 <td class='text-center'>$item->dataItemName</td>";
                 if($item->tnrConnectStatus==1 && $item->tnrDataId==$data['tnr_id']){
                     echo "<td>
                      <span class='btn-primary btn'>Connected </span>
                    </td>
                    ";
                 }else{
                     echo"<td>
                      <span class=\"btn-primary btn connect-this-tnr \" data-id=\"$item->definitionID\">Connect </span>
                    </td>";

                 }

            $k++;

        }




    }


    public function getTnrConnectData(Request $request)
    {
        $data=$request->all();

        $tnrconnectdata =Aeadata::
             join('emtnrconnecteddata','emaeadatadefinition.tnrId','=','emtnrconnecteddata.tnrDataId')
            ->join('emdefinitionstable','emtnrconnecteddata.dataLocalId','=','emdefinitionstable.definitionID')
            ->orderBy('tnrConnectStatus','DESC')
            ->where('emtnrconnecteddata.tnrDataId','=',$data['data_item_id'])
            ->get();

        foreach ($tnrconnectdata as $aeadata) {
            echo "  <tr class=\"stileone alternativecolor\">

                                        <td class=\"text-left\">$aeadata->dataItemName</td>
                                        <td class=\"text-left\">$aeadata->codedValue</td>
                                        <td class=\"text-center\">$aeadata->codedValueDescription</td>
                                        <td class=\"text-center\">$aeadata->codedValueVersionId</td>
                                        <td class=\"text-center\">$aeadata->codedValueType</td>
                                   
               </tr>
";

        }



    }

    public function getSetTab(Request $request)
    {
        $data=$request->all();
        Session::put('data_tab_id_wizard', $data['data_tab_id']);
        echo "sucess";
        //
    }
    public function getHelp()
    {
        $help_database =   HelpModel::orderBy('helpTabName','ASC')->where('helpTabName','=','Databases')->get();
        $help_ae =   HelpModel::orderBy('helpTabName','ASC')->where('helpTabName','=','A&E')->get();
        $help_inpatient =   HelpModel::orderBy('helpTabName','ASC')->where('helpTabName','=','Inpatient')->get();
        $help_outpatient =   HelpModel::orderBy('helpTabName','ASC')->where('helpTabName','=','Outpatient')->get();

        return view("dashboards.help",compact('help_database','help_ae','help_inpatient','help_outpatient'));
    }

    public function getFilterTnr(Request $request)
    {

        $data = $request->all();


        if(!empty($data['database'])){
            Session::put('database_selected_name', $data['database']);
        }
        if(!empty($data['tablename'])){
            Session::put('table_selected_name', $data['tablename']);
        }

        if(!empty($data['searchvalue']) && !empty($data['tablename']) ) {
            $searchkey= $data['searchvalue'];
            $tablenames= $data['tablename'];

       /*     $aeadatas =Aeadata::
            leftjoin('emtnrconnecteddata','emaeadatadefinition.tnrId','=','emtnrconnecteddata.tnrDataId')
                ->leftjoin('emdefinitionstable','emtnrconnecteddata.dataLocalId','=','emdefinitionstable.definitionID')

                ->whereRaw(" `emaeadatadefinition`.`tnrItemName` LIKE '%$searchkey%' or 
                `emaeadatadefinition`.`tnrDataItemDescription` LIKE '%$searchkey%'
                or `emaeadatadefinition`.`dataType` LIKE '%$searchkey%' or `emaeadatadefinition`.`required` LIKE '%$searchkey%'
                or `emaeadatadefinition`.`isDerivedItem` LIKE '%$searchkey%' ")
                ->where('emaeadatadefinition.tableName','=',$data['tablename'])
                ->get();*/

            $aeadatas =   DB::select("select * from `emaeadatadefinition` left join `emtnrconnecteddata` on 
                `emaeadatadefinition`.`tnrId` = `emtnrconnecteddata`.`tnrDataId` left join `emdefinitionstable` 
                on `emtnrconnecteddata`.`dataLocalId` = `emdefinitionstable`.`definitionID`
                 where(`emaeadatadefinition`.`tnrItemName` LIKE '%$searchkey%' or
                `emaeadatadefinition`.`tnrDataItemDescription` LIKE '%$searchkey%'
                or `emaeadatadefinition`.`dataType` LIKE '%$searchkey%' or `emaeadatadefinition`.`required`
                 LIKE '%$searchkey%'
                or `emaeadatadefinition`.`isDerivedItem` LIKE '%$searchkey%' ) 
                and `emaeadatadefinition`.`tableName` = '$tablenames' ");

        }else{

            if(!empty($data['tablename'])){
                Session::put('table_selected_name', $data['tablename']);

                $aeadatas =Aeadata::
                leftjoin('emtnrconnecteddata','emaeadatadefinition.tnrId','=','emtnrconnecteddata.tnrDataId')
                    ->leftjoin('emdefinitionstable','emtnrconnecteddata.dataLocalId','=','emdefinitionstable.definitionID')

                    ->orderBy('tnrConnectStatus','DESC')
                    ->where('tableName','=',$data['tablename'])
                    ->get();

            }elseif(!empty($data['database'])){

                Session::put('database_selected_name', $data['database']);
                $aeadatas =Aeadata::
                leftjoin('emtnrconnecteddata','emaeadatadefinition.tnrId','=','emtnrconnecteddata.tnrDataId')
                    ->leftjoin('emdefinitionstable','emtnrconnecteddata.dataLocalId','=','emdefinitionstable.definitionID')
                    ->where('dataBaseName','=',$data['database'])
                    ->orderBy('tnrConnectStatus','DESC')

                    ->get();
            }else{
                $aeadatas =Aeadata::
                leftjoin('emtnrconnecteddata','emaeadatadefinition.tnrId','=','emtnrconnecteddata.tnrDataId')
                    ->leftjoin('emdefinitionstable','emtnrconnecteddata.dataLocalId','=','emdefinitionstable.definitionID')
                    ->orderBy('tnrConnectStatus','DESC')
                    ->get();
            }

        }




        foreach($aeadatas as $aeadata){
            echo " <tr class=\"stileone\">

                                            <td class=\"text-center \"><span
                                                        class=\"boldtext\">$aeadata->dataBaseName</span>
                                                <br>";
                                                if(!empty($aeadata->tableName)){
                                                    echo "<span class=\"extracolumn\"></span><br>
                                                    $aeadata->tableName ";
                                               }else{
                                                    echo "<span class=\"extracolumn\">-</span><br>";
                                               }

                                           echo" </td>

                                            <td class=\"text-center \">
                                                <span class=\"boldtext\">$aeadata->tnrItemName</span>
                                                <br>";
                                                if(!empty($aeadata->tnrDataItemDescription)){
                                                    echo"<span class=\"extracolumn\"></span><br>
                                                    $aeadata->tnrDataItemDescription ";
                                                }else{
                                                    echo"<span class=\"extracolumn\">-</span><br>";
                                               }

                                            echo"</td>

                                            <td class=\"text-center\">$aeadata->dataType</td>


                                            <td class=\"text-center\">$aeadata->isDerivedItem<br>";
                                                if(!empty($aeadata->derivationMethodology)){
                                                    echo "<span class=\"extracolumn\"></span><br>
                                                    $aeadata->derivationMethodology";
                                                    }
                                                else{
                                                    echo"<span class=\"extracolumn\">-</span><br>";
                                                }
                                            echo"</td>


                                            <td class=\"text-center\">$aeadata->authorName
                                                <br>$aeadata->createdDate
                                            </td>


                                            <td class=\"text-center\">";

                                                if(!empty($aeadata->dataDictionaryName)){

                                                    echo "$aeadata->dataDictionaryName}} <br>";
                                                }else{
                                                    echo"<span class=\"extracolumn\">-</span><br>";
                                                }
                                                if (filter_var($aeadata->dataDictionaryLinks, FILTER_VALIDATE_URL) !== false){

                                                   echo" <a target=\"_blank\" class=\"extracolumn\"
                                                       href=\"$aeadata->dataDictionaryLinks\">Link</a>";
                                                }




                                           echo"</td>";
                                            if(!empty($aeadata->codeTbc)){
                                                echo"<td class=\"text-center details-control\"
                                                    data-item-name=\"$aeadata->dataItemName\"
                                                    id=\"$aeadata->tnrId\"><span
                                                            class=\"btn btn-primary btn-sm showhidedataitemstnr\"
                                                            data-item-name=\"$aeadata->dataItemName\"
                                                            id=\"$aeadata->tnrId\">Show</span></td>";
                                            }else{
                                                echo"<td class=\"text-center\">$aeadata->codeTbc
                                                    <br>$aeadata->codeDescriptionTbc
                                                </td>";

                                           }

                                            echo"<td class=\"text-center\">";

                                                if($aeadata->tnrConnectStatus==1){
                                                    echo"<span class=\"btn-primary btn tnr-dataconnection-result\"
                                                          data-tnrid=\"$aeadata->tnrId\">Show </span>";

                                                }else{
                                                    echo"<span class=\"btn-primary btn tnr-dataconnection\"
                                                          data-name=\"$aeadata->tnrItemName\"
                                                          data-tnrid=\"$aeadata->tnrId\">Reference Data Item  </span>";
                                               }

                                            echo"</td>
                                            <td class=\"text-center\">
                                                
                                            </td>



                                        </tr>";

        }


    }

    public function datatype_code($str)
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

    public function  getReferenceFilter(Request $request)
    {
        $datare = $request->all();
        if(!empty($datare['dataitemname'])){
            Session::put('dataitem_selected_name', $datare['dataitemname']);
            $approved = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('emdatatypemapp', 'emdefinitionstable.definitionID', '=', 'emdatatypemapp.dataMappedId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('emconceptreferencedata.status','=',1)
                /* ->where('emdefinitionstable.mappedCodedComplete','=',0)*/
                ->where('emdefinitionstable.dataItemName', '<>', '')
                ->where('emdefinitionstable.dataItemName','=',$datare['dataitemname'])
                ->orderBy('emdefinitionstable.isMapped','DESC')
                ->groupBy('emdefinitionstable.dataItemName')
                ->get();


        }else{

            $approved = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('emdatatypemapp', 'emdefinitionstable.definitionID', '=', 'emdatatypemapp.dataMappedId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('emconceptreferencedata.status','=',1)
                /* ->where('emdefinitionstable.mappedCodedComplete','=',0)*/
                ->where('emdefinitionstable.dataItemName', '<>', '')
                ->orderBy('emdefinitionstable.isMapped','DESC')
                ->groupBy('emdefinitionstable.dataItemName')
                ->get();

        }

        foreach($approved as $approved_data){

            echo"  <tr class='stileone alternativecolor'>
                                            <td class=\"text-left \">$approved_data->dataItemName</td>
                                            <td class=\"text-left\">$approved_data->dataItemDescription</td>
                                            <td class=\"text-center\">$approved_data->datasetBelongs</td>";

                                            if($approved_data->datatypeMapStatus==1){
                                                $datatype= $this->datatype_code(current(explode(' ',$approved_data->dataTypeMapName)));

                                               echo" <td class=\"text-center\">$datatype</td>";
                                            }else{
                                                $codedvalue=$this->datatype_code(current(explode(' ',$approved_data->codedValueType)));
                                                echo"<td class=\"text-center\">$codedvalue</td>";
                                            }

                                            echo"<td class=\"text-center\">";
                                                if (filter_var($approved_data->sharePointLink, FILTER_VALIDATE_URL) !== false){
                                                    echo"<a target=\"_blank\"
                                                       href=\"$approved_data->sharePointLink\">$approved_data->sharePointLink</a>";
                                                }else{
                                                    echo "$approved_data->sharePointLink ";
                                                }


                                           echo"</td>";



                                            if(!empty($approved_data->codedValueDescription)){
                                                echo"<td class=\"text-center details-control\"  
                                                data-item-name=\"$approved_data->dataItemName\"
                                                 id=\"$approved_data->definitionID\"><span
                                                            class=\"btn btn-primary btn-sm showhidedataitems\"
                                                            data-item-name=\"$approved_data->dataItemName\"
                                                            id=\"$approved_data->definitionID\">Show</span></td>";
                                            }else{
                                                echo"<td class=\"text-center\"></td>";
                                            }





                                                echo"<td class=\"text-center invisible-data\">$approved_data->codedValue</td>
                                                <td class=\"text-center invisible-data\">$approved_data->codedValueDescription</td>
                                                <td class=\"text-center invisible-data\">$approved_data->dataItemId</td>
                                                <td class=\"text-center invisible-data\">$approved_data->dataItemVersionId</td>
                                                <td class=\"text-center invisible-data\">$approved_data->codedValueId</td>
                                                <td class=\"text-center invisible-data\">$approved_data->codedValueVersionId</td>
                                                <td class=\"text-center invisible-data\">$approved_data->username</td>
                                           
                                            <td class=\"text-center\" style=\"width: 106px;\">";
                                                if($approved_data->isMapped==1) {
                                                    echo "<span>

                                                    <a href=\"javascript:void(0)\">
                                                        <span class=\" btn mapping_details_info\"
                                                              style=\"border:1px solid #2e6da4\"
                                                              data-ref-id=\"$approved_data->referenceDetailId\"
                                                              data-item-name=\"$approved_data->dataItemName\">Mapped</span>
                                                    </a>

                                                   </span>";

                                                }else {
                                                    echo "<span>

                                                    <a href=\"javascript:void(0)\"><span
                                                                class=\"mappingdatabutton  btn-primary btn check-map check_$approved_data->definitionID\"
                                                                data-reference=\"$approved_data->definitionID\"
                                                                data-itemname=\"$approved_data->dataItemName\"
                                                                >Map</span></a>

                                                   </span>";


                                                }
                                            echo"</td>


                                        </tr>";
        }

    }

    public function  getMappingFilter(Request $request)
    {

        $datare = $request->all();


        if(!empty($datare['mapping_data_item'])){
            Session::put('mapped_selected_name', $datare['mapping_data_item']);
            $mapped_item = CsvReferenca::
            leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->join('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('emdatawizard.status','=',1)
                ->where('emdefinitionstable.mappedCodedStatus','=',1)
                ->where('emdefinitionstable.dataItemName','=',$datare['mapping_data_item'])
                ->orderBy('emdefinitionstable.referenceDetailId','DESC')
                ->get();
        }else{
            $mapped_item = CsvReferenca::
            leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->join('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('emdatawizard.status','=',1)
                ->where('emdefinitionstable.mappedCodedStatus','=',1)
                ->orderBy('emdefinitionstable.referenceDetailId','DESC')
                ->get();

        }

        foreach ($mapped_item as $mapped){
            echo "<tr class=\"stileone alternativecolor\">

                                            <td class=\"text-center\">$mapped->dataItemName</td>";

                                            if($mapped->dataItem=="Local"){
                                                echo"<td class=\"text-center\"></td>";

                                            }else{
                                                if(!empty($mapped->codedValue)){
                                                    echo"<td class=\"text-center\"><span
                                                                data-national=\"$mapped->mappingInfo\"
                                                                data-item=\"$mapped->dataItemName\"
                                                                class=\"btn btn-primary btn-sm oneormoremappingfinal showhidedata\"
                                                                data-item-name=\"$mapped->dataItemName\"
                                                                id=\"$mapped->definitionID\">Show</span></td>";
                                                }else{
                                                    echo"<td class=\"text-center\"></td>";
                                                }
                                            }


                                            echo"<td class=\"text-center\"><span class=\"btn  \"
                                                                          style=\"border:1px solid #2e6da4\">Mapped To</span>
                                            </td>


                                      
                                                <td class=\"text-center invisible-data\">$mapped->codedValue</td>
                                                <td class=\"text-center invisible-data\">$mapped->codedValueDescription</td>
                                                <td class=\"text-center invisible-data\">$mapped->dataItemId</td>
                                                <td class=\"text-center invisible-data\">$mapped->dataItemVersionId</td>
                                                <td class=\"text-center invisible-data\">$mapped->codedValueId</td>
                                                <td class=\"text-center invisible-data\">$mapped->codedValueVersionId</td>
                                                <td class=\"text-center invisible-data\">$mapped->username</td>";


                                            if($mapped->dataItem=="Local"){
                                                echo"<td class=\"text-center\"><span class=\"btn  btn-primary\">Local</span></td>";

                                            }else{
                                                echo"<td class=\"text-center\">$mapped->mappingInfo</td>";
                                            }


                                        echo"</tr>";
        }

    }

    public function getGroupingFilter(Request $request){
        $datare = $request->all();
        if(!empty($datare['grouped_data_item'])){
            Session::put('grouped_selected_name', $datare['grouped_data_item']);
            $dataset_group = Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
                ->where('emgroupinfo.groupName','=',$datare['grouped_data_item'])
                ->groupBy('emgroupinfo.groupName')
                ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
                ->get();
        }else{
            $dataset_group = Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
                ->groupBy('emgroupinfo.groupName')
                ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
                ->get();

        }


        foreach ($dataset_group as $data){
            echo " <tr class=' stileone'>


                                            <td class='text-center'>$data->groupName</td>";
                                            if($data->groupType=="coded"){
                                                echo"<td class='text-center'>Coded Value</td>";
                                            }else{
                                                echo"<td class='text-center'>Data Item</td>";
                                            }
                                            echo"<td class='text-center'>0000$data->groupId</td>


                                            <td class=\"text-center \">";
                                                if($data->groupStatus==1){
                                                   echo"<a class=\"btn btn-small btn-primary btn-sm groupingfilter showhidegroupdata\"
                                                       data-status=\"approved\" data-type=\"$data->groupType\" data-patientid=\"$data->groupName\"
                                                       id=\"$data->groupId\" href=\"javascript:void(0)\">Show</a>";
                                                }else{
                                                    echo"<a class=\"btn btn-small btn-primary btn-sm groupdatabutton\"
                                                       data-status=\"approved\" href=\"javascript:void(0)\">Create Group</a>";
                                                }

                                            echo"</td>

                                        </tr>";
        }
    }



    public function getSearchHistory(Request $request){
        $data = $request->all();

        $mapped_item = CsvReferenca::
        leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->join('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
            ->where('emdatawizard.status','=',1)
            ->where('emdefinitionstable.mappedCodedStatus','=',1)
            ->where('emdefinitionstable.dataItemName','LIKE', $data['searchvalue'] . '%')
            ->orderBy('emdefinitionstable.referenceDetailId','DESC')
            ->get();

        $dataset_group = Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
            ->where('emdefinitionstable.dataItemName','LIKE', $data['searchvalue'] . '%')
            ->groupBy('emgroupinfo.groupName')
            ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
            ->get();

        $approved = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->leftjoin('emdatatypemapp', 'emdefinitionstable.definitionID', '=', 'emdatatypemapp.dataMappedId')
            ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
            ->where('emconceptreferencedata.status','=',1)
            /* ->where('emdefinitionstable.mappedCodedComplete','=',0)*/
            ->where('emdefinitionstable.dataItemName', '<>', '')
            ->where('emdefinitionstable.dataItemName','LIKE', $data['searchvalue'] . '%')
            ->orderBy('emdefinitionstable.isMapped','DESC')
            ->groupBy('emdefinitionstable.dataItemName')
            ->get();

        $baseurl =url("/dashboard/data-wizard");
        $baseurlgrouping =url("/dashboard/data-wizard");
        echo"<div class='col-md-12'>";


        foreach($approved as $approveddata){
            $urlsearch = url("/dashboard/data-wizard?data_item=$approveddata->dataItemName");
            echo "<div class='row col-md-12' style='margin-top: 30px;'>
                      <div class='searchhistorydata ' >
                              <a href='$urlsearch' id='search_reference'>  
                           <span class=\"search-title\" > Reference Data</span></a><br>
                        
                            <span class=\"search-para\">Data Item : $approveddata->dataItemName</span>
                            <span class=\"search-para\">Coded Value : $approveddata->codedValueDescription</span>
                      </div>
                     
                    </div>";

        }

        foreach($mapped_item as $data){
            $urlsearch = url("/dashboard/data-wizard?mapping_data_item=$data->dataItemName");
                 echo "<div class='row col-md-12' style='margin-top: 30px;'>
                      <div class='searchhistorydata ' >
                              <a href='$urlsearch' id='search_mapping'>  
                           <span class=\"search-title\" > Mapping</span></a><br>
                          
                            <span class=\"search-para\">Data Item : $data->dataItemName</span>
                            <span class=\"search-para\">Coded Value : $data->codedValueDescription</span>
                      </div>
                     
                    </div>";

        }

        foreach($dataset_group as $groupitem){
            $urlgroup = url("/dashboard/data-wizard?grouped_data_item=$groupitem->dataItemName");
            echo "<div class='row col-md-12' style='margin-top: 30px;'>
                      <div class='searchhistorydata' >
                              <a href='$urlgroup' id= 'search_grouping'>  
                           <span class=\"search-title\" > Grouping</span></a><br>
                         
                            <span class=\"search-para\">Data Item : $groupitem->dataItemName</span>
                            <span class=\"search-para\">Coded Value : $groupitem->codedValueDescription</span>
                      </div>
                     
                    </div>";

        }

    echo"</div>";

    }




}
