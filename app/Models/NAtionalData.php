<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class NAtionalData extends Model
{
    protected $table = 'emnationalcodedvalues';
    public $timestamps = false;

    public static function getSearchData($field,$search)
    {
    	$database_table = DB::table('emnationalcodedvalues')
						
						->where("$field", 'LIKE', '%' . $search . '%')
						->paginate(Config::get('constants.pagination_limit'));
		return $database_table;
    }

    public static function getAllData()
    {
    	$database_table = DB::table('emnationalcodedvalues')->paginate(Config::get('constants.pagination_limits'));
    	return $database_table;
    }

    
}
