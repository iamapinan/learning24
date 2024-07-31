<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('grade')->insert([
            ['title' => 'ทั้งหมด'],
            ['title' => 'ป.1'],
            ['title' => 'ป.2'],
            ['title' => 'ป.3'],
            ['title' => 'ป.4'],
            ['title' => 'ป.5'],
            ['title' => 'ป.6'],
            ['title' => 'ม.1'],
            ['title' => 'ม.2'],
            ['title' => 'ม.3'],
            ['title' => 'ม.4'],
            ['title' => 'ม.5'],
            ['title' => 'ม.6'],
        ]);
    }
}
