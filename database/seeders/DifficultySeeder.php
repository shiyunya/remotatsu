<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Difficulty;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        DB::table('difficulties')->delete();
        $difficulties = [
            ['difficulty_name' => '初級'],
            ['difficulty_name' => '中級'],
            ['difficulty_name' => '上級']
        ];

        foreach($difficulties as $difficulty) {
            Difficulty::create($difficulty);
        }
    }
}
