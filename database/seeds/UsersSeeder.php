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
        DB::table('users')->insert([
            'name' => 'Test User 1',
            'email' => 'test@example.com',
            'password' => bcrypt('123456'),
        ]);

        DB::table('users')->insert([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => bcrypt('123456'),
            'isStuco' => true
        ]);
    }
}
