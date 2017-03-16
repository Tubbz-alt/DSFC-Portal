<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class GroupData extends Model
{
    protected $table = 'emgroupinfo_data';
    public $timestamps = true;

    public static function getGroupName($group_name)
    {
        $dataExist = Groupinginfo::where('emgroupinfo.groupType', '=','DataType')
            ->where('emgroupinfo.GroupName', '=',$group_name)
            ->first();

        return $dataExist;
    }
    public static function getGroupNameCoded($group_name)
    {
        $dataExist = Groupinginfo::where('emgroupinfo.groupType', '=','coded')
            ->where('emgroupinfo.GroupName', '=',$group_name)
            ->first();

        return $dataExist;
    }

    public static function insertData($data)
    {
        $response = DB::table('emgroupinfo_data')->insert($data);
        return $response;
    }
    public static function getGroupId($id)
    {
        $response = DB::table('emgroupinfo_data')->where('id','=',$id)->first();
        return $response;
    }
    public static function GroupIdCount($id)
    {
        $response = DB::table('emgroupinfo_data')->where('group_id','=',$id)
            ->where('reference_data_id','<>',0)
            ->count();
        return $response;
    }
    public static function deleteData($condition=array())
    {
        $response = DB::table('emgroupinfo_data')->where($condition)->delete();
        return $response;
    }
    
}
