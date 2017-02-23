<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use Input;
use Sentinel;
use Validator;
use DB;
use App\Models\CsvReferenca;
use App\Models\CsvReferenceDetails;
use App\Models\Comments;

class CsvImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $user_id = Sentinel::check()->id;
        $csv_list = CsvReferenca::where('crossReferenceId','=',0)->where('userId','=',$user_id)->get();
        $csv_list_activated = CsvReferenca::where('status','=',1)->where('crossReferenceId','=',0)->get();

        return view("dashboards.data-csv-view", compact('csv_list','csv_list_activated'));
    }

    public function postCsvData(Request $request)
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
            );

            $csvinsert = CsvReferenca::insert($data);
            /*Check if the csv file upload sucessfully*/
            if($csvinsert){
                $csv_id = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId','DESC')->first();

                $fileD = fopen("media/uploads/$fileName","r");

                if ($fileD) {
                    $line = 0; // 1
                    while ( ($value = fgetcsv($fileD)) !== false ) {
                        if ($line > 0) { // 2
                            // Keep logic here to add to database, line 1 onwards
                            $inserted_data=array(
                                'referenceDetailId'=>$csv_id->conceptReferenceDataId,
                                'dataItemName'=>$value[0],
                                'dataItemDescription'=>$value[1],
                                'dataType'=>$value[2],
                                'requirement'=>$value[3],
                                'code'=>$value[4],
                                'codeDescription'=>$value[5],
                                'isDerivedItem'=>$value[6],
                                'derivationMethodology'=>$value[7],
                                'author'=>$value[8],
                                'createdDate'=>$created,
                            );

                            CsvReferenceDetails::insert($inserted_data);
                        }

                        $line++;

                    }
                }


            }

            return redirect('dashboard/csv-management');
        }
        else{
            return redirect('dashboard/csv-management')->withErrors(['errors' =>"Please choose a file"]);
        }



    }

    public function postCsvVersions(Request $request)
    {

        $data = $request->all();

        $file_id = $request->input('file_id');


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
                'crossReferenceId' => $file_id,
                'status' => 0,
                'createdDate' => $created,
            );

            $csvinsert = CsvReferenca::insert($data);
            
            /*Check if the csv file upload sucessfully*/
            if($csvinsert){
                $csv_id = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId','DESC')->first();

                $fileD = fopen("media/uploads/$fileName","r");

                if ($fileD) {
                    $line = 0; // 1
                    while ( ($value = fgetcsv($fileD)) !== false ) {
                        if ($line > 0) { // 2
                            // Keep logic here to add to database, line 1 onwards
                            $inserted_data=array(
                                'referenceDetailId'=>$csv_id->conceptReferenceDataId,
                                'dataItemName'=>$value[0],
                                'dataItemDescription'=>$value[1],
                                'dataType'=>$value[2],
                                'requirement'=>$value[3],
                                'code'=>$value[4],
                                'codeDescription'=>$value[5],
                                'isDerivedItem'=>$value[6],
                                'derivationMethodology'=>$value[7],
                                'author'=>$value[8],
                                'createdDate'=>$created,
                            );

                            CsvReferenceDetails::insert($inserted_data);
                        }

                        $line++;

                    }
                }


            }

            return redirect('dashboard/csv-management/versions/'.$file_id);
        }
        else{
            return redirect('dashboard/csv-management')->withErrors(['errors' =>"Please choose a file"]);
        }



    }

    public function getVersions($id)
    {


        $user_id = Sentinel::check()->id;
   /*     $csv_list = DB::select("select * from emconceptreferencedata
              left join `comment` on `emconceptreferencedata`.`conceptReferenceDataId` = `comment`.`referenceDetailId` 
                            WHERE fileTitle in (select fileTitle from emconceptreferencedata group by fileTitle 
              having count(*) >= 1)  ");*/

               $csv_list = DB::select("SELECT *
                    FROM emconceptreferencedata
                    inner join `comment` ON `emconceptreferencedata`.`conceptReferenceDataId` = `comment`.`referenceDetailId`
                    WHERE fileTitle
                    IN (
                    
                    SELECT fileTitle
                    FROM emconceptreferencedata
                    GROUP BY fileTitle
                    HAVING count( * ) >1
                    )
                    AND conceptReferenceDataId =$id");

        $reply_comments = DB::table('comment')->where('referenceDetailId','=',$id)->get();

        $file_status =  DB::table('emconceptreferencedata')
            ->select('status','fileName','fileTitle','fileDescription','conceptReferenceDataId')
            ->where('conceptReferenceDataId', $id)->get();


        return view("dashboards.file-csv-versions", compact('csv_list','csv_list_activated','file_status','reply_comments'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails($id){


        $dataset =  CsvReferenceDetails::leftjoin('emconceptreferencedata', 'emconceptreferencedetails.referenceDetailId', '=', 'emconceptreferencedata.conceptReferenceDataId')
            ->where('referenceDetailId', $id)->get();
        $file_status =  DB::table('emconceptreferencedata')
            ->select('status','fileName','fileTitle','fileDescription')
            ->where('conceptReferenceDataId', $id)->get();



        return view("dashboards.data-csv-details", compact('dataset','file_status'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReplyComments(Request $request){
        $data =$request->all();

        $id = $data['data_id'];
        $user_id = Sentinel::check()->id;
        $user_name = Sentinel::check()->username;
        $commentedDate = date("Y-m-d H:i:s");
        $message = array(
            'commentText' => $request->comments,
            'userId' => $user_id,
            'referenceDetailId' => $request->referenceDetailId,
            'commentedDate' => $commentedDate,
            'parentCommentId' => $request->data_id,
            'userName' => $user_name,


        );

        Comments::insert($message);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
