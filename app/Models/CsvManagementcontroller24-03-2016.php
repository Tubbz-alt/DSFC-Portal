<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Models\CsvReferenca;
use App\Models\CsvReferenceDetails;
use App\Models\Comments;
use App\Models\Definitions;
use App\Models\Dditems;
use App\Models\Datawizard;
use App\Models\Groupinginfo;
use App\Models\ChangeRequest;
use App\Models\HelpModel;
use App\Models\GroupData;
use App\Models\NAtionalData;
use App\Models\Aeadata;
use Sentinel;
use Mail;
use Session;
use Input;

class CsvManagementcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $file_info = DB::table('emconceptreferencedata')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->leftjoin('comment', 'emconceptreferencedata.conceptReferenceDataId', '=', 'comment.referenceDetailId')
            ->groupBy('emconceptreferencedata.conceptReferenceDataId')
            ->orderBy('emconceptreferencedata.createdDate', 'DESC')
            ->get();


        $reply_comments = DB::table('comment')->get();
        return view('admin.datamanagement.index', compact('file_info', 'reply_comments'));
    }

    public function postDataApproval(Request $request)
    {
        $data = $request->all();
        $id = $data['data_id'];
        $updated_date = date("Y-m-d H:i:s");
        $message = array(
            'status' => $request->status,
            'updatedDate' => $updated_date,

        );

        CsvReferenca::where('conceptReferenceDataId', '=', $id)->update($message);


    }

    public function postComments(Request $request)
    {
        $data = $request->all();

        $id = $data['data_id'];
        $user_name = Sentinel::check()->username;
        $user_id = Sentinel::check()->id;
        $commentedDate = date("Y-m-d H:i:s");
        if (!empty($data['data_parent_comment_id'])) {
            $parentCommentId = $data['data_parent_comment_id'];
            $message = array(
                'commentText' => $request->comments,
                'userId' => $user_id,
                'referenceDetailId' => $request->data_id,
                'commentedDate' => $commentedDate,
                'parentCommentId' => $parentCommentId,
                'userName' => $user_name,


            );

        } else {
            $message = array(
                'commentText' => $request->comments,
                'userId' => $user_id,
                'referenceDetailId' => $request->data_id,
                'commentedDate' => $commentedDate,
                'userName' => $user_name,
            );

        }


        Comments::insert($message);


    }


    public function getDetails($id)
    {


        $dataset = CsvReferenca::
        leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->where('emdefinitionstable.referenceDetailId', $id)
            ->orderBy('emdefinitionstable.referenceDetailId', 'DESC')
            ->groupBy('emdefinitionstable.dataItemName')
            ->get();


        return view("admin.datamanagement.data-details", compact('dataset'));


    }

    public function getDataItem()
    {

        $dataset = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->where('codedValue', '<>', '')
            ->orderBy('emdefinitionstable.dataItemName', 'ASC')
            ->get();

        $dataset_dataitem = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->where('codedValue', '<>', '')
            ->groupBy('emdefinitionstable.dataItemName')
            ->orderBy('emdefinitionstable.dataItemName', 'ASC')
            ->get();    

        return view("admin.datamanagement.data-item", compact('dataset','dataset_dataitem'));

    }

    public function getNationalData()
    {


        $file_info = DB::table('emconceptreferencedata')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->where('emconceptreferencedata.importDataType', '=', "NATIONAL")
            ->groupBy('emconceptreferencedata.conceptReferenceDataId')
            ->orderBy('emconceptreferencedata.createdDate', 'DESC')
            ->get();


        $database_table = DB::table('emnationalcodedvalues')->paginate(5000);


       // $database_table = DB::select(" select * from view_emnationalcodedvalues");

        $data_item_level = DB::table('emaeadatadefinition')->get();


        $definitions_data = DB::table('emdefinitionstable')
            ->select('codedValueType', 'definitionID', 'dataTypeSetStatus', 'dataItemName', 'codedValue')
            ->distinct('codedValueType')
            ->groupBy('codedValueType')->get();

        if (count($definitions_data) > 0) {
            foreach ($definitions_data as $datas) {

                $modified = $this->datatype(current(explode(' ', $datas->codedValueType)));
                $items = current(explode(' ', $datas->codedValueType));
                $id = $datas->definitionID;
                $status = $datas->dataTypeSetStatus;


                $datatypeitems[] = array('items' => $items, 'modified' => $modified, 'dataid' => $id, 'status' => $status);
            }


        } else {
            $datatypeitems = null;
        }

        $this->makeUniqueNationalDataId();
        return view("admin.datamanagement.nationaldata", compact('definitions_data', 'dditems', 'datatypeitems', 'file_info', 'database_table', 'data_item_level'));


    }


    public function postStoreNationalData(Request $request)
    {


        $data = $request->all();

        $user_id = Sentinel::check()->id;

        $file = array_get($data, 'excel-data');

        $inputData = Input::get('formFields');


        $fileTitle = $data['file_title'];
        $filedescription = $data['filedescription'];


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
            CsvReferenca::where('importDataType', "NATIONAL")->delete();

            $data = array(
                'userId' => $user_id,
                'fileTitle' => $fileTitle,
                'fileDescription' => $filedescription,
                'fileName' => $fileType,
                'filePath' => $fileName,
                'crossReferenceId' => 0,
                'importDataType' => "NATIONAL",
                'status' => 1,
                'createdDate' => $created,

            );

            $csvinsert = CsvReferenca::insert($data);
            /*Check if the csv file upload sucessfully*/

            if ($csvinsert) {
                $csv_id = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId', 'DESC')->first();

                $fileD = fopen("media/uploads/$fileName", "r");

                if ($fileD) {
                    $info = new NAtionalData();
                    $info::truncate();


                    $line = 0; // 1
                    while (($value = fgetcsv($fileD)) !== false) {
                        if ($line > 0) { // 2

                            // Keep logic here to add to database, line 1 onwards

                            $ddItemName = $value[0];
                            $ddItemAttrName = $value[1];
                            $ddItemCodeText = $value[2];
                            $ddCodedValueDescription = $value[3];
                            $ddCodedValueDescriptionChars = $value[4];
                            $isLatest = $value[5];

                            $inserted_data = array(
                                'uiquenationaldataid' => 0,
                                'nationalReferenceId' => $csv_id->conceptReferenceDataId,
                                'ddItemName' => strip_tags($ddItemName),
                                'ddItemAttrName' => $ddItemAttrName,
                                'ddItemCodeText' => strip_tags($ddItemCodeText),
                                'ddCodedValueDescription' => strip_tags($ddCodedValueDescription),
                                'ddCodedValueDescriptionChars' => strip_tags($ddCodedValueDescriptionChars),
                                'isLatest' => $isLatest,


                            );

                            NAtionalData::insert($inserted_data);


                        }
                        $line++;
                    }
                }


            }
        }
        $this->makeUniqueNationalDataId();
        return redirect('admin/reference-data/national-data');
    }


    public function makeUniqueNationalDataId()
    {
        $maxofuniqueid              =   DB::table('emnationalcodedvalues')->max('uiquenationaldataid');

        $natonalcoddedarray         =   DB::table('emnationalcodedvalues')
            ->orderBy('emnationalcodedvalues.ddItemName', 'ASC')
            ->where('emnationalcodedvalues.uiquenationaldataid', '=', 0)
            ->get();

        if(!empty($natonalcoddedarray))
        {
            foreach ($natonalcoddedarray as $natonalcoddedarrayvalues)
            {
                $national_data_search           = DB::table('emnationalcodedvalues')
                    ->where('emnationalcodedvalues.ddItemName', '=', "$natonalcoddedarrayvalues->ddItemName")
                    ->where('emnationalcodedvalues.uiquenationaldataid', '<>', 0)
                    ->first();

                if(!empty($national_data_search))
                {
                    DB::table('emnationalcodedvalues')
                    ->where('emnationalcodedvalues.codedValueId', '=', $natonalcoddedarrayvalues->codedValueId)
                    ->update(['uiquenationaldataid' => $national_data_search->uiquenationaldataid]);
                }
                else
                {
                    $maxofuniqueid++;
                    DB::table('emnationalcodedvalues')
                        ->where('emnationalcodedvalues.codedValueId', '=', $natonalcoddedarrayvalues->codedValueId)
                        ->update(['uiquenationaldataid' =>$maxofuniqueid]);
                }

            }
        }
    }



    public function getHelpData()
    {


        $file_info = DB::table('emconceptreferencedata')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->where('emconceptreferencedata.importDataType', '=', "HELP")
            ->groupBy('emconceptreferencedata.conceptReferenceDataId')
            ->orderBy('emconceptreferencedata.createdDate', 'DESC')
            ->get();


        $definitions_data = HelpModel::orderBy('helpTabName', 'ASC')->get();


        return view("admin.datamanagement.help", compact('definitions_data', 'dditems', 'datatypeitems', 'file_info', 'database_table', 'data_item_level'));


    }

    public function postStoreHelpData(Request $request)
    {


        $data = $request->all();

        $user_id = Sentinel::check()->id;

        $file = array_get($data, 'excel-data');

        $inputData = Input::get('formFields');


        $fileTitle = $data['file_title'];
        $filedescription = $data['filedescription'];


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
            CsvReferenca::where('importDataType', "HELP")->delete();

            $data = array(
                'userId' => $user_id,
                'fileTitle' => $fileTitle,
                'fileDescription' => $filedescription,
                'fileName' => $fileType,
                'filePath' => $fileName,
                'crossReferenceId' => 0,
                'importDataType' => "HELP",
                'status' => 1,
                'createdDate' => $created,

            );

            $csvinsert = CsvReferenca::insert($data);
            /*Check if the csv file upload sucessfully*/

            if ($csvinsert) {
                $csv_id = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId', 'DESC')->first();

                $fileD = fopen("media/uploads/$fileName", "r");

                if ($fileD) {
                    $info = new HelpModel();
                    $info::truncate();


                    $line = 0; // 1
                    while (($value = fgetcsv($fileD)) !== false) {
                        if ($line > 0) { // 2

                            // Keep logic here to add to database, line 1 onwards


                            $helpTabName = $value[0];
                            $objectName = $value[1];
                            $objectDescription = $value[2];


                            $inserted_data = array(
                                'helpReferenceId' => $csv_id->conceptReferenceDataId,
                                'helpTabName' => $helpTabName,
                                'objectName' => $objectName,
                                'objectDescription' => $objectDescription,
                                'createdDate' => $created,
                                'updatedDate' => $created


                            );

                            HelpModel::insert($inserted_data);


                        }
                        $line++;
                    }
                }


            }
        }

        return redirect('admin/reference-data/help-data');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postFeedbackUpdate(Request $request)
    {
        $data = $request->all();

        $inserted_data = array(
            'email' => $data['emailvalue'],
        );
        $email = $data['emailvalue'];

        DB::table('emfeedback')->where('feedbackId', $data['ID'])->update($inserted_data);

        echo "<span  class=\"text investigated\">$email</span>";


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function postDestroy(Request $request)
    {
        $data = $request->all();
        $data_itemid = DB::table('emdefinitionstable')->select('definitionID')
            ->where('referenceDetailId', $data['data_id'])->get();

        foreach ($data_itemid as $wizarddata) {
            DB::table('emdatawizard')
                ->where('referenceDetailId', $wizarddata->definitionID)
                ->delete();
        }

        if ($data['data_id']) {
            DB::table('emconceptreferencedata')->where('conceptReferenceDataId', $data['data_id'])->delete();
            DB::table('emaeadatadefinition')->where('referenceId', $data['data_id'])->delete();
            DB::table('emdefinitionstable')->where('referenceDetailId', $data['data_id'])->delete();

            DB::table('emmappedcoded')->where('referenceDetailId', $data['data_id'])->delete();
            DB::table('emhelpdata')->where('helpReferenceId', $data['data_id'])->delete();
        }

    }

    public function postDestroyDatabase(Request $request)
    {
        $data = $request->all();
        DB::table('emaeadatadefinition')
            ->where('tableName', $data['tablename'])
            ->delete();

        $database_table = DB::table('emaeadatadefinition')
            ->select('dataBaseName', 'tableName', 'tnrId')
            ->groupBy('tableName')->get();
        foreach ($database_table as $data) {
            echo "<tr>

				<td class=\"text-center\">$data->dataBaseName</td>
				<td class=\"text-center\">$data->tableName</td>
				<td  class=\"text-center\">
				<a class=\"btn btn-small btn-danger btn-sm destroydatadatabase\" 
				href=\"javascript:void(0)\" data-id=\"$data->tnrId\" 
				data-status=\"1\" data-table=\"$data->tableName\">Delete</a>
				</td>
			</tr>";

        }


    }

    public function postDestroyTnritem(Request $request)
    {
        $data = $request->all();
        DB::table('emaeadatadefinition')
            ->where('tnrId', $data['data_id'])
            ->delete();


    }

    public function postDestroyDataItem(Request $request)
    {
        $data = $request->all();
        DB::table('emdefinitionstable')
            ->where('definitionID', $data['data_id'])
            ->delete();


    }

    public function postDestroyMappingData(Request $request)
    {
        $data = $request->all();
        DB::table('emdefinitionstable')
            ->where('definitionID', $data['data_id'])
            ->delete();


    }

    public function postDestroyGroupingData(Request $request)
    {
        $data = $request->all();

        if (!empty($data['data_id'])) {

            $group_info_data = GroupData::getGroupId($data['data_id']);
            $group_id = $group_info_data->group_id;
            $group_info_data_count = GroupData::GroupIdCount($group_id);

            if ($group_info_data_count == 1) {

                $condition_group_main = array('groupId' => $group_id);
                Groupinginfo::deleteData($condition_group_main);

                $condition = array('group_id' => $group_id);
                GroupData::deleteData($condition);

                return "success";
            } else {
                $condition = array('id' => $data['data_id']);
                GroupData::deleteData($condition);

                return "success";
            }
        } else {
            return "Error";
        }
    }


    public function getMapping()
    {

        $latestrecord = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId', 'DESC')->first();


        /* $definitions_data = DB::table('emconceptreferencedata')
             ->leftjoin('emdefinitionstable','emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
             ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
             ->leftjoin('users','emconceptreferencedata.userId','=','users.id')
             ->join('emmappedcoded','emdefinitionstable.definitionID','=','emmappedcoded.localDataId')
             ->leftjoin('emnationalcodedvalues','emnationalcodedvalues.codedValueId','=','emmappedcoded.nationaldataId')
             ->get();*/

        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->join('emmappedcoded', 'emdefinitionstable.definitionID', '=', 'emmappedcoded.localDataId')
            ->leftjoin('emnationalcodedvalues', 'emnationalcodedvalues.codedValueId', '=', 'emmappedcoded.nationaldataId')
            ->orderBy('emdefinitionstable.dataItemName')
            ->get();


        $dditems = Dditems::all();
        $selected = [];

        return view('admin.datamanagement.mapping', compact('definitions_data', 'dditems', 'selected'));


    }

    public function postSelectedDataMoremappingFinal(Request $request)
    {
        $data = $request->all();
        $data_id = $data['data_selected'];
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;


        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->join('emmappedcoded', 'emdefinitionstable.definitionID', '=', 'emmappedcoded.localDataId')
            ->where('dataItemName', '=', $data['data_item'])
            ->get();


        if (!empty($data['nationalvalue'])) {
            $nationalstatus = "datafound";
            $datanational = $data['nationalvalue'];

            $national_codes = DB::table('emnationalcodedvalues')
                ->where('emnationalcodedvalues.ddItemName', 'LIKE', '%' . $data['nationalvalue'] . '%')
                ->join('emmappedcoded', 'emnationalcodedvalues.codedValueId', '=', 'emmappedcoded.nationaldataId')
                ->orderBy('ddItemCodeText', 'ASC')
                ->groupBy('emmappedcoded.mappedColor')
                ->get();
        } else {
            $nationalstatus = "nodatafound";
            $national_codes = "";

        }


        echo "<tr  style='border: 0px;' colspan='2'>
               <td class='text-center'>
                  <table class=\"table  table-striped  definitions-table horizontal_scroll\">
               ";

        if (!empty($definitions_data)) {
            foreach ($definitions_data as $data) {


                if ($data->mappedCodedStatus == 1) {
                    echo "<tr class='localtable stileone' style='background-color: $data->mappedColor'>";
                } else {
                    echo "<tr class='localtable stileone'>";
                }


                echo "<td class='text-center'>$data->codedValue</td>";
                echo "<td class='text-center' >$data->codedValueDescription</td>";


                echo "</tr>";

            }
        } else {
            echo "<tr> <td class='text-center' colspan='2'>No Records Found</td></tr>";
        }


        echo "</table>
          </td>
         </tr>";


    }


    public function postSelectedDataMoremappingDataitem(Request $request)
    {
        $data = $request->all();
        $data_id = $data['data_selected'];
        $user = Sentinel::getUser();
        $user_id = Sentinel::check()->id;


        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->join('emmappedcoded', 'emdefinitionstable.definitionID', '=', 'emmappedcoded.localDataId')
            ->where('dataItemName', '=', $data['data_item'])
            ->get();


        if (!empty($data['nationalvalue'])) {
            $nationalstatus = "datafound";
            $datanational = $data['nationalvalue'];

            $national_codes = DB::table('emnationalcodedvalues')
                ->where('emnationalcodedvalues.ddItemName', 'LIKE', '%' . $data['nationalvalue'] . '%')
                ->join('emmappedcoded', 'emnationalcodedvalues.codedValueId', '=', 'emmappedcoded.nationaldataId')
                ->orderBy('ddItemCodeText', 'ASC')
                ->groupBy('emmappedcoded.mappedColor')
                ->get();
        } else {
            $nationalstatus = "nodatafound";
            $national_codes = "";

        }


        echo "<tr style='border: 0px;'>
               <td class='text-center'>
                  <table class=\"table  table-striped  definitions-table horizontal_scroll\">
               <tr>
                    <th class=\"text-center\">Coded Value  </th>
                    <th class=\"text-center\">Coded Value Description </th>
               
                    <th class=\"text-center\"> </th>
               </tr>";

        foreach ($definitions_data as $data) {


            if ($data->mappedCodedStatus == 1) {
                echo "<tr class='localtable stileone' style='background-color: $data->mappedColor'>";
            } else {
                echo "<tr class='localtable stileone'>";
            }


            echo "<td class='text-center'>$data->codedValue</td>";
            echo "<td class='text-center' >$data->codedValueDescription</td>";
            echo "<td class='text-center'>
                                    <span> ";
            if ($data->mappedCodedStatus == 1) {
                echo "<span  class='btn' style='border: 1px solid #0099cc;'>Mapped To</span>";
            } else {
                echo "<span class='btn'  style='border: 1px solid #0099cc;'>Local</span>";

            }
            echo "</span>
                               
                 </td>
                 <td style='background-color: white'> </td>";


            echo "</tr>";

        }


        echo "</table>
                       </td>
                  <td class='text-center'>
                    <table class=\"table  table-striped  definitions-table horizontal_scroll\">
               <tr>
              <!--    <th></th>-->
                  <th class=\"text-center\">Coded Value  </th>
                   <th class=\"text-center\">Coded Value Description </th>
               </tr>";

        if ($nationalstatus == "datafound") {
            foreach ($national_codes as $nat) {

                if ($nat->mappedCodedStatus == 1) {
                    echo "<tr class='nationaltablemapped stileone' style='background-color: $nat->mappedColor !important;height: 55px'>";
                } else {
                    "  <tr class='nationaltable stileone' style='height: 55px'>";
                }

                echo "<td class='text-center' data-national-coded='$nat->ddItemCodeText'>$nat->ddItemCodeText</td>
                         <td class='text-center' data-national-desc='$nat->ddItemCodeText'>$nat->ddCodedValueDescription</td>
                         </tr>
                    ";
            }

        } else {

            echo "<tr>
                        <td class='text-center' colspan='2'>No Record Found</td>
                        
                         </tr>
                    ";


        }


        echo "</table>
          </td>
         </tr>";


    }

    public function postMappingApproval(Request $request)
    {
        $data = $request->all();
        $id = $data['data_id'];
        $datadefinition = Definitions::where('definitionID', '=', $id)->first();
        $updated_date = date("Y-m-d H:i:s");
        $message = array(
            'status' => $request->status,
            'mappedStatus' => 0,
            'updatedDate' => $updated_date,

        );
        $infostatus = array(
            'isMappedApprove' => 1,
        );

        Definitions::where('dataItemName', '=', $datadefinition['dataItemName'])
            ->update($infostatus);
        Datawizard::where('referenceDetailId', '=', $id)->update($message);


    }

    public function getGrouping()
    {

        $latestrecord = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId', 'DESC')->first();

        if (!empty($latestrecord)) {

//            $definitions_data = Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
//                ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
//                ->groupBy('emgroupinfo.referenceDetailId')
//                ->get();

            $definitions_data = DB::table('emgroupinfo')
                ->join('emgroupinfo_data', 'emgroupinfo.groupId', '=', 'emgroupinfo_data.group_id')
                ->join('emdefinitionstable', 'emdefinitionstable.definitionID', '=', 'emgroupinfo_data.reference_data_id')
                ->orderBy('emgroupinfo.groupName', 'ASC')
                ->get();
//                dd($definitions_data);
        } else {
//            $definitions_data = Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
//                ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
//                ->groupBy('emgroupinfo.referenceDetailId')
//                ->get();

            $definitions_data = DB::table('emgroupinfo')
                ->join('emgroupinfo_data', 'emgroupinfo.groupId', '=', 'emgroupinfo_data.id')
                ->join('emdefinitionstable', 'emdefinitionstable.definitionID', '=', 'emgroupinfo_data.reference_data_id')
                ->groupBy('emgroupinfo.groupName')
                ->orderBy('emgroupinfo.groupName', ' ASC')
                ->get();


        }

        $dditems = Dditems::all();
        $selected = [];


        return view('admin.datamanagement.grouping', compact('definitions_data', 'dditems', 'selected'));


    }


    public function getDatatypes()
    {


        $definitions_data = DB::table('emdefinitionstable')
            ->leftjoin('emdatatypemapp', 'emdefinitionstable.definitionID', '=', 'emdatatypemapp.dataMappedId')
            ->select('dataTypeMapName', 'dataTypeId', 'dataTypeName', 'codedValueType', 'definitionID', 'dataTypeSetStatus', 'dataItemName', 'codedValue', 'datatypeMapStatus')
            /* ->distinct('codedValueType')*/
            ->groupBy('codedValueType')
            ->get();

        if (count($definitions_data) > 0) {
            foreach ($definitions_data as $datas) {

                $modified = $this->datatype(current(explode(' ', $datas->codedValueType)));
                $items = current(explode(' ', $datas->codedValueType));
                $id = $datas->definitionID;
                $status = $datas->dataTypeSetStatus;


                $datatypeitems[] = array('items' => $items, 'modified' => $modified, 'dataid' => $id, 'status' => $status);
            }


        } else {
            $datatypeitems = null;
        }

        $datatypes = array('Text' => 'Text',
            'Integer' => 'Integer',
            'Date' => 'Date',
            'Time' => 'Time',
            'Date Time' => 'Date Time');


        return view('admin.datamanagement.datatype', compact('definitions_data', 'dditems', 'datatypeitems', 'datatypes'));


    }

    public function postDataTypeChange(Request $request)
    {
        $data = $request->all();


        $getid = DB::table('emdatatypemapp')->where('dataMappedId', '=', $data['data_id'])->get();

        if (!empty($getid)) {
            $datatype_map = array(
                'dataMappedId' => $data['data_id'],
                'dataTypeName' => $data['data_name'],
                'dataTypeMapName' => $data['value'],
                'datatypeMapStatus' => 1,
            );

            DB::table('emdatatypemapp')->where('dataMappedId', $data['data_id'])->update($datatype_map);

        } else {
            $datatype_map = array(
                'dataMappedId' => $data['data_id'],
                'dataTypeName' => $data['data_name'],
                'dataTypeMapName' => $data['value'],
                'datatypeMapStatus' => 1,
            );

            DB::table('emdatatypemapp')->insert($datatype_map);

        }


        /*$getid = Definitions::select('codedValueType')->where('definitionID', '=', $data['data_id'])->first();

        $getidall = Definitions::select('codedValueType','definitionID')
                    ->where('codedValueType', '=', $getid->codedValueType)
                    ->get();


        $inserted_info=array(
            'codedValueType'=>$data['value'],
        );

        foreach ($getidall as $dataids){
            $info = Definitions::where('definitionID', '=',  $dataids->definitionID)->update($inserted_info);
        }*/


        /* if($info){
             echo "sucess";
         }*/


    }

    public function getTnr()
    {

        $file_info = DB::table('emconceptreferencedata')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->where('emconceptreferencedata.importDataType', '=', "TNR")
            ->groupBy('emconceptreferencedata.conceptReferenceDataId')
            ->orderBy('emconceptreferencedata.createdDate', 'DESC')
            ->get();


        $database_table = DB::table('emaeadatadefinition')
            ->select('dataBaseName', 'tableName', 'tnrId')
            ->groupBy('tableName')->get();

        $data_item_level = DB::table('emaeadatadefinition')->get();


        $definitions_data = DB::table('emdefinitionstable')
            ->select('codedValueType', 'definitionID', 'dataTypeSetStatus', 'dataItemName', 'codedValue')
            ->distinct('codedValueType')
            ->groupBy('codedValueType')->get();

        if (count($definitions_data) > 0) {
            foreach ($definitions_data as $datas) {

                $modified = $this->datatype(current(explode(' ', $datas->codedValueType)));
                $items = current(explode(' ', $datas->codedValueType));
                $id = $datas->definitionID;
                $status = $datas->dataTypeSetStatus;


                $datatypeitems[] = array('items' => $items, 'modified' => $modified, 'dataid' => $id, 'status' => $status);
            }


        } else {
            $datatypeitems = null;
        }


        return view('admin.datamanagement.tnr', compact('definitions_data', 'dditems', 'datatypeitems', 'file_info', 'database_table', 'data_item_level'));


    }

    public function postStoreTnr(Request $request)
    {

        $data = $request->all();

        $user_id = Sentinel::check()->id;

        $file = array_get($data, 'excel-data');

        $inputData = Input::get('formFields');


        $fileTitle = $data['file_title'];
        $filedescription = $data['filedescription'];


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
                'importDataType' => "TNR",
                'status' => 1,
                'createdDate' => $created,

            );

            $csvinsert = CsvReferenca::insert($data);
            /*Check if the csv file upload sucessfully*/

            if ($csvinsert) {
                $csv_id = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId', 'DESC')->first();

                $fileD = fopen("media/uploads/$fileName", "r");

                if ($fileD) {

                    $line = 0; // 1
                    while (($value = fgetcsv($fileD)) !== false) {
                        if ($line > 0) { // 2

                            // Keep logic here to add to database, line 1 onwards

                            $dataBaseName = $value[0];
                            $tableName = $value[1];
                            $dataItemName = $value[2];
                            $dataItemDescription = $value[3];
                            $dataType = $value[4];

                            $codeTbc = $value[5];
                            $codeDescriptionTbc = $value[6];
                            $isDerivedItem = $value[7];
                            $derivationMethodology = $value[8];
                            $author = $value[9];
                            $createdDate = $value[10];
                            $dataDictionaryName = $value[11];
                            $dataDictionaryLinks = $value[12];


                            $inserted_data = array(
                                'referenceId' => $csv_id->conceptReferenceDataId,
                                'dataBaseName' => strip_tags($dataBaseName),
                                'tableName' => $tableName,
                                'tnrItemName' => strip_tags($dataItemName),
                                'tnrDataItemDescription' => strip_tags($dataItemDescription),
                                'dataType' => strip_tags($dataType),
                                'required' => "",
                                'codeTbc' => $codeTbc,
                                'codeDescriptionTbc' => $codeDescriptionTbc,
                                'isDerivedItem' => $isDerivedItem,
                                'derivationMethodology' => $derivationMethodology,
                                'authorName' => $author,
                                'createdDate' => $createdDate,
                                'dataDictionaryName' => $dataDictionaryName,
                                'dataDictionaryLinks' => $dataDictionaryLinks,

                            );

                            Aeadata::insert($inserted_data);


                        }
                        $line++;
                    }
                }


            }
        }

        return redirect('admin/reference-data/tnr');
    }


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

    public function getFeedback()
    {

        $feedback = DB::table('emfeedback')->get();


        return view('admin.datamanagement.feedback', compact('feedback'));


    }

    public function postFeedbackSubmit(Request $request)
    {

        $data = $request->all();

        $userdetails = [
            'subject' => $request->get('subject'),
            'description' => $request->get('description'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'url' => $request->get('url'),
            'title' => $request->get('title'),
        ];

        $mail = Mail::send('dashboards.feedback-message', $userdetails, function ($message) use ($userdetails) {  //it wont return anything coz its void

            $message->to('najum.khan@iboxdashboards.com')->subject($userdetails['subject']);
            $message->sender('no-reply@DSfC.com', 'DSfC');


        });

        Session::flash('success', 'Thank You for your Feedback!');
        return redirect('admin/reference-data/feedback')->with('message', '');

    }


    public function postGroupingApproval(Request $request)
    {
        $data = $request->all();
        $id = $data['data_id'];
        $updated_date = date("Y-m-d H:i:s");
        $message = array(
            'status' => $request->status,
            'updatedDate' => $updated_date,

        );

        Groupinginfo::where('referenceDetailId', '=', $id)->update($message);


    }

    public function getChangeRequest()
    {

        $latestrecord = CsvReferenca::select('conceptReferenceDataId')->orderBy('conceptReferenceDataId', 'DESC')->first();

        $request_open = Definitions::join('emchangerequest', 'emdefinitionstable.definitionID', '=', 'emchangerequest.referenceDetailId')
            ->orderBy('emchangerequest.requestId', ' DESC')
            ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
            ->get();

        $request_pending = Definitions::join('emchangerequest', 'emdefinitionstable.definitionID', '=', 'emchangerequest.referenceDetailId')
            ->where('emchangerequest.status', '=', 0)
            ->orderBy('emchangerequest.requestId', ' DESC')
            ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
            ->get();
        $request_closed = Definitions::join('emchangerequest', 'emdefinitionstable.definitionID', '=', 'emchangerequest.referenceDetailId')
            ->where('emchangerequest.status', '=', 1)
            ->orderBy('emchangerequest.requestId', ' DESC')
            ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
            ->get();
        $dditems = Dditems::all();
        $selected = [];

        return view('admin.datamanagement.changerequest', compact('request_open', 'dditems', 'selected', 'request_pending', 'request_closed'));


    }

    public function postChangeRequest(Request $request)
    {
        $data = $request->all();
        $id = $data['data_id'];
        $updated_date = date("Y-m-d H:i:s");
        $message = array(
            'status' => $request->status,
            'updatedDate' => $updated_date,

        );

        ChangeRequest::where('referenceDetailId', '=', $id)->update($message);


    }


    /* csv conversion*/
    public function postExportPagesImported(Request $request)
    {
        $data = $request->all();


        if (!empty($data['startdate']) && !empty($data['enddate'])) {
            $startdate = $data['startdate'];
            $date = $data['enddate'];
            $date = strtotime($date);
            $date = strtotime("+1 day", $date);
            $endate = date('Y-m-d', $date);
            $file_info = DB::table('emconceptreferencedata')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->leftjoin('comment', 'emconceptreferencedata.conceptReferenceDataId', '=', 'comment.referenceDetailId')
                ->whereRaw("emconceptreferencedata.createdDate BETWEEN '$startdate%' AND '$endate%' ")
                ->groupBy('emconceptreferencedata.conceptReferenceDataId')
                ->orderBy('emconceptreferencedata.createdDate', 'DESC')
                ->get();


        } else {
            $file_info = DB::table('emconceptreferencedata')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->leftjoin('comment', 'emconceptreferencedata.conceptReferenceDataId', '=', 'comment.referenceDetailId')
                ->groupBy('emconceptreferencedata.conceptReferenceDataId')
                ->orderBy('emconceptreferencedata.createdDate', 'DESC')
                ->get();


        }

        $filename = "importeddata_" . date('Y-M-d') . ".csv";
        $fp = fopen('php://output', 'w');
        $header = array('Sl.No', 'File Title', 'File Description', 'Created Date',
            'Created By', 'Approved Date', 'Status');

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        fputcsv($fp, $header);

        $i = 1;
        foreach ($file_info as $pages) {

            if ($pages->status == 1) {
                $approveddate = date('jS M G:i A', strtotime($pages->updatedDate));
                $status = "Approved";
            } else {
                $approveddate = " ";
                $status = "Pending Approval";

            }


            fputcsv($fp, array($i, $pages->fileTitle, $pages->fileDescription,
                $pages->createdDate, $pages->username, $approveddate, $status));
            $i = $i + 1;
        }
        exit;

        $reply_comments = DB::table('comment')->get();
        return view('admin.datamanagement.index', compact('file_info', 'reply_comments'));
    }

    public function postExportPagesTnr(Request $request)
    {
        $data = $request->all();

        if (!empty($data['startdate']) && !empty($data['enddate'])) {
            $startdate = $data['startdate'];
            $date = $data['enddate'];
            $date = strtotime($date);
            $date = strtotime("+1 day", $date);
            $endate = date('Y-m-d', $date);
            $file_info = Aeadata::
            leftjoin('emconceptreferencedata', 'emaeadatadefinition.referenceId', '=', 'emconceptreferencedata.conceptReferenceDataId')
                ->whereRaw("emconceptreferencedata.createdDate BETWEEN '$startdate%' AND '$endate%' ")
                ->get();
        } else {
            $file_info = Aeadata::all();
        }


        $filename = "TNR_" . date('Y-M-d') . ".csv";
        $fp = fopen('php://output', 'w');
        $header = array('Sl.No', 'Database', 'Table Name', 'Data_Item_Name',
            'Data_Item_Description', 'Data_Type', 'Requirement', 'Code_(TBC)', 'Code_Description_(TBC)',
            'Is_Derived_Item', 'Derivation_Methodology', 'Author', 'Created_Date', 'Data Dictionary Name',
            'Data Dictionary Links');

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        fputcsv($fp, $header);

        $i = 1;
        foreach ($file_info as $pages) {


            fputcsv($fp, array($i, $pages->dataBaseName, $pages->tableName,
                $pages->tnrItemName, $pages->tnrDataItemDescription,
                $pages->dataType, $pages->required,
                $pages->codeTbc, $pages->codeDescriptionTbc,
                $pages->isDerivedItem, $pages->derivationMethodology,
                $pages->author, $pages->createdDate,
                $pages->dataDictionaryName,
                $pages->dataDictionaryLinks
            ));
            $i = $i + 1;
        }
        exit;


        return redirect('admin/reference-data/tnr');
    }

    public function postExportPagesDataItem(Request $request)
    {
        $data = $request->all();

        if (!empty($data['startdate']) && !empty($data['enddate'])) {
            $startdate = $data['startdate'];
            $date = $data['enddate'];
            $date = strtotime($date);
            $date = strtotime("+1 day", $date);
            $endate = date('Y-m-d', $date);
            $dataset = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->whereRaw("emdefinitionstable.createdDate BETWEEN '$startdate%' AND '$endate%' ")
                ->where('codedValue', '<>', '')
                ->get();
        } else {
            $dataset = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->where('codedValue', '<>', '')
                ->get();
        }


        $filename = "data_item_" . date('Y-M-d') . ".csv";
        $fp = fopen('php://output', 'w');
        $header = array('Sl.No', 'Data Item  ', 'Coded Value', 'Coded Value Description', 'Version', 'Coded Values ID ', 'Coded Values Version ID', 'Uploaded Date', 'Created Date',);

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        fputcsv($fp, $header);

        $k = 1;
        $i = 0;
        $j = 1;
        $temp = array();
        foreach ($dataset as $pages) {

            if (!in_array($pages->dataItemName, $temp)) {
                $i++;
                $j = 1;
            }


            if ($pages->status == 1) {
                $approveddate = date('jS M G:i A', strtotime($pages->updatedDate));
                $status = "Approved";
            } else {
                $approveddate = " ";
                $status = "Pending Approval";

            }


            fputcsv($fp, array("0000" . $i, $pages->dataItemName, $pages->codedValue,
                $pages->codedValueDescription,
                $pages->dataItemVersionId,
                "0000" . $i . "." . "0000" . $j,
                $pages->codedValueDescription,
                $pages->createdDate,
                $pages->uploadedDate));
            $k = $k + 1;

            $temp[] = $pages->dataItemName;

            $j++;
        }
        exit;


        return view("admin.datamanagement.data-item", compact('dataset'));


    }

    public function postExportPagesMapping(Request $request)
    {

        $data = $request->all();

        if (!empty($data['startdate']) && !empty($data['enddate'])) {
            $startdate = $data['startdate'];
            $date = $data['enddate'];
            $date = strtotime($date);
            $date = strtotime("+1 day", $date);
            $endate = date('Y-m-d', $date);
            $definitions_data = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->join('emmappedcoded', 'emdefinitionstable.definitionID', '=', 'emmappedcoded.localDataId')
                ->leftjoin('emnationalcodedvalues', 'emnationalcodedvalues.codedValueId', '=', 'emmappedcoded.nationaldataId')
                ->whereRaw("emdefinitionstable.createdDate BETWEEN '$startdate%' AND '$endate%' ")
                ->get();
        } else {
            $definitions_data = DB::table('emconceptreferencedata')
                ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->join('emmappedcoded', 'emdefinitionstable.definitionID', '=', 'emmappedcoded.localDataId')
                ->leftjoin('emnationalcodedvalues', 'emnationalcodedvalues.codedValueId', '=', 'emmappedcoded.nationaldataId')
                ->get();

        }


        $dditems = Dditems::all();
        $selected = [];


        $filename = "mapping" . date('Y-M-d') . ".csv";
        $fp = fopen('php://output', 'w');
        $header = array('Sl.No', 'Data Item Name', 'Local/National', 'Data Set',
            'Comments', 'Share Point Link',
            'Coded Value', 'Coded Value Description ', 'National Coded Value', 'National Coded Value Description ', 'Created Date');

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        fputcsv($fp, $header);

        $i = 1;
        foreach ($definitions_data as $pages) {

            if ($pages->dataItem == "National") {

                $status = "National";
            } else {

                $status = "Local";

            }


            fputcsv($fp, array($i, $pages->dataItemName, $pages->dataItem,
                $pages->datasetBelongs, $pages->mappingComments, $pages->sharePointLink,
                $pages->codedValue, $pages->codedValueDescription, $pages->ddItemCodeText,
                $pages->ddCodedValueDescription, $pages->createdDate));
            $i = $i + 1;
        }
        exit;

        return view('admin.datamanagement.mapping', compact('definitions_data', 'dditems', 'selected'));


    }

    public function postExportPagesGrouping(Request $request)
    {

        $data = $request->all();

        if (!empty($data['startdate']) && !empty($data['enddate'])) {
            $startdate = $data['startdate'];
            $date = $data['enddate'];
            $date = strtotime($date);
            $date = strtotime("+1 day", $date);
            $endate = date('Y-m-d', $date);
            $definitions_data = Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
                ->whereRaw("emdefinitionstable.createdDate BETWEEN '$startdate%' AND '$endate%' ")
                ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
                ->groupBy('emgroupinfo.referenceDetailId')
                ->get();

        } else {
            $definitions_data = Definitions::join('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
                ->orderBy('emdefinitionstable.referenceDetailId', ' DESC')
                ->groupBy('emgroupinfo.referenceDetailId')
                ->get();

        }


        $filename = "mapping" . date('Y-M-d') . ".csv";
        $fp = fopen('php://output', 'w');
        $header = array('Sl.No', 'Data Item Name', 'Data Type', 'Group Name',
            'Group Type', 'Created Date');

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        fputcsv($fp, $header);

        $i = 1;
        foreach ($definitions_data as $pages) {

            if ($pages->dataItem == "National") {

                $status = "National";
            } else {

                $status = "Local";

            }


            fputcsv($fp, array($i, $pages->dataItemName, $pages->codedValueType,
                $pages->groupName, $pages->groupType, $pages->createdDate));
            $i = $i + 1;
        }
        exit;

        return view('admin.datamanagement.grouping', compact('definitions_data', 'dditems', 'selected'));


    }


    public function postExportPagesExport(Request $request)
    {

        $data = $request->all();

        if (!empty($data['startdate']) && !empty($data['enddate'])) {
            $startdate          = $data['startdate'];
            $date               = $data['enddate'];
            $date               = strtotime($date);
            $date               = strtotime("+1 day", $date);
            $endate             = date('Y-m-d', $date);

            $definitions_data = CsvReferenca::
            leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->whereRaw("emdefinitionstable.createdDate BETWEEN '$startdate%' AND '$endate%' ")
                ->where('codedValue', '<>', '')
                ->orderBy('emdefinitionstable.dataItemName')
                ->get();


        }
        else
        {
            $definitions_data = CsvReferenca::
            leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
                ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
                ->leftjoin('emgroupinfo_data', 'emdefinitionstable.definitionID', '=', 'emgroupinfo_data.reference_data_id')
                ->leftjoin('emgroupinfo', 'emgroupinfo_data.group_id', '=', 'emgroupinfo.groupId')
                ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
                ->where('dataItemName', '<>', '')
                ->orderBy('emdefinitionstable.dataItemName')
                ->get();
        }


        $filename           = "Export" . date('Y-M-d') . ".csv";
        $fp                 = fopen('php://output', 'w');
        $header             = array('Sl.No', 'Portal Tab', 'Data Item ID', 'Data Item', 'Coded Value', 'Coded Value Description', 'Version', 'Coded Values ID', 'Uploaded Date', 'Created Date', 'Mapping ID', 'Mapping Data Item ID', 'Group ID', 'Group Name', 'Group Type', 'Unique ID');

        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename='.$filename);
        fputcsv($fp, $header);


        $zero_x_padded                                              = sprintf("%05d", 0);
        $unique_map_data_id                 = 0;




        $dataitemid                         = 0;
        $groupuniid                         = 0;
        $uniquecodeId                       = 1;
        $slno                               = 0;
        $mappunid                           = 0;
        $mappcodedid                        = 0;
        $checkmapindex                      = 0;
        $uniquecodeId_rep_show              = 1;
        $arraycountdata                     = 0;
        $tempdataitem                       = array();
        $tempgroupname                      = array();
        $nationaldataidarr                  = array();
        $nationaldatanamearr                = array();
        $dataarraystore                     = array();
        $checkmaparr                        = array();





        $temp_data_item_name                = "";




        foreach ($definitions_data as $pages)
        {
            $slno++;
            $mapping_unique_id                  = 0;
            $mapped_data_item_id                = 0;
            $group_unique_id                    = 0;
            $definitions_data_mapping           = array();


            if($pages->group_uniq_id!="")
            {
                $group_unique_id                = $pages->group_uniq_id;
            }

            $definitions_data_mapping           = DB::table('emmappedcoded')
                ->leftjoin('emnationalcodedvalues', 'emnationalcodedvalues.codedValueId', '=', 'emmappedcoded.nationaldataId')
                ->where('emmappedcoded.localDataId', '=', $pages->definitionID)
                ->first();
            if(!empty($definitions_data_mapping)) {
                if ($definitions_data_mapping->codedValueId != "") {
                    $unique_map_data_id++;
                    $mapped_data_item_id = $definitions_data_mapping->uiquenationaldataid;
                    $definitions_data_mapping_array = DB::table('emnationalcodedvalues')
                        ->where('emnationalcodedvalues.ddItemName', '=', $definitions_data_mapping->ddItemName)
                        ->orderBy('emnationalcodedvalues.ddItemName')
                        ->get();

                    if (!empty($definitions_data_mapping_array)) {
                        foreach ($definitions_data_mapping_array as $mapitems_single) {
                            $mapping_unique_id++;
                            if ($mapitems_single->codedValueId == $definitions_data_mapping->codedValueId) {
                                break;
                            }
                        }
                    }
                }
            }
            $dataitemid_padded                          = "\t" . sprintf("%05d", $pages->dataItemId);
            $uniquecodeId_padded                        = sprintf("%05d", $pages->codedValueId);
            $groupuniid_padded                          = sprintf("%05d", $group_unique_id);

            $unique_map_data_id_padded                  = sprintf("%05d", $unique_map_data_id);
            $mapped_data_item_id_padded                 = "\t" .sprintf("%05d", $mapped_data_item_id);
            $mapping_unique_id_padded                   = sprintf("%05d", $mapping_unique_id);


            $unique_id_print                            =   "RDI.".$dataitemid_padded . "." . $uniquecodeId_padded . ".V1." . $pages->dataItemVersionId.".";
            if(!empty($definitions_data_mapping))
            {
                $print_mapping_id                       =   $dataitemid_padded.".".$unique_map_data_id_padded;
                $print_mapping_data_item_id             =   $mapped_data_item_id_padded.".".$mapping_unique_id_padded;
                $unique_id_print                        =   $unique_id_print.$unique_map_data_id_padded."."."UKHF.".$print_mapping_data_item_id.".";
            }
            else
            {
                $print_mapping_id                       =  "";
                $print_mapping_data_item_id             =  "";
                $unique_id_print                        =   $unique_id_print.$zero_x_padded.".".$zero_x_padded.".".$zero_x_padded.".";
            }
            if($pages->groupName!="")
            {
                $print_group_unique_id                  =  $dataitemid_padded . "." . $uniquecodeId_padded.".".$groupuniid_padded;
                $unique_id_print                        =  $unique_id_print.$print_group_unique_id;
            }
            else
            {
                $print_group_unique_id                  =   "";
                $unique_id_print                        =   $unique_id_print.$zero_x_padded;
            }
            $print_coded_value_id                       =   $dataitemid_padded . "." . $uniquecodeId_padded;






            if($temp_data_item_name!=$pages->dataItemName)
            {
                $temp_data_item_name        = $pages->dataItemName;
                $unique_id_print_first      = "RDI.".$dataitemid_padded.".".$zero_x_padded.".V1.0".".".$zero_x_padded.".".$zero_x_padded.".".$zero_x_padded.".".$zero_x_padded;
                $dataarraystore[$arraycountdata]['rbukh']                   = "RDI";
                $dataarraystore[$arraycountdata]['dataitemid_padded']       = $dataitemid_padded;
                $dataarraystore[$arraycountdata]['dataItemName']            = $pages->dataItemName;
                $dataarraystore[$arraycountdata]['codedValue']              = "";
                $dataarraystore[$arraycountdata]['codedValueDescription']   = "";
                $dataarraystore[$arraycountdata]['dataItemVersionId']       = "V1.0";
                $dataarraystore[$arraycountdata]['dataitemid_padded_new']   = $dataitemid_padded.".".$zero_x_padded;
                $dataarraystore[$arraycountdata]['uploadedDate']            = "";
                $dataarraystore[$arraycountdata]['created_at']              = "";
                $dataarraystore[$arraycountdata]['mappin_uni_id_print']     = "";
                $dataarraystore[$arraycountdata]['mappedId_padded_print']   = "";
                $dataarraystore[$arraycountdata]['groupuniid_padded_print'] = "";
                $dataarraystore[$arraycountdata]['groupName']               = "";
                $dataarraystore[$arraycountdata]['groupType']               = "";
                $dataarraystore[$arraycountdata]['unique_id_print']         = $unique_id_print_first;
                $arraycountdata++;
            }






            $dataarraystore[$arraycountdata]['rbukh']   = "RDI";
            $dataarraystore[$arraycountdata]['dataitemid_padded'] = $dataitemid_padded;
            $dataarraystore[$arraycountdata]['dataItemName'] = $pages->dataItemName;
            $dataarraystore[$arraycountdata]['codedValue'] = $pages->codedValue;
            $dataarraystore[$arraycountdata]['codedValueDescription'] = $pages->codedValueDescription;
            $dataarraystore[$arraycountdata]['dataItemVersionId'] = "V1." . $pages->dataItemVersionId;
            $dataarraystore[$arraycountdata]['dataitemid_padded_new'] = $print_coded_value_id;
            $dataarraystore[$arraycountdata]['uploadedDate'] = $pages->uploadedDate;
            $dataarraystore[$arraycountdata]['created_at'] = $pages->created_at;
            $dataarraystore[$arraycountdata]['mappin_uni_id_print'] = $print_mapping_id;
            $dataarraystore[$arraycountdata]['mappedId_padded_print'] = $print_mapping_data_item_id;
            $dataarraystore[$arraycountdata]['groupuniid_padded_print'] = $print_group_unique_id;
            $dataarraystore[$arraycountdata]['groupName'] = $pages->groupName;
            $dataarraystore[$arraycountdata]['groupType'] = $pages->groupType;
            $dataarraystore[$arraycountdata]['unique_id_print'] = $unique_id_print;
            $arraycountdata++;
        }















//        $ddtempdataitem = array();
//        $uniquecodeId = 1;
//        foreach ($nationaldataidarr as $keynational => $itemnational) {
//            $definitions_data_mapping_national = DB::table('emnationalcodedvalues')
//                ->leftjoin('emconceptreferencedata', 'emnationalcodedvalues.nationalReferenceId', '=', 'emconceptreferencedata.conceptReferenceDataId')
//                ->where('emnationalcodedvalues.codedValueId', '=', $itemnational)
//                ->get();
//
//
//            foreach ($definitions_data_mapping_national as $keynational_ret => $itemnational_ret) {
//
//
//                if (!in_array($itemnational_ret->ddItemName, $ddtempdataitem)) {
//                    $dataitemid++;
//                    $uniquecodeId = 1;
//                }
//                if ($itemnational_ret->ddItemCodeText == "") {
//                    $uniquecodeId = 0;
//                } else {
//                    if ($uniquecodeId == 1) {
//
//                        $zero_x_padded = sprintf("%05d", 0);
//                        $dataitemid_padded = "\t" . sprintf("%05d", $itemnational_ret->codedValueId);
//                        $unique_id_print = "UKHF.".$dataitemid_padded . "." . $zero_x_padded ."." . $zero_x_padded . "." . $zero_x_padded . "." . $zero_x_padded . "." . $zero_x_padded;
//                        $uniquecodeId_rep_show = 1;
//                        $dataarraystore[$arraycountdata]['rbukh'] = "UKHF";
//                        $dataarraystore[$arraycountdata]['dataitemid_padded'] = $dataitemid_padded;
//                        $dataarraystore[$arraycountdata]['dataItemName'] = $itemnational_ret->ddItemName;
//                        $dataarraystore[$arraycountdata]['codedValue'] = "";
//                        $dataarraystore[$arraycountdata]['codedValueDescription'] = "";
//                        $dataarraystore[$arraycountdata]['dataItemVersionId'] = "";
//                        $dataarraystore[$arraycountdata]['dataitemid_padded_new'] = $dataitemid_padded . "." . $zero_x_padded;
//                        $dataarraystore[$arraycountdata]['uploadedDate'] = "";
//                        $dataarraystore[$arraycountdata]['created_at'] = "";
//                        $dataarraystore[$arraycountdata]['mappin_uni_id_print'] = "";
//                        $dataarraystore[$arraycountdata]['mappedId_padded_print'] = "";
//                        $dataarraystore[$arraycountdata]['groupuniid_padded_print'] = "";
//                        $dataarraystore[$arraycountdata]['groupName'] = "";
//                        $dataarraystore[$arraycountdata]['groupType'] = "";
//                        $dataarraystore[$arraycountdata]['unique_id_print'] = $unique_id_print;
//
//                        $arraycountdata++;
//                    }
//                }
//                $dataitemid_padded = "\t" . sprintf("%05d", $itemnational_ret->codedValueId);
//                $uniquecodeId_padded = sprintf("%05d", $uniquecodeId);
//                $zero_padded = sprintf("%05d", 0);
//
//
//                $unique_id_print = "UKHF.".$dataitemid_padded . "." . $uniquecodeId_padded . ".V1.0" . "." . $zero_padded . "." . $zero_padded . "." . $zero_padded . "." . $zero_padded;
//
//
//                $dataarraystore[$arraycountdata]['rbukh'] = "UKHF";
//                $dataarraystore[$arraycountdata]['dataitemid_padded'] = $dataitemid_padded;
//                $dataarraystore[$arraycountdata]['dataItemName'] = $itemnational_ret->ddItemName;
//                $dataarraystore[$arraycountdata]['codedValue'] = $itemnational_ret->ddItemCodeText;
//                $dataarraystore[$arraycountdata]['codedValueDescription'] = $itemnational_ret->ddCodedValueDescription;
//                $dataarraystore[$arraycountdata]['dataItemVersionId'] = 1;
//                $dataarraystore[$arraycountdata]['dataitemid_padded_new'] = $dataitemid_padded . "." . $uniquecodeId_padded;
//                $dataarraystore[$arraycountdata]['uploadedDate'] = $itemnational_ret->createdDate;
//                $dataarraystore[$arraycountdata]['created_at'] = $itemnational_ret->createdDate;
//                $dataarraystore[$arraycountdata]['mappin_uni_id_print'] = "";
//                $dataarraystore[$arraycountdata]['mappedId_padded_print'] = "";
//                $dataarraystore[$arraycountdata]['groupuniid_padded_print'] = "";
//                $dataarraystore[$arraycountdata]['groupName'] = "";
//                $dataarraystore[$arraycountdata]['groupType'] = "";
//                $dataarraystore[$arraycountdata]['unique_id_print'] = $unique_id_print;
//                $arraycountdata++;
//                $ddtempdataitem[] = $itemnational_ret->ddItemName;
//                $uniquecodeId++;
//            }
//
//
//        }

        $slnorep = 0;
        foreach ($dataarraystore as $itemputcsv) {
            $slnorep++;
            fputcsv($fp, array($slnorep, $itemputcsv["rbukh"], $itemputcsv["dataitemid_padded"], $itemputcsv["dataItemName"], $itemputcsv["codedValue"],
                $itemputcsv["codedValueDescription"], $itemputcsv["dataItemVersionId"], $itemputcsv["dataitemid_padded_new"], $itemputcsv["uploadedDate"],
                $itemputcsv["created_at"], $itemputcsv["mappin_uni_id_print"], $itemputcsv["mappedId_padded_print"], $itemputcsv["groupuniid_padded_print"],
                $itemputcsv["groupName"], $itemputcsv["groupType"], $itemputcsv["unique_id_print"]));
        }

        exit;
        return view('admin.datamanagement.export-data', compact('definitions_data', 'dditems', 'selected'));

    }

    public function getExportData()
    {


        $definitions_data = DB::table('emconceptreferencedata')
            ->leftjoin('emdefinitionstable', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emdefinitionstable.referenceDetailId')
            ->leftjoin('emdatawizard', 'emdefinitionstable.definitionID', '=', 'emdatawizard.referenceDetailId')
            ->leftjoin('emaeadatadefinition', 'emconceptreferencedata.conceptReferenceDataId', '=', 'emaeadatadefinition.referenceId')
            ->leftjoin('emgroupinfo', 'emdefinitionstable.definitionID', '=', 'emgroupinfo.referenceDetailId')
            ->leftjoin('users', 'emconceptreferencedata.userId', '=', 'users.id')
            ->orderBy('emdefinitionstable.dataItemName')
            ->get();


        return view('admin.datamanagement.export-data', compact('definitions_data', 'dditems', 'selected'));


    }


}
