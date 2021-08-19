<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
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
        $users = User::all();
        $tasks = Task::all();

        foreach($users as $user){
            foreach($tasks as $task){
                if (rand() % 2 == 0){
                    $user->achievements()->create(['task_id' => $task->id]);
                }
            }
        }

    }
}
