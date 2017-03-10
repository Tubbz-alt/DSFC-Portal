<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CsvReferenceDetails;
use App\Models\Comments;
use App\Models\Definitions;
use App\Models\Dditems;
use Sentinel;
use Validator;
use Input;
use DB;
use App\Models\Datawizard;
use App\Models\CsvReferenca;
use App\Models\Mappedcoded;

class MappingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;
        $latestrecord = CsvReferenca::select('conceptReferenceDataId')
            ->orderBy('conceptReferenceDataId','DESC')->first();

        if($user->inRole('administrator')){
            $definitions_data = DB::table('emdefinitionstable')
                ->whereNotIn('definitionID', function($q){
                    $q->select('referenceDetailId')->from('emdatawizard');
                })->get();


            $pending_approval =  Definitions::orderBy('emdefinitionstable.referenceDetailId','DESC')
                ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->where('emdatawizard.status','=',0)
                ->get();


            $mapped_item =  Definitions::orderBy('emdefinitionstable.referenceDetailId','DESC')
                ->join('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->where('emdatawizard.status','=',1)
                ->get();
        }else{

            $definitions_data = DB::table('emconceptreferencedata')
             ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
             ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
             ->where('userId','=',$user_id)
             ->whereNotIn('definitionID', function($q){
                    $q->select('referenceDetailId')->from('emdatawizard');
                })->get();

            $pending_approval = CsvReferenca::
                 leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('userId','=',$user_id)
                ->where('emdatawizard.status','=',0)
                ->orderBy('emdefinitionstable.referenceDetailId','DESC')->get();

            $mapped_item = CsvReferenca::
            leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
                ->where('userId','=',$user_id)
                ->where('emdatawizard.status','=',1)
                ->orderBy('emdefinitionstable.referenceDetailId','DESC')->get();




        }


        $dditems =Dditems::all();
        $selected=[];

        return view('dashboards.mapping',compact('definitions_data','dditems','selected','pending_approval','mapped_item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postWizardData(Request $request){
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
            ->whereIn('emdefinitionstable.definitionID',$data_id)
            ->get();

        return $definitions_data;


    }




    public function postSelectedDataMoremapping(Request $request){
        $data = $request->all();
        $data_id = $data['data_selected'];
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;


        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
            ->leftjoin('emmappedcoded','emdefinitionstable.definitionID','=','emmappedcoded.localDataId')
            ->where('dataItemName','=',$data['data_item'])
            ->whereNotIn('definitionID', function($q){
                $q->select('localDataId')->from('emmappedcoded');
            })->get();



        if(!empty($data['nationalvalue'])){
            $nationalstatus="datafound";
            $datanational=$data['nationalvalue'];

            $national_codes = DB::table('emnationalcodedvalues')
                ->where('emnationalcodedvalues.ddItemName', 'LIKE', '%'.$data['nationalvalue'].'%')
               /* ->leftjoin('emmappedcoded','emnationalcodedvalues.codedValueId','=','emmappedcoded.nationaldataId')*/
                ->orderBy('ddItemCodeText','ASC')
                ->groupBy('emnationalcodedvalues.ddItemCodeText')
                /*->whereNotIn('codedValueId', function($q){
                    $q->select('nationaldataId')->from('emmappedcoded');
                })*/->get();
        }else{
            $nationalstatus="nodatafound";
            $national_codes = "";

        }







        echo "<tr>
               <td class='text-center localtablehidden'>
                  <table class=\"table  table-striped table-bordered definitions-table horizontal_scroll\">
               <tr >
                    <th class=\"text-center\">Coded Value  </th>
                    <th class=\"text-center\">Data Item  </th>
                    <th class=\"text-center\">Coded Value Description </th>
                 <!--   <th class=\"text-center\"> </th>-->
                    <th class=\"text-center\"> </th>
               </tr>";

                if(!empty($definitions_data)){
                    foreach($definitions_data as $data) {
                        echo "<input type='hidden' name='selectedlocalvalue[]' value='$data->definitionID' >";


                            echo "<tr class='localtable strlone'>";




                        echo "<td class='text-center'>$data->codedValue</td>
                                <td class='text-center'>$data->dataItemName</td>
                            <td class='text-center' >$data->codedValueDescription</td>";
                        if($data->mappedCodedStatus==1){
                            echo "<td></td> ";

                        }
                        else{
                            echo "<td>
                              <input class='localchecked' id='localcheck_$data->definitionID' type='checkbox' name='selectedlocalvalue[]' value='$data->definitionID' >
                              </td>";

                        }

                        echo"<td class='text-center'> 
							  <span>

                               <a href='javascript:void(0)'>";
                        if($data->mappedCodedStatus==1) {
                            echo "  <span class='btn'  style='border: 1px solid #0099cc;'>Mapped To</span>";
                        }else{
                            echo "  <span data-nationalname='$datanational' data-localname='$data->dataItemName' data-id='$data->definitionID' class='btn local_national_mapping' style='border: 1px solid #0099cc;'>Map</span>";

                        }
                        echo"</a>

                               </span>
                               
                            </td>
                           </tr>";

                    }
                }else{
                    echo "<tr >
                        <td class='text-center' colspan='2'>No Record Found For Mapping</td>
                        
                         </tr>
                    ";
                }



                 echo "</table>
                       </td>
                  <td class='text-center nationaltable'>
                    <table class=\"table  table-striped table-bordered definitions-table horizontal_scroll national-table\">
               <tr >
                 <th></th>
                  <th class=\"text-center\">Coded Value  </th>
                   <th class=\"text-center\">Coded Value Description </th>
                  
               </tr>";

            if($nationalstatus=="datafound"){
                foreach($national_codes as $nat) {
                    echo

                        "<tr class='nationaltable'>";



                        echo "<td> 
                                    <input type='radio' name='selectednationalvalue' value='$nat->codedValueId' >
                                </td>";




                        echo "<td class='text-center' data-national-coded='$nat->ddItemCodeText'>$nat->ddItemCodeText</td>
                         <td class='text-center' data-national-desc='$nat->ddItemCodeText'>$nat->ddCodedValueDescription</td>
                         </tr>
                    ";
                }

            }else{

                    echo "<tr>
                        <td class='text-center' colspan='2'>No Record Found</td>
                        
                         </tr>
                    ";


            }



              echo "</table>
          </td>
         </tr>";











    }


    public function postSelectedDataMoremappingFinal(Request $request){
        $data = $request->all();

        $dataItem_from_sql = $data['data_item'];
        $dataItem_value_sql = $data['nationalvalue'];
        $data_id = $data['data_selected'];
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;


        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
            ->leftjoin('emmappedcoded','emdefinitionstable.definitionID','=','emmappedcoded.localDataId')
            ->where('dataItemName','=',$data['data_item'])
            ->get();



        if(!empty($data['nationalvalue'])){
            $nationalstatus="datafound";
            $datanational=$data['nationalvalue'];

            $national_codes = DB::table('emnationalcodedvalues')
                ->where('emnationalcodedvalues.ddItemName', 'LIKE', '%'.$data['nationalvalue'].'%')
                ->join('emmappedcoded','emnationalcodedvalues.codedValueId','=','emmappedcoded.nationaldataId')
                ->orderBy('ddItemCodeText','ASC')
                ->groupBy('emmappedcoded.mappedColor')
                ->get();

              
        }else{
            $nationalstatus="nodatafound";
            $national_codes = "";

        }

        // dd($national_codes);

        $sql_mapp_code= array();
        $sql_mapp_value = array();
        if(!empty($definitions_data ) && !empty($national_codes))
        {
          foreach ($definitions_data as $definition) 
          {
              $sql_mapp_value[] = $definition->codedValue;
            // print($definition->codedValue);
          }
         
          
          foreach ($national_codes as $national) 
          {

            $sql_mapp_code[] = $national->ddItemCodeText;
          }
        }

        else{

        }
 

        echo'<div class="container" style="text-align: center">
<table style="display: inline-block;text-align: center;"><tr class="additionaldata ">
<td class="invisible-data-final " colspan="11" id="coded_values_mapping_final_'.$data['nationalvalue'].'"   align="center"> 
<div class="table  table-striped table-bordered definitions-table horizontal_scroll">';






        echo "<tr style='border: 0px;' >
               <td class='text-center'>
                  <table class=\"table  table-striped  definitions-table horizontal_scroll\">
               <tr style=\"background-color: #979797; color:white;\">
                    <th class=\"text-center\">Coded Value  </th>
                    <th class=\"text-center\">Coded Value Description </th>
                 <!--   <th class=\"text-center\"> </th>-->
                    <th class=\"text-center\"> </th>
               </tr>";

                foreach($definitions_data as $data) {

                    echo "<input type='hidden' name='selectedlocalvalue[]' value='$data->definitionID' >";

                    if($data->mappedCodedStatus==1) {
                        echo "<tr class='localtable stileone' style='background-color: $data->mappedColor'>";
                    }else{
                        echo "<tr class='localtable stileone'>";
                    }


                           echo"<td class='text-center'>$data->codedValue</td>";
                           echo"<td class='text-center' >$data->codedValueDescription</td>";
                           echo"<td class='text-center'>
                                    <span> ";
                            if($data->mappedCodedStatus==1) {
                                echo "<span  class='btn' style='border: 1px solid #0099cc;'>Mapped To</span>";
                            }else{
                                echo "<span class='btn'  style='border: 1px solid #0099cc;'>Local</span>";

                            }
                                 echo"</span>
                               
                              </td>";



                            echo "</tr>";

                }


                 echo "</table>
                       </td>
                  <td class='text-center nationaltable'>
                    <table class=\"table  table-striped  definitions-table horizontal_scroll\">
               <tr style=\"background-color: #979797; color:white;\">
              <!--    <th></th>-->
                  <th class=\"text-center\">Coded Value  </th>
                   <th class=\"text-center\">Coded Value Description </th>
               </tr>";

            if($nationalstatus=="datafound"){
                foreach($national_codes as $nat) {

                    if($nat->mappedCodedStatus==1){
                        echo "<tr class='nationaltablemapped stileone' style='background-color: $nat->mappedColor !important'>";
                    }else{
                        "  <tr class='nationaltable stileone'>";
                    }

                        echo "<td class='text-center' data-national-coded='$nat->ddItemCodeText'>$nat->ddItemCodeText</td>
                         <td class='text-center' data-national-desc='$nat->ddItemCodeText'>$nat->ddCodedValueDescription</td>
                         </tr>
                    ";
                }

            }else{

                    echo "<tr>
                        <td class='text-center' colspan='2'>No Record Found</td>
                        
                         </tr>
                    ";


            }

               echo "</table>
                       </td>
                  <td class='text-center sqlButton'>
                    <table class=\"table  table-striped  definitions-table horizontal_scroll\">
               <tr style=\"background-color: #979797; color:white;\" >
              <span  class='btn btn-primary btn-sm' id='sqlButton_popup'>SQL</span>
               </tr><div class='modal fade' id='sql_modal' >
                      <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                    <h4 class='modal-title'>SQL Code Information</h4>
                                </div>
                                <div class='modal-body'><div class='row'><div class='col-md-6' >";
                                  echo("<div style='text-align:left;'>CASE</div>");

                                        foreach($sql_mapp_value as $i=>$c )
                                        {
                                            if(in_array($c,$sql_mapp_code)){}
                                            else{
                                               array_push($sql_mapp_code,'Local');
                                            }
                                        }

                                     foreach($sql_mapp_value as $value)
                                     {
                                        echo("WHEN $dataItem_from_sql = '$value' <br>");
                                        
                                     }
                                     echo "</div><div class='col-md-6' style='text-align:left;'>";
                                     echo("<br>");

                                        foreach ($sql_mapp_code as $code) {
                                           echo("THEN '$code'<br>");
                                        }

                               echo " </div></div><div style='text-align:left;'>ELSE null<br>END AS '$dataItem_value_sql'  ;</div></div>
                                <div class='modal-footer'>
                                    
                                </div>
                            </div>
                        </div>

               </div>";


              echo "</table>
          </td>
         </tr>";




        echo'</div></td></tr></table></div>';






    }





    public function postNationalCodes(Request $request){
        $data = $request->all();
        $data_id = $data['data_selected'];
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;

        if(!empty($data['data_item'])){
            $national_codes = DB::table('emnationalcodedvalues')
                ->where('ddItemName', 'LIKE', '%'.$data['data_item'].'%')
                ->orderBy('ddItemCodeText','ASC')
                ->get();


            foreach($national_codes as $codes){
                echo "<tr> 
                            <td class=\"text-center\">$codes->ddItemCodeText</td>
							<td class=\"text-center\" >$codes->ddCodedValueDescription</td>
                    </tr>";

            }

        }
        else{
            echo "<tr> 
                           <td colspan='2'>No Record found</td>
                    </tr>";
        }











    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postSelectedDataItems(Request $request)
    {
       $data = $request->all();

        $highlightdata = $data['dataitemname'];

        $dataitems = DB::table('emdefinitionstable')->select('dataItemName')->groupBy('emdefinitionstable.dataItemName')->get();

        $dataitemsrelated = DB::table('emdefinitionstable')
                            ->select('dataItemName')
                            ->where('dataItemName','=',$data['dataitemname'])
                            ->get();

        foreach($dataitems as $data){

            echo " <li>";
            if($highlightdata==$data->dataItemName){
                echo  "<label for='$data->dataItemName' class=\"col-md-6\" style='background-color:#70ad47'>";
            }else{
                echo  "<label for='$data->dataItemName' class=\"col-md-6\">";
            }
                    echo "$data->dataItemName</label>
                   </li>";

        }
    }


    public function postMappingInformation(Request $request)
    {
       $data = $request->all();

        $dataitems = Datawizard::where('referenceDetailId','=',$data['dataid'])

            ->get();

        foreach($dataitems as $data){

            echo " <tr >
                            <td>$data->datasetBelongs</td>
                            <td>$data->dataItem</td>
                            <td>$data->mappingInfo</td>
                            <td>$data->mappingComments</td>
                            <td>$data->sharePointLink</td>
              
                        </tr>";



        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postLocaltoNational(Request $request)
    {

        $data = $request->all();

        $localdataname = $data['localdataname'];
        $nationaldataname =$data['nationaldataname'];


        $nationaldata = DB::table('emnationalcodedvalues')
                        ->where('codedValueId','=',$data['national_id'])
                        ->first();

        $previous_color = DB::table('emmappedcoded')
            ->where('nationaldataId','=',$data['national_id'])
            ->orderBy('nationaldataId','ASC')
            ->first();

        if(!empty($previous_color)){
            $color_code = $previous_color->mappedColor;

        }else{
            $color_new = DB::table('emcolorcodes')
                ->select('colorCode')
                ->whereNotIn('colorCode', function($q){
                    $q->select('mappedColor')->from('emmappedcoded');
                })->first();

            $color_code = $color_new->colorCode;

        }






        $local_selected_ids = $data['checked'];
        foreach($local_selected_ids as $local_ids){

            $localdataitem = DB::table('emdefinitionstable')
                ->where('definitionID','=',$local_ids)
                ->first();

            $referencedetailid = $localdataitem->referenceDetailId;

            $mapdataitem=array(
                'localDataId'=>$local_ids,
                'referenceDetailId'=>$localdataitem->referenceDetailId,
                'nationaldataId'=>$data['national_id'],
                'mappedCodedStatus'=>1,
                'mappedColor'=>$color_code,
            );
            Mappedcoded::insert($mapdataitem);

            $infostatus = array(
                'mappedCodedStatus' => 1,
            );
            Definitions::where('definitionID','=',$local_ids)->update($infostatus);

        }

        $approved_count = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
            ->where('emconceptreferencedata.status','=',1)
             ->where('emdefinitionstable.mappedCodedStatus','=',0)
             ->where('emdefinitionstable.dataItemName','=',$localdataname)
            ->count();
        if($approved_count==0){
            $complete = array(
                'mappedCodedComplete' => 1,
            );
            Definitions::where('dataItemName','=',$localdataname)->update($complete);
        }




       /* listing */

        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
            ->leftjoin('emmappedcoded','emdefinitionstable.definitionID','=','emmappedcoded.localDataId')
            ->where('dataItemName','=',$localdataname)
            ->get();



        if(!empty($nationaldataname)){
            $nationalstatus="datafound";
            $datanational=$nationaldataname;

            $national_codes = DB::table('emnationalcodedvalues')
                ->leftjoin('emmappedcoded','emmappedcoded.nationaldataId','=','emnationalcodedvalues.codedValueId')
                ->where('emnationalcodedvalues.ddItemName', 'LIKE', '%'.$nationaldataname.'%')
                /*->where('emmappedcoded.referenceDetailId','=',$referencedetailid)*/

                ->groupBy('emnationalcodedvalues.ddItemCodeText')
                ->orderBy('ddItemCodeText','ASC')

                ->get();


        }else{
            $nationalstatus="nodatafound";
            $national_codes = "";

        }







        echo "<tr>
               <td class='text-center localtablehidden'>
                  <table class=\"localtablehidden table  table-striped table-bordered definitions-table horizontal_scroll\">
               <tr>
                    <th class=\"text-center\">Coded Value  </th>
                    <th class=\"text-center\">Coded Value Description </th>
                 <!--   <th class=\"text-center\"> </th>-->
                    <th class=\"text-center\"> </th>
               </tr>";

        foreach($definitions_data as $data) {


            if($data->mappedCodedStatus==1){
                echo "<tr class='localtable' style='background-color: $data->mappedColor'>";
            }else{
                echo "<tr class='localtable'>";
             }



            echo "<td class='text-center'>$data->codedValue</td>
                            <td class='text-center' >$data->codedValueDescription</td>";
            if($data->mappedCodedStatus==1){
                echo "<td></td> ";

            }
            else{
                echo "<td>
                              <input class='localchecked' id='localcheck_$data->definitionID' type='checkbox' name='selectedlocalvalue[]' value='$data->definitionID' >
                              </td>";

            }

            echo"<td class='text-center'> 
							  <span>

                               <a href='javascript:void(0)'>";
                                if($data->mappedCodedStatus==1) {
                                    echo " <span  class='btn' style='border: 1px solid #0099cc;'>Mapped To</span>";
                                }else{
                                    echo " <span data-nationalname='$datanational' data-localname='$data->dataItemName' data-id='$data->definitionID' class='btn local_national_mapping' style='border: 1px solid #0099cc;'>Map</span>";

                                }
                           echo"  </a>

                               </span>
                               
                            </td>
                           </tr>";

        }


        echo "</table>
                       </td>
                  <td class='text-center nationaltablemapping'>
                    <table class=\"table  table-striped table-bordered definitions-table horizontal_scroll nationaltable\">
               <tr >
                <th></th>
                  <th class=\"text-center\">Coded Value  </th>
                   <th class=\"text-center\">Coded Value Description </th>
                   
               </tr>";

        if($nationalstatus=="datafound"){
            foreach($national_codes as $nat) {

                if($nat->mappedCodedStatus==1){
                    echo "<tr class='nationaltablemapped ' style='background-color: $nat->mappedColor !important'>";
                }else{
                    echo "  <tr class='nationaltable'>";
                }


                echo "<td> 
                                    <input type='radio' name='selectednationalvalue' value='$nat->codedValueId' >
                                </td>
                                
                      <td class='text-center' data-national-coded='$nat->ddItemCodeText'>$nat->ddItemCodeText</td>
                         <td class='text-center' data-national-desc='$nat->ddItemCodeText'>$nat->ddCodedValueDescription</td>
                         </tr>
                    ";
            }

        }else{

            echo "<tr>
                        <td class='text-center' colspan='2'>No Record Found</td>
                        
                         </tr>
                    ";


        }



        echo "</table>
          </td>
         </tr>";


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
