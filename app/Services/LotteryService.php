<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Vote;

const MIN_ACHIEVEMENTS = 15;

class LotteryService{

    public function is_admin($user){
        return $user->is_admin;
    }

    public function is_voted($user){
        return $user->vote()->exists();
    }

    public function achievements_count($user){
        return $user->achievements()->count();
    }

    public function can_vote($user){
        return (!$this->is_admin($user) && !$this->is_voted($user) && $this->achievements_count($user) >= MIN_ACHIEVEMENTS);
    }

    public function vote($user, $voted_number){
        $user->vote()->create(['voted_number' => $voted_number]);
    }

    public function win_vote(){
        $win_vote = Vote::groupBy('voted_number')
                ->select('voted_number', DB::raw('count(*) as voted_count'))
                ->having('voted_count', 1)
                ->orderBy('voted_number')
                ->first();

        return $win_vote;
    }

    public function winner_id($win_number){
        return Vote::where("voted_number", $win_number)->first()->user->id;
    }

}