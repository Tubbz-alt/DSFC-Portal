<?php

use Illuminate\Database\Seeder;

class RoleUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_users')->delete();
        
        \DB::table('role_users')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'role_id' => 2,
                'created_at' => '2016-11-21 11:43:38',
                'updated_at' => '2016-11-21 11:43:38',
            ),
            1 => 
            array (
                'user_id' => 2,
                'role_id' => 1,
                'created_at' => '2016-11-24 11:59:11',
                'updated_at' => '2016-11-24 11:59:11',
            ),
        ));
        
        
    }
}
