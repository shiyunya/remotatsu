<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Vote;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = ['user_name' => 'admin', 'email' => 'admin', 'password' => Hash::make('admin')];
        
        $user_vote = [
            [['user_name' => 'Yumemi Taro',
             'email' => 'yumemitaro@yumemi.co.jp',
             'password' => 'yumemi'], 1],
             [['user_name' => 'Yumemi Hanako',
             'email' => 'yumemihanako@yumemi.co.jp',
             'password' => 'yumemi'], 3],
             [['user_name' => 'Yumemi Ichiro',
             'email' => 'yumemiichiro@yumemi.co.jp',
             'password' => 'yumemi'], 2],
             [['user_name' => 'Yumemi Jiro',
             'email' => 'yumemijiro@yumemi.co.jp',
             'password' => 'yumemi'], 3],
             [['user_name' => 'Yumemi Saburo',
             'email' => 'yumemisaburo@yumemi.co.jp',
             'password' => 'yumemi'], 1],
             [['user_name' => 'Alice Yumemi',
             'email' => 'aliceyumemi@yumemi.co.jp',
             'password' => 'yumemi'], 5],
             [['user_name' => 'Bob Yumemi',
             'email' => 'bobyumemi@yumemi.co.jp',
             'password' => 'yumemi'], 4],
             [['user_name' => 'Carol Yumemi',
             'email' => 'carolyumemi@yumemi.co.jp',
             'password' => 'yumemi'], 3]
        ];

        User::create($admin);

        foreach($user_vote as $data) {
            $data[0]['password'] = Hash::make($data[0]['password']);
            $new_user = User::create($data[0]);
            $new_user->vote()->create(['voted_number' => $data[1]]);
        }

    }
}
