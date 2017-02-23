<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	          'slug' => 'user',
                 	  'name' => 'user',
                      'default' => 'true',
                 	  'created_at' => date('Y-m-d H:i:s'),
                 	  'updated_at' => date('Y-m-d H:i:s')]);
    }
}
