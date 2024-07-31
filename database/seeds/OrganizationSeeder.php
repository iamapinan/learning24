<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('organization')->insert([
            ['title' => 'ส่วนกลาง', 'type_id' => 1, 'user_limit' => 0, 'status' => 1],
        ]);
    }
}
