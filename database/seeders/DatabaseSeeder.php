<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(UserSeeder::class);
        $this->call(UserVoteSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(DifficultySeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(CheckSeeder::class);
        //$this->call(VoteSeeder::class);
    }
}
