<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('subcat')->insert([
            ['title' => 'ภาษาไทย'],
            ['title' => 'คณิตศาสตร์'],
            ['title' => 'ศิลปะ'],
            ['title' => 'สุขศึกษาและพลศึกษา'],
            ['title' => 'สังคมศึกษา ศาสนา และวัฒนธรรม'],
            ['title' => 'วิทยาศาสตร์​และเทคโนโลยี'],
            ['title' => 'การงานอาชีพ'],
            ['title' => 'ภาษาต่างประเทศ'],
            ['title' => 'อื่นๆ'],
        ]);
    }
}
