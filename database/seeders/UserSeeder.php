<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        DB::table('users')->delete();
        $users = [
            ['user_name' => 'Yumemi Taro',
             'email' => 'yumemitaro@yumimi.co.jp',
             'password' => 'yumemitaro']
           ];

        foreach($users as $user) {
            User::create($user);
        }
        
    }
}
