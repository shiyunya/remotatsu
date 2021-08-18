<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        DB::table('tasks')->delete();
        $tasks = [
            ['task_name' => '下記のSlackの基本的な使い方を実施している',
             'discription' => "- 無闇に＠hereや@channelを使わないでユーザーグループをメンションとして使う配慮ができている¥n"
                            . "- Slackチャンネルを優先順位など、何かしらの基準によってセクション毎に分けている¥n"
                            . "- Slackで相手からDMで呼び掛けられた場合、そのやりとりがDMである必要がない場合は、適切なパブリックチャンネルでやりとりを続けるように促す事ができている¥n"
                            . "- 業務上仕方がない場合をのぞき、SlackのDMを使わないようにしている",
             'genre_id' => 1 ,
             'difficulty_id' => 1]
        ];

        foreach($tasks as $task) {
            Task::create($task);
        }
    }
}
