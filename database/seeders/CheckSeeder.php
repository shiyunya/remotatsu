<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Check;

class CheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('checks')->delete();
        $checks = [
            ['user_id' => 1,
             'task_id' => 1]
        ];

        foreach($checks as $check) {
            Check::create($check);
        }
    }
}
