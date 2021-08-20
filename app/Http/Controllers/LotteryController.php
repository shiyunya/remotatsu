<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Achievement;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB; 
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

const MIN_ACHIEVEMENTS = 15;

class LotteryController extends Controller
{
    public function user_status(Request $request){
        $user = $request->user();
        $achievements_count = $user->achievements()->count();
        $is_voted = $user->vote()->exists();

        return response()->json([
            'is_admin' => ($user->is_admin == 1),
            "can_vote" => ($achievements_count >= MIN_ACHIEVEMENTS && ! $is_voted),
            "is_voted" => $is_voted
        ], Response::HTTP_OK);
    }

    public function vote(Request $request){
        $user = $request->user();
        $user_id = $user->id;

        $achievements_count = $user->achievements()->count();
        $is_voted = $user->vote()->exists();

        if ($achievements_count < MIN_ACHIEVEMENTS){
            return response()->json(['message' => 'Achievements is not enough'], Response::HTTP_BAD_REQUEST);
        }
        if ($is_voted){
            return response()->json(['message' => 'Already voted'], Response::HTTP_BAD_REQUEST);
        }
        
        DB::beginTransaction();
        try {
            $user->vote()->create(['voted_number' => $request->voted_number]);
            DB::commit();

            return response()->json(['message' => 'OK'], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Error occured'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_winner(Request $request){
        $user = $request->user();

        if ( ! $user->is_admin){
            return response()->json(['message' => 'You are not admin'], Response::HTTP_BAD_REQUEST);
        }

        $win_vote = Vote::groupBy('voted_number')
                ->select('voted_number', DB::raw('count(*) as voted_count'))
                ->having('voted_count', 1)
                ->orderBy('voted_number')
                ->first();
        
        if ($win_vote === null){
            return response()->json(['message' => 'No one won'], Response::HTTP_OK);
        }

        $win_number = $win_vote->voted_number;
        $winner_id = Vote::where("voted_number", $win_number)->first()->user->id;

        return response()->json(['user_id' => $winner_id, 'win_number' => $win_number], Response::HTTP_OK);
    }
}
