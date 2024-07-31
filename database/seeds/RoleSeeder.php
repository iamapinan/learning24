<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // seed roles
        DB::table('roles')->insert([
            ['name' => 'User', 'description' => 'User role'],
            ['name' => 'Teacher', 'description' => 'Teacher role'],
            ['name' => 'Admin', 'description' => 'Administrator role'],
        ]);
    }
}
