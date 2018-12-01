<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('announcements')->insert([
            'title' => 'announcement 1',
            'body' => 'this is the body of an announcement'
        ]);
    }
}
