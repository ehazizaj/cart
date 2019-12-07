<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('users')->get()->count() == 0) {
            DB::table('users')->insert([
                'name' => "Admin",
                'email' => "admin@gmail.com",
                'password' => bcrypt('admin1234'),
                'isAdmin' => 1,
                'created_at' => now()
            ]);

            DB::table('users')->insert([
                'name' => "User",
                'email' => "user@gmail.com",
                'password' => bcrypt('user1234'),
                'isAdmin' => 0,
                'created_at' => now()
            ]);
        }
    else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
