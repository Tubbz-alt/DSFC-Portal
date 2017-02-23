<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use DB;

class Devices extends Model
{
    protected $table = 'devices';
	protected $fillable = array('user_id','device_name','device_details','device_id','pin');
    public $primaryKey = 'id';

    public static function getUniqPin($length)
    {
    	$random_code = '';
        $keys = array_merge(range(0, 9), range('A', 'Z'));
        for ($i = 0; $i < $length; $i++) 
        {
            $random_code .= $keys[array_rand($keys)];
        }
        $pin = $random_code;

    	$count = Devices::where('pin','=',$pin)->count();

	 	if (!$count)
            return $pin;
        else
            self::getUniqPin($length);
    }

    public static function getAllPinDetails()
    {
    	 $client =  DB::table('users')
              		->join('devices', 'users.id', '=', 'devices.user_id')
					->join('role_user', 'role_user.user_id', '=', 'users.id')
					->where('role_user.role_id',2)
					->get();
        return $client;
    }

}
