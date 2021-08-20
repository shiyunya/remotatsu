<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Achievement;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB; 
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

const MIN_ACHIEVEMENTS = 15;

class LotteryController extends Controller
{
    public function user_status(Request $request){
        $user = $request->user();
        $achievements_count = $user->achievements()->count();

        return response()->json([
            'is_admin' => ($user->is_admin == 1),
            "can_vote" => ($achievements_count >= MIN_ACHIEVEMENTS)
        ]);
    }
}
