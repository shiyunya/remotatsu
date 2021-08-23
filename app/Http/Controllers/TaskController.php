<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB; 
use Symfony\Component\HttpFoundation\Response;
use App\Services\TaskService;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskservice){
        $this->taskService = $taskservice;
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
}
