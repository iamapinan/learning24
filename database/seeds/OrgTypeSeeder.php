<?php

use Illuminate\Database\Seeder;

class OrgTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create seeder here for org_type
        DB::table('org_type')->insert([
            ['type_name' => 'ส่วนกลาง', 'type_name_eng' => 'school', 'user_limit' => 100, 'grades' => json_encode([1, 2, 3, 4, 5, 6])],
            ['type_name' => 'สถานศึกษา', 'type_name_eng' => 'education', 'user_limit' => 100, 'grades' => json_encode([1, 2, 3, 4, 5, 6])],
            ['type_name' => 'องค์กร', 'type_name_eng' => 'organization', 'user_limit' => 100, 'grades' => json_encode([1, 2, 3, 4, 5, 6])],
        ]);

    }
}
