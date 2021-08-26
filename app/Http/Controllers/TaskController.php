<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB; 
use Symfony\Component\HttpFoundation\Response;
use App\Services\TaskService;
use App\Services\LotteryService;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    private $taskService;
    private $lotteryService;

    public function __construct(TaskService $taskservice,LotteryService $lotteryservice){
        $this->taskService = $taskservice;
        $this->lotteryService = $lotteryservice;
    }

    public function getTasks(Request $request){
        $user_id = $request->user()->id;

        DB::beginTransaction();
        try {
            $tasks = $this->taskService->getTasks($user_id);
            DB::commit();

            return response()->json($tasks, Response::HTTP_OK);

        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(["message" => "Error occured"], Response::HTTP_INTERNAL_SERVER_ERROR);
            
        }
    }

    public function postTask(TaskRequest $request){
        $user = $request->user();
        $task_name = $request->task_name;
        $description = $request->description;
        $genre_id = $request->genre_id;
        $difficulty_id = $request->difficulty_id;

        DB::beginTransaction();
        try {
            if (!$this->lotteryService->is_admin($user)){
                DB::commit();
                return response()->json(["message" => "You are not admin"], Response::HTTP_BAD_REQUEST);
            }

            $this->taskService->postTask($task_name, $description, $genre_id, $difficulty_id);

            DB::commit();
            return response()->json(["message" => "OK"], Response::HTTP_OK);

        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(["message" => "Error occured"], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }
}
