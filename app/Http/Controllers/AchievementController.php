<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Symfony\Component\HttpFoundation\Response;
use App\Models\Achievement;
use App\Http\Requests\AchievementRequest;

class AchievementController extends Controller
{
    public function putAchievements(AchievementRequest $request){
        $user_id = $request->user()->id;
        $task_ids = $request->task_ids;
        
        $values = array();
        foreach($task_ids as $task_id){
            $values[] = ['user_id' => $user_id, 'task_id' => $task_id];
        }
        
        DB::beginTransaction();
        try {
            Achievement::where('user_id', $user_id)->delete();
            DB::table('achievements')->insert($values);
            DB::commit();

            return Response::HTTP_OK;
        } catch (\Exception $e) {
            DB::rollback();

            return Response::HTTP_INTERNAL_SERVER_ERROR;
        }
    }
}
