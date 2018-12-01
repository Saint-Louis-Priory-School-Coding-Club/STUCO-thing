<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuggestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suggestions')->insert([
            'title' => 'suggestion 1',
            'body' => 'body of suggestion',
            'upvotes' => 4,
            'downvotes' => 2,
            'user_id' => 1
        ]);

        DB::table('suggestions')->insert([
            'title' => 'suggestion 2',
            'body' => 'body of suggestion',
            'upvotes' => 4,
            'downvotes' => 2,
            'is_completed' => true,
            'user_id' => 1
        ]);
    }
}
