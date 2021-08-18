<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Vote;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('votes')->delete();
        $votes = [
            ['user_id' => 1,
             'voted_number' => 1]
        ];

        foreach($votes as $vote) {
            Vote::create($vote);
        }
    }
}
