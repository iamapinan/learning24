<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            ['id' => 1, 'title' => 'ภาษาไทย', 'parent_id' => null],
            ['id' => 2, 'title' => 'คณิตศาสตร์', 'parent_id' => null],
            ['id' => 3, 'title' => 'วิทยาศาสตร์', 'parent_id' => null],
            ['id' => 4, 'title' => 'สังคมศึกษา ศาสนา และวัฒนธรรม', 'parent_id' => null],
            ['id' => 5, 'title' => 'สุขศึกษาและพลศึกษา', 'parent_id' => null],
            ['id' => 6, 'title' => 'ศิลปะ', 'parent_id' => null],
            ['id' => 7, 'title' => 'การงานอาชีพและเทคโนโลยี', 'parent_id' => null],
            ['id' => 8, 'title' => 'ภาษาต่างประเทศ', 'parent_id' => null]
        ]);
    }
}
