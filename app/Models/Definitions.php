<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Definitions extends Model
{
    protected $table = 'emdefinitionstable';

    public static function updateIsMapped($value=array(),$condition=array())
    {
    	$data = DB::table('emdefinitionstable')->where($condition)->update($value);
		return $data;
    }
}


