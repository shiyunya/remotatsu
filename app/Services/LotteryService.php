<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Vote;
use App\Models\Achievement;

const MIN_ACHIEVEMENTS = 15;

class LotteryService{

    public function is_admin($user){
        return $user->is_admin;
    }

    public function is_voted($user){
        return $user->vote()->exists();
    }

    public function is_ecnough($user){
        return $user->achievements()->count() >= MIN_ACHIEVEMENTS;
    }

    public function has_negative($user){
        return $user->has_negative();
    }


    public function userStatus($user){

        if ($this->is_admin($user))
            return "Admin can not vote";

        if ($this->is_voted($user))
            return "Already voted";

        if ($user->has_negative())
            return "You have negative check";

        if (!$this->is_ecnough($user))
            return "Achievements are not enough";
        
        return "OK";
    }

    public function can_vote($user){
        return (!$this->is_admin($user) && !$this->is_voted($user) && !$user->has_negative() && $this->is_ecnough($user));
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

    public function winner($win_number){
        return Vote::where("voted_number", $win_number)->first()->user;
    }
    
}