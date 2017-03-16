<?php

use Illuminate\Database\Seeder;

class ActivationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('activations')->delete();
        
        \DB::table('activations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'code' => 'OiAghqKcByQyd0C6myERrYrSgihT48Ga',
                'completed' => 1,
                'completed_at' => '2016-10-17 20:55:26',
                'created_at' => '2016-10-17 20:55:26',
                'updated_at' => '2016-10-17 20:55:26',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'code' => '89Ret6sMR0r24JfQHNa94vnUW0LZ6UHd',
                'completed' => 1,
                'completed_at' => '2016-10-17 20:57:27',
                'created_at' => '2016-10-17 20:57:27',
                'updated_at' => '2016-10-17 20:57:27',
            ),
        ));
        
        
    }
}
