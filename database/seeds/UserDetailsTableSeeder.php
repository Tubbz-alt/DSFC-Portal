<?php

use Illuminate\Database\Seeder;

class UserDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_details')->delete();
        
        \DB::table('user_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'organisation' => 'NHS Organisation',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'organisation' => 'NHS Organisation',
            ),
        ));
        
        
    }
}
