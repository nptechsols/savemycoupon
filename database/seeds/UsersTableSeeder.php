<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@savemycoupon.com',
            'password' => bcrypt('savemycoupon'),
            // 'mobile' => '1234567890',
            'role_id' => 1,
            
        ]);
    }
}
