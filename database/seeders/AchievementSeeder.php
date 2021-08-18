<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $achievements = [
            ['user_id' => 1,
             'task_id' => 1]
        ];

        foreach($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}
