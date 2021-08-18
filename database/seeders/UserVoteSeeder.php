<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Vote;
use App\Models\User;

class UserVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_vote = [
            [['user_name' => 'Yumemi Taro',
             'email' => 'yumemitaro@yumimi.co.jp',
             'password' => 'yumemitaro'], 1],
             [['user_name' => 'Yumemi Hanako',
             'email' => 'yumemihanako@yumimi.co.jp',
             'password' => 'yumemihanako'], 3]
        ];
    
        foreach($user_vote as $data) {
            $new_user = User::create($data[0]);
            $new_user->vote()->create(['voted_number' => $data[1]]);
        }
    }
}
