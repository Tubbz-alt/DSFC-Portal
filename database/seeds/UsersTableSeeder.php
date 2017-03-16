<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'email' => 'testuser@gmail.com',
                'password' => '$2y$10$.raS3sag7YBCiPHvKI.fi.jG/K4m4H4DlZD/LbsC6e8V21aiNxNL.',
                'username' => 'testuser',
                'permissions' => 'admin',
                'last_login' => '2017-03-16 14:34:32',
                'first_name' => 'test',
                'last_name' => 'user',
                'created_at' => '2016-10-17 20:57:27',
                'updated_at' => '2017-03-16 14:34:32',
            ),
            1 => 
            array (
                'id' => 2,
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$JPV.vJFKgvxt2s5Be2Jqm.aKWyVvAifqw0/opNaMETPQj.Mq6ZeYG',
                'username' => 'admin',
                'permissions' => 'admin',
                'last_login' => '2017-03-16 14:38:06',
                'first_name' => 'admin',
                'last_name' => 'admin',
                'created_at' => '2016-10-17 21:09:17',
                'updated_at' => '2017-03-16 14:38:06',
            ),
        ));
        
        
    }
}
