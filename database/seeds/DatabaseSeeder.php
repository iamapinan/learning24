<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SubCatSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(OrgTypeSeeder::class);
        $this->call(OrganizationSeeder::class);
    }
}
