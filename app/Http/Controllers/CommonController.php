<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CsvReferenca;
use App\Models\CsvReferenceDetails;
use App\Models\Comments;
use App\Models\Definitions;
use App\Models\Dditems;
use App\Models\ChangeRequest;
use Validator;
use DB;

class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataItem()
    {


        $definitions_data = DB::table('emdefinitionstable')
            ->whereNotIn('definitionID', function($q){
                $q->select('referenceDetailId')->from('emchangerequest');
            })->get();

        foreach($definitions_data as $data){
            echo "<tr> 
                <td class='text-center'><input class='wizard_list' name='wizard_list_request[]' value=$data->definitionID type='checkbox' ></td>
                   	<td class=\"text-center\"> $data->dataBaseName</td>
							<td class=\"text-center\"> $data->tableName</td>
							<td class=\"text-center\"> $data->dataItemName</td>
						
							<td class=\"text-center \"> $data->dataType</td>
							<td class=\"text-center \"> $data->requirement</td>
                </tr>";
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postChangeRequest(Request $request)
    {
        $data = $request->all();
        $created = date("Y-m-d H:i:s");
        $data_id = $data['checked'];
        $dataexist = ChangeRequest::whereIn('referenceDetailId',$data_id)->delete();


        foreach($data_id as $info){


                $changerequest=array(
                    'referenceDetailId'=>$info,
                    'status'=>0,
                    'requestComments'=>$request->input('comment'),
                    'createdDate' => $created,

                );

            ChangeRequest::insert($changerequest);

        }


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
