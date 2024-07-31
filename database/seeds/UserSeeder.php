<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@learning24.xyz',
            'init_password' => '12345678',
            'password' => bcrypt('12345678'),
            'organization' => 'Admin',
            'user_org_id' => 1,
            'role_id' => 1,
            'birthday' => '1999-01-01',
            'email_verified_at' => now(),
            'email_verified' => 1,
            'email_verification_token' => '',
            'remember_token' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
