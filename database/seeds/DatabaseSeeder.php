<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();
        $this->call('UsersTableSeeder');
        $this->call('UserDetailsTableSeeder');
        $this->call('RoleUsersTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('EmnationaldditemsTableSeeder');
        $this->call('EmcolorcodesTableSeeder');
        $this->call('ActivationsTableSeeder');
    }
}
