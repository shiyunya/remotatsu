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
        $admin = ['user_name' => 'admin', 'email' => 'admin@yumemi.co.jp', 'password' => Hash::make('admin'), 'is_admin' => 1];
        
        $users = [
            ['user_name' => 'Yumemi Taro',
             'email' => 'yumemitaro@yumemi.co.jp',
             'password' => 'yumemi'],
             ['user_name' => 'Yumemi Hanako',
             'email' => 'yumemihanako@yumemi.co.jp',
             'password' => 'yumemi'],
             ['user_name' => 'Yumemi Ichiro',
             'email' => 'yumemiichiro@yumemi.co.jp',
             'password' => 'yumemi'],
             ['user_name' => 'Yumemi Jiro',
             'email' => 'yumemijiro@yumemi.co.jp',
             'password' => 'yumemi'],
             ['user_name' => 'Yumemi Saburo',
             'email' => 'yumemisaburo@yumemi.co.jp',
             'password' => 'yumemi'],
             ['user_name' => 'Alice Yumemi',
             'email' => 'aliceyumemi@yumemi.co.jp',
             'password' => 'yumemi'],
             ['user_name' => 'Bob Yumemi',
             'email' => 'bobyumemi@yumemi.co.jp',
             'password' => 'yumemi'],
             ['user_name' => 'Carol Yumemi',
             'email' => 'carolyumemi@yumemi.co.jp',
             'password' => 'yumemi']
        ];

        User::create($admin);
        User::insert($users);

    }
}
