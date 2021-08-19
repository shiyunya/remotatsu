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
        SELECT tasks.id, task_name, description, genre_name, difficulty_name, 
            CASE WHEN user_id IS NULL THEN 0 ELSE 1 END AS is_achieve 
        FROM tasks 
        LEFT JOIN ( 
            SELECT * FROM achievements WHERE user_id = '{$user_id}'
        ) AS A ON tasks.id = A.task_id 
        JOIN genres ON genres.id = tasks.genre_id 
        JOIN difficulties ON difficulties.id = tasks.difficulty_id
        SQL;

        $tasks = DB::select($SQL);
        return $tasks;
    }

    public function putTasks(Request $request){
        $user_id = $request->user()->id;
        $task_achieves = $request->task_achieve;

        DB::beginTransaction();
        try {
            Achievement::where('user_id', $user_id)->delete();
            foreach($task_achieves as $task_achieve){
                if ($task_achieve['is_achieve'] == 1){
                    Achievement::create(['user_id' => $user_id, 'task_id' => $task_achieve['id']]);
                }
            }
            DB::commit();
            return Response::HTTP_OK;
        } catch (\Exception $e) {
            DB::rollback();
            return Response::HTTP_INTERNAL_SERVER_ERROR;
        }
    }
}
