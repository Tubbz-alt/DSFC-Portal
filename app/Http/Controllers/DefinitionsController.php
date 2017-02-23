<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use Validator;
use DB;
use Excel;
use Input;
use App\Models\CsvReferenca;
use App\Models\CsvReferenceDetails;
use App\Models\Comments;
use App\Models\Definitions;
use App\Models\Dditems;

class DefinitionsController extends Controller
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


        $definitions_data = CsvReferenca::
              leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
             ->join('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
            ->where('userId','=',$user_id)
            ->orderBy('emdatawizard.datasetBelongs',' DESC')
            ->orderBy('emdefinitionstable.referenceDetailId',' DESC')
            ->get();

        $dditems =Dditems::all();
		$selected=[];

        return view('dashboards.definitions',compact('definitions_data','dditems','selected'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHistory()
    {
        $user_id = Sentinel::check()->id;
        $csv_list = CsvReferenca::where('crossReferenceId','=',0)->where('userId','=',$user_id)
            ->orderBy('createdDate','DESC')->get();
        $csv_list_activated = CsvReferenca::where('status','=',1)->where('crossReferenceId','=',0)
            ->orderBy('createdDate','DESC')->get();
        return view("dashboards.definitions-import", compact('csv_list','csv_list_activated'));
    }
    public function getHistoryItem()
    {
        $user_id = Sentinel::check()->id;
        $csv_list = CsvReferenca::where('crossReferenceId','=',0)->where('userId','=',$user_id)
            ->orderBy('createdDate','DESC')->get();
        $csv_list_activated = CsvReferenca::where('status','=',1)->where('crossReferenceId','=',0)
            ->orderBy('createdDate','DESC')->get();
        return view("dashboards.definitions-import-item", compact('csv_list','csv_list_activated'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStoreDefinition(Request $request)
    {
        $data = $request->all();

        $messsages = array(
            'file_title.required'=>'File Title is Required',
            'filedescription.required'=>'File Description is Required',
            'excel-data.required'=>'Please Choose File',
        );

        $rules = array(
            'file_title' => 'required',
            'filedescription' => 'required',
            'excel-data' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules,$messsages);



        if ($validator->fails()):
            $this->throwValidationException($request, $validator);
        endif;


        $user_id = Sentinel::check()->id;

        $file = array_get($data, 'excel-data');

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
                'fileTitle' => $request->input('file_title'),
                'fileDescription' => $request->input('filedescription'),
                'fileName' => $fileType,
                'filePath' => $fileName,
                'crossReferenceId' => 0,
                'status' => 0,
                'createdDate' => $created,
                'dataSet' => $request->input('dataset'),
            );

            $csvinsert = CsvReferenca::insert($data);
            /*Check if the csv file upload sucessfully*/

            if($csvinsert){
                $csv_id = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId','DESC')->first();

                $fileD = fopen("media/uploads/$fileName","r");

                if ($fileD) {
                    $patient = new Definitions();
                    $patient::truncate();
                    $line = 0; // 1
                    while ( ($value = fgetcsv($fileD)) !== false ) {
                        if ($line > 0) { // 2
                            // Keep logic here to add to database, line 1 onwards


                        $inserted_data=array(
                            'referenceDetailId'=>$csv_id->conceptReferenceDataId,
                            'dataBaseName'=>$value[1],
                            'tableName'=>$value[2],
                            'dataItemName'=>$value[3],
                            'dataItemDescription'=>$value[4],
                            'dataType'=>$value[5],
                            'requirement'=>$value[6],
                            'codeTbc'=>$value[7],
                            'codeDescriptionTbc'=>$value[8],
                            'isDerivedItem'=>$value[9],
                            'derivationMethodology'=>$value[10],
                            'author'=>$value[11],
                            'createdDate'=>$value[12],
                            'uploadedDate'=>$created

                        );
                        Definitions::insert($inserted_data);

                        }

                        $line++;


                }
                }



            }

            return redirect('dashboard/data-definitions');
        }
        else{
            return redirect('dashboard/data-definitions')->withErrors(['errors' =>"Please choose a file"]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postStoreDditems(Request $request)
    {
        $data = $request->all();

        $messsages = array(
            'file_title.required'=>'File Title is Required',
            'filedescription.required'=>'File Description is Required',
            'excel-data.required'=>'Please Choose File',
        );

        $rules = array(
            'file_title' => 'required',
            'filedescription' => 'required',
            'excel-data' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules,$messsages);



        if ($validator->fails()):
            $this->throwValidationException($request, $validator);
        endif;


        $user_id = Sentinel::check()->id;

        $file = array_get($data, 'excel-data');

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
                'fileTitle' => $request->input('file_title'),
                'fileDescription' => $request->input('filedescription'),
                'fileName' => $fileType,
                'filePath' => $fileName,
                'crossReferenceId' => 0,
                'status' => 0,
                'createdDate' => $created,
                'dataSet' => $request->input('dataset'),
            );

            $csvinsert = CsvReferenca::insert($data);
            /*Check if the csv file upload sucessfully*/

            if($csvinsert){
                $csv_id = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId','DESC')->first();

                $fileD = fopen("media/uploads/$fileName","r");

                if ($fileD) {
                    $patient = new Dditems();
                    $patient::truncate();
                    $line = 0; // 1
                    while ( ($value = fgetcsv($fileD)) !== false ) {
                        if ($line > 0) { // 2
                            // Keep logic here to add to database, line 1 onwards


                            $inserted_data=array(
                                'referenceDetailId'=>$csv_id->conceptReferenceDataId,
                                'itemName'=>$value[0],
                                'itemType'=>$value[1],
                                'URL'=>$value[2],
                                'createdDate'=>$created

                            );
                            Dditems::insert($inserted_data);

                        }

                        $line++;


                    }
                }



            }

            return redirect('dashboard/data-definitions');
        }
        else{
            return redirect('dashboard/data-definitions')->withErrors(['errors' =>"Please choose a file"]);
        }

    }
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCheckMapping(Request $request)
	{ 
		$data = $request->all();
		if($data['marked']== 'Gobal'){
			 $datas = array(
                'mappingReferenceId' => $data['selectedMap'],
                );
				Definitions::where('definitionID', $data['reference_id'])->update($datas);
				return "Success";
				
		}
		if($data['marked']== 'Local'){
			$datas = array(
                'mappingComment' => $data['comment'],
                );
				Definitions::where('definitionID','=', $data['reference_id'])->update($datas);
				return "Success";
		}
		
	
	}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postMappingData(Request $request)
    {
        $data = $request->all();

    }
    public function getMappingList(Request $request)
    {
        $dditems =Dditems::all();
        echo "<div class=\"modal-content mymapping-content\" style=\"width: 100%\">
				<div class=\"modal-header\">
					<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span
								aria-hidden=\"true\">&times;</span></button>
					<div class=\"col-md-2\">

					</div>
					<div class=\"col-md-10\">

					</div>
				</div>
				<div class=\"modal-body rtt-popup\">

					<table class=\"filtertable\">

						<tbody>";
						 foreach($dditems as $itemData){

							echo"<tr>

							<td>
							<input class=\"mappingdata radio-custom\" name=\"mappinginformation\" value= $itemData->itemId type=\"radio\">
							$itemData->itemName </td>
                  

							</tr>";
						}

	                  echo "</tbody>
					</table>

				

				</div>
				<div class=\"modal-footer\">
					<button type=\"button\" class=\"btn btn-default check-status\" data-dismiss=\"modal\">Mapped as local</button>
					<button type=\"button\" class=\"btn btn-primary submit-form-mapping \">Map</button>
				</div>
			</div>";

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postDetails(Request $request)
    {

        $data = $request->all();


        $definitions_data = Definitions::where('referenceDetailId', $data['data_selected'])->get();
        $dditems = Dditems::all();
        $selected = [];

        $file_info = DB::table('emconceptreferencedata')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->where('conceptReferenceDataId',$data['data_selected'])
            ->orderBy('emconceptreferencedata.createdDate', 'DESC')
            ->first();
        $total_records = Definitions::where('referenceDetailId',$data['data_selected'])->count();


        echo "   <div class=\"col-md-12\">
                    <div class=\"dtls-row\">
                        <div class=\"col-md-4\">
                            <div class=\"dtls-row-head\">Import date and time</div>
                            <div class=\"dtls-row-content\">$file_info->createdDate</div>
                        </div>
                        <div class=\"col-md-4\">
                            <div class=\"dtls-row-head\">User details </div>
                            <div class=\"dtls-row-content\">$file_info->username</div>
                        </div>
                        <div class=\"col-md-4\">
                            <div class=\"dtls-row-head\">Status </div>
                            <div class=\"dtls-row-content\">";
                                if($file_info->status==0)
                                {
                                    echo "   <span class=\"alert text-danger \">
														Pending
									</span>";
                                }
                                else
                                {
                                    echo "<span class=alert text - success'>
														Approved
									</span>";
                                }

                            echo"</div>
                        </div>
                    </div>

                    <div class=\"dtls-row\">
                        <div class=\"col-md-4\">
                            <div class=\"dtls-row-head\">
                            
                            Approved By
                            
                            </div>";
                             if($file_info->status==1){
                               echo "  <div class=\"dtls-row-content\">Admin</div>";
                            }else{
                               echo "  <div class=\"dtls-row-content\"></div>";
                            }
                            
                          
                        echo "</div>
                        <div class=\"col-md-4\">
                            <div class=\"dtls-row-head\">Total number of records uploaded</div>
                            <div class=\"dtls-row-content\">$total_records</div>
                        </div>
                        <div class=\"col-md-4\">
                            <div class=\"dtls-row-head\">Any data quality issues</div>
                            <div class=\"dtls-row-content\">";
                                if($file_info->qualityIssues==1){
                                    echo "<span class='alert text - danger'>
														Yes
									</span>
                                    $file_info->qualityIssuesCount";
                                }
                                    
                                else{
                                    echo "<span class='alert text - success'>
														No
									</span>";
                                }




                            echo"</div>
                        </div>
                    </div>
                </div>";



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
