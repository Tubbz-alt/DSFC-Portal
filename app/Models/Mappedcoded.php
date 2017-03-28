<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Mappedcoded extends Model
{
    protected $table = 'emmappedcoded';
    public $timestamps = false;

	public static function getMappedData($id)
	{
		$data = DB::table('emmappedcoded')->where('mappedItemId','=',$id)->first();
		return $data;
	}

	public static function deleteRecord($id)
	{
		$data = DB::table('emmappedcoded')->where('mappedItemId','=',$id)->delete();
		return $data;
	}
}
