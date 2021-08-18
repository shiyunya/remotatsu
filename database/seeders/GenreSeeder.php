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
            ['genre_name' => '環境デザイン']
        ];

        foreach($genres as $genre) {
            Genre::create($genre);
        }
    }
}
