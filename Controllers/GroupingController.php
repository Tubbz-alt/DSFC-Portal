<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Definitions;
use App\Models\Dditems;
use Sentinel;
use Validator;
use Input;
use DB;
use App\Models\Datawizard;
use App\Models\CsvReferenca;
use App\Models\Groupinginfo;

class GroupingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $latestrecord = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId','DESC')->first();
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        if($user->inRole('administrator')) {
            $definitions_data = DB::table('emdefinitionstable')
                ->whereNotIn('definitionID', function ($q) {
                    $q->select('referenceDetailId')->from('emgroupinfo');
                })->get();


            $grouped_data = Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')

                ->where('emgroupinfo.groupStatus', '=', 1)
                ->groupBy('emgroupinfo.localPatientID')
                ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
                ->get();


            $grouped_pending = Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')

                ->where('emgroupinfo.groupStatus', '=', 0)
                ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
                ->groupBy('emgroupinfo.localPatientID')
                ->get();
        }else{

            $definitions_data = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('userId','=',$user_id)
                ->whereNotIn('definitionID', function($q){
                    $q->select('referenceDetailId')->from('emgroupinfo');
                })->get();

            $grouped_data = CsvReferenca::
            leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('userId','=',$user_id)
                ->where('emgroupinfo.groupStatus','=',1)
                ->groupBy('emgroupinfo.localPatientID')
                ->orderBy('emdefinitionstable.referenceDetailId','DESC')
                ->get();

            $grouped_pending = CsvReferenca::
            leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('userId','=',$user_id)
                ->where('emgroupinfo.groupStatus','=',0)
                ->groupBy('emgroupinfo.localPatientID')
                ->orderBy('emdefinitionstable.referenceDetailId','DESC')
                ->get();



        }

        $dditems =Dditems::all();
        $selected=[];

        return view('dashboards.grouping',compact('definitions_data','dditems','selected','grouped_data','grouped_pending'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postGroupData(Request $request){
        $data = $request->all();


        $data_id = $data['groupdata'];


        if(!empty($data['groupdata'])){
            $data_id = $data['groupdata'];
            $created = date("Y-m-d H:i:s");
            foreach($data_id as $info){


                $dataexist = Groupinginfo::where('referenceDetailId', '=',  $data_id)
                    ->where('emgroupinfo.groupType', '=','DataType')->first();


                if(!empty($dataexist))
                {
                    $groupinfoupdate=array(
                        'localPatientID'=>$request->input('patientid'),
                        'groupName'=>$request->input('groupname'),
                        'sex'=>$request->input('sex'),
                        'addressFormatCode'=>$request->input('addressformatcode'),
                        'createdDate' => $created,
                        'groupStatus' => 1,
                        'groupType' => "DataType ",

                    );

                    Groupinginfo::where('referenceDetailId',$data_id)->update($groupinfoupdate);

                }
                else{
                    $groupinfo=array(
                        'referenceDetailId'=>$info,
                        'localPatientID'=>$request->input('patientid'),
                        'groupName'=>$request->input('groupname'),
                        'sex'=>$request->input('sex'),
                        'addressFormatCode'=>$request->input('addressformatcode'),
                        'createdDate' => $created,
                        'groupStatus' => 1,
                        'groupType' => "DataType",

                    );

                    Groupinginfo::insert($groupinfo);
                }


            }

        }else{
            echo "error";

        }



    }


    public function postGroupDataCoded(Request $request){
        $data = $request->all();

        $data_id = $data['groupdata'];




        if(!empty($data['groupdata'])){
            $data_id = $data['groupdata'];
            $created = date("Y-m-d H:i:s");
            foreach($data_id as $info){
                $codetype="coded";


                $dataexists = Groupinginfo::where('referenceDetailId', '=',  $data_id)
                    ->where('emgroupinfo.groupType','=',$codetype)->first();

                if(!empty($dataexists))
                {

                    $groupinfoupdatec=array(
                        'localPatientID'=>$request->input('patientid'),
                        'groupName'=>$request->input('groupname'),
                        'sex'=>$request->input('sex'),
                        'addressFormatCode'=>$request->input('addressformatcode'),
                        'createdDate' => $created,
                        'groupStatus' => 1,
                        'groupType' => "coded",

                    );

                    Groupinginfo::where('referenceDetailId',$data_id)->update($groupinfoupdatec);

                }
                else{

                    $groupinfoc=array(
                        'referenceDetailId'=>$info,
                        'localPatientID'=>$request->input('patientid'),
                        'groupName'=>$request->input('groupname'),
                        'sex'=>$request->input('sex'),
                        'addressFormatCode'=>$request->input('addressformatcode'),
                        'createdDate' => $created,
                        'groupStatus' => 1,
                        'groupType' => "coded",

                    );

                    Groupinginfo::insert($groupinfoc);
                }


            }

        }else{
            echo "error";

        }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInfo()
    {
        $latestrecord = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId','DESC')->first();

        if(!empty($latestrecord)){
            $definitions_data =  Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
                ->where('emdefinitionstable.referenceDetailId','=',$latestrecord->conceptReferenceDataId)
                ->orderBy('emdefinitionstable.referenceDetailId',' DESC')
                ->groupBy('emgroupinfo.referenceDetailId')
                ->get();
        }else{
            $definitions_data =  Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
                ->orderBy('emdefinitionstable.referenceDetailId',' DESC')
                ->groupBy('emgroupinfo.referenceDetailId')
                ->get();
        }

        $dditems =Dditems::all();
        $selected=[];

        return view('dashboards.groupinginfo',compact('definitions_data','dditems','selected'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getGroupFilter(Request $request)
    {
        $data = $request->all();
        if($data['status']=="pending"){
            $grouped_pending =  Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
                ->where('emgroupinfo.groupStatus','=',0)

                ->where('emgroupinfo.groupName','=',$data['localPatientID'])
                ->orderBy('emdefinitionstable.referenceDetailId',' DESC')
                ->groupBy('emgroupinfo.referenceDetailId')
                ->get();
        }else{
            $grouped_pending =  Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
                ->where('emgroupinfo.groupStatus','=',1)

                ->where('emgroupinfo.groupName','=',$data['localPatientID'])
                ->orderBy('emdefinitionstable.referenceDetailId',' DESC')
                ->groupBy('emgroupinfo.referenceDetailId')
                ->get();


        }

        if($data['type']=="DataType"){
            echo'<div class="container" style="text-align: center">
            <table  class="table definitions-table" style="display: inline-block;text-align: center;width: 10%"><tr class="additionaldata"> <td class="invisible-data-final " colspan="11" id="group_data_hidden_'.$data['localPatientID'].'" align="center">
         <div class="table  table-striped table-bordered  horizontal_scroll " style="width: 79%;">
               <tr style="background-color: #979797; color:white;">
            <th class="text-center">Data Item</th>
           
            </tr>';
            foreach($grouped_pending as $data){
                echo "<tr class='stileone'> 
                   	<td class=\"text-center\"> $data->dataItemName</td>
						
							
							
                </tr>";
            }
            echo'</div> </td></tr></table></div>';

        }else{
            echo'<div class="container text-center" style="text-align: center">
            <table class="table definitions-table" style="display: inline-block;text-align: center;width: 50%"><tr class="additionaldata"> <td class="invisible-data-final " colspan="11" id="group_data_hidden_'.$data['localPatientID'].'" align="center">
         <div class="table  table-striped table-bordered  horizontal_scroll " style="width: 79%;">
               <tr style="background-color: #979797; color:white;">
          
            <th class="text-center">Coded Value</th>
             <th class="text-center">Coded Value Description</th>
            </tr>';
            foreach($grouped_pending as $data){
                echo "<tr class='stileone'> 
                 
							<td class=\"text-center\"> $data->codedValue</td>
							<td class=\"text-center\"> $data->codedValueDescription</td>
							
							
                </tr>";
            }
            echo'</div> </td></tr></table></div>';

        }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postSelectedData(Request $request){
        $data = $request->all();

        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->where('emconceptreferencedata.status','=',1)
            ->whereNotIn('definitionID', function($q){
                $q->select('referenceDetailId')->from('emgroupinfo')
                    ->where('emgroupinfo.groupType', '=', 'DataType');
            }) ->groupBy('emdefinitionstable.dataItemName')->get();

        return $definitions_data;


    }

    public function postSelectedDataCoded (Request $request){
        $data = $request->all();

        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->where('emconceptreferencedata.status','=',1)
            ->where('emdefinitionstable.codedValue', '<>','')
            ->whereNotIn('definitionID', function($q){
                $q->select('referenceDetailId')
                    ->from('emgroupinfo')
                    ->where('emgroupinfo.groupType', '=', 'coded');
            })->get();

        return $definitions_data;


    }

    public function postSelectedDataCodedFilter (Request $request){
        $data = $request->all();

        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;

        if($data['mapping_status'] == '')
        {
            $definitions_data = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->where('emconceptreferencedata.status','=',1)
                ->where('emdefinitionstable.codedValue', '<>','')
                ->whereNotIn('definitionID', function($q){
                    $q->select('referenceDetailId')
                        ->from('emgroupinfo')
                        ->where('emgroupinfo.groupType', '=', 'coded');
                })->get();
            return $definitions_data;
        }

        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->where('emconceptreferencedata.status','=',1)
            ->where('emdefinitionstable.codedValue', '<>','')
            ->where('emdefinitionstable.dataItemName', '=',$data['mapping_status'])
            ->whereNotIn('definitionID', function($q){
                $q->select('referenceDetailId')
                    ->from('emgroupinfo')
                    ->where('emgroupinfo.groupType', '=', 'coded');
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
    public function destroy($id)
    {
        //
    }
}
