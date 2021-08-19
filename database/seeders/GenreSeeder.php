<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        DB::table('genres')->delete();
        $genres = [
            ['genre_name' => 'リモートワークツール利用'],
            ['genre_name' => '環境デザイン'],
            ['genre_name' => 'フィードバック'],
            ['genre_name' => '生活習慣・食習慣'],
            ['genre_name' => 'アクティブレスト・運動習慣'],
            ['genre_name' => '睡眠'],
            ['genre_name' => 'ワークハックマスター'],
            ['genre_name' => '思考習慣']
        ];

        foreach($genres as $genre) {
            Genre::create($genre);
        }
    }
}
