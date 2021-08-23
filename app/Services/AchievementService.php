<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Achievement;

class AchievementService{

    public function putAchievements($user_id, $task_ids){
        
        $values = array();
        foreach($task_ids as $task_id){
            $values[] = ['user_id' => $user_id, 'task_id' => $task_id];
        }

        Achievement::where('user_id', $user_id)->delete();
        Achievement::insert($values);

        return;
    }


}