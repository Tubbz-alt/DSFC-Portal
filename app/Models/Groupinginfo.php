<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Groupinginfo extends Model
{
    protected $table = 'emgroupinfo';
    public $timestamps = false;

    public static function insertData($data)
    {
        $response = DB::table('emgroupinfo')->insert($data);
        return $response;
    }
    
    public static function deleteData($condition=array())
    {
        $response = DB::table('emgroupinfo')->where($condition)->delete();
        return $response;
    }

    public static function getAllGroupInfo()
    {
        $response = DB::table('emgroupinfo')->get();
        return $response;
    }

    public static function updateRecord($condition=array(),$data=array())
    {
        $response = DB::table('emgroupinfo')->where($condition)->update($data);
        return $response;
    }
}
