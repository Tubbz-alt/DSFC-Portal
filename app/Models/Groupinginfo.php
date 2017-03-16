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
}
