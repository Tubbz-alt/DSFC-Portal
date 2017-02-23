<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUsers extends Model
{
	public $primaryKey = 'user_id';
    protected $table = 'role_users';
}
