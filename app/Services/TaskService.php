<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TaskService{

    public function getTasks($user_id){

        $SQL = <<< SQL
        SELECT tasks.id, tasks.task_name, tasks.description, genres.genre_name, difficulties.difficulty_name, 
            CASE WHEN user_id IS NULL THEN 0 ELSE 1 END AS is_achieve 
        FROM tasks 
        LEFT JOIN ( 
            SELECT * FROM achievements WHERE user_id = ?
        ) AS A ON tasks.id = A.task_id 
        LEFT JOIN genres ON genres.id = tasks.genre_id 
        LEFT JOIN difficulties ON difficulties.id = tasks.difficulty_id
        ORDER BY genres.id, difficulties.id, tasks.id
        SQL;

        $tasks = DB::select($SQL, [$user_id]);
        return $tasks;
    }

    public function postTask($task_name, $description, $genre_id, $difficulty_id){

        $value = [
            "task_name" => $task_name,
            "description" => $description,
            "genre_id" => $genre_id,
            "difficulty_id" => $difficulty_id
        ];
        Task::create($value);

    }

}