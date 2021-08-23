<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Symfony\Component\HttpFoundation\Response;
use App\Services\AchievementService;

class AchievementController extends Controller
{
    private $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    public function putAchievements(Request $request){
        $user_id = $request->user()->id;
        $task_ids = $request->task_ids;
        
        DB::beginTransaction();
        try {
            $this->achievementService->putAchievements($user_id, $task_ids);
            DB::commit();
            
            return response()->json(["message" => "OK"], Response::HTTP_OK);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(["message" => "Error occured"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
