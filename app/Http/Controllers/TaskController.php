<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Achievement;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB; 
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function getTasks(Request $request){
        $user_id = $request->user()->id;
        $SQL = <<< SQL
        SELECT tasks.id, tasks.task_name, tasks.description, genres.genre_name, difficulties.difficulty_name, 
            CASE WHEN user_id IS NULL THEN 0 ELSE 1 END AS is_achieve 
        FROM tasks 
        LEFT JOIN ( 
            SELECT * FROM achievements WHERE user_id = ?
        ) AS A ON tasks.id = A.task_id 
        JOIN genres ON genres.id = tasks.genre_id 
        JOIN difficulties ON difficulties.id = tasks.difficulty_id
        SQL;

        $tasks = DB::select($SQL, [$user_id]);
        return $tasks;
    }
}
