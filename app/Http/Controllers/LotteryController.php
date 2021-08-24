<?php

namespace App\Http\Controllers;

use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB; 
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Achievement;
use App\Services\LotteryService;
use App\Http\Requests\VoteRequest;

const MIN_ACHIEVEMENTS = 15;

class LotteryController extends Controller
{
    private $lotteryService;

    public function __construct(LotteryService $lotteryService ){
        $this->lotteryService = $lotteryService;
    }

    public function user_status(Request $request){
        $user = $request->user();

        DB::beginTransaction();
        try {
            $is_admin = $this->lotteryService->is_admin($user);
            $is_voted = $this->lotteryService->is_voted($user);
            $can_vote = $this->lotteryService->can_vote($user);
            DB::commit();

            return response()->json([
                'is_admin' => $is_admin,
                "is_voted" => $is_voted,
                "can_vote" => $can_vote
            ], Response::HTTP_OK);

        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(['message' => 'Error occured'], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function vote(VoteRequest $request){
        $user = $request->user();
        $voted_number = $request->voted_number;

        DB::beginTransaction();
        try {

            // if ($this->lotteryService->is_admin($user)){
            //     DB::commit();
            //     return response()->json(['message' => 'Admin can not vote'], Response::HTTP_BAD_REQUEST);
            // }
            // if ($this->lotteryService->is_voted($user)){
            //     DB::commit();
            //     return response()->json(['message' => 'Already voted'], Response::HTTP_BAD_REQUEST);
            // }
            // if ($this->lotteryService->achievements_count($user) < MIN_ACHIEVEMENTS){
            //     DB::commit();
            //     return response()->json(['message' => 'Achievements is not enough'], Response::HTTP_BAD_REQUEST);
            // 

            $message = $this->lotteryService->can_vote($user);
            $http_status = Response::HTTP_OK;
            return $message;
            if ($message == "OK"){
                $this->lotteryService->vote($user, $voted_number);
            }else{
                $http_status = Response::HTTP_BAD_REQUEST;
            }

            DB::commit();
            return response()->json(['message' => $message], $http_status);

        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(['message' => 'Error occured'], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function get_winner(Request $request){
        $user = $request->user();

        DB::beginTransaction();
        try {
            if ( !$this->lotteryService->is_admin($user)){
                DB::commit();
                return response()->json(['message' => 'You are not admin'], Response::HTTP_BAD_REQUEST);
            }

            $win_vote = $this->lotteryService->win_vote();

            if ($win_vote === null){
                DB::commit();
                return response()->json(['message' => 'No one won'], Response::HTTP_OK);
            }

            $win_number = $win_vote->voted_number;
            $winner_id = $this->lotteryService->winner_id($win_number);

            DB::commit();
            return response()->json(['user_id' => $winner_id, 'win_number' => $win_number], Response::HTTP_OK);

        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(['message' => 'Error occured'], Response::HTTP_INTERNAL_SERVER_ERROR);
            
        }
    }
}
