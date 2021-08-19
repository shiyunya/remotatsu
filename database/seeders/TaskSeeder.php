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
             'description' => "- 無闇に＠hereや@channelを使わないでユーザーグループをメンションとして使う配慮ができている¥n"
                            . "- Slackチャンネルを優先順位など、何かしらの基準によってセクション毎に分けている¥n"
                            . "- Slackで相手からDMで呼び掛けられた場合、そのやりとりがDMである必要がない場合は、適切なパブリックチャンネルでやりとりを続けるように促す事ができている¥n"
                            . "- 業務上仕方がない場合をのぞき、SlackのDMを使わないようにしている",
             'genre_id' => 1 ,
             'difficulty_id' => 1],
            ['task_name' => '下記のPCの基本的な使い方を実施している',
             'description' => "- PCのデスクトップ画面は整理されており、画面共有をして動画で記録が残っても機密情報の観点から問題が無いように配慮されている¥n"
                             . "- ブラウザのブックマークバーは画面共有をして動画で記録が残っても機密情報の観点から問題が無いように配慮されている¥n",
             'genre_id' => 1 ,
             'difficulty_id' => 1],
            ['task_name' => '下記ビデオ会議における基本的な使い方を実施している',
             'description' => "- ビデオ（Zoomなど）会議において、必要に応じて（本人判断で良い）できる範囲で、ビデオ通知をONにして顔がわかる状態にしている。¥n"
                            . "- Zoom会議においてゆめみ公式ロゴが入ったバーチャル背景を設定できる準備ができている¥n"
                            . "- ビデオ会議において、照明・ライティングを工夫しており、相手にとって暗く見えないようにできている¥n",
             'genre_id' => 1 ,
             'difficulty_id' => 1],
            ['task_name' => 'マーケティングソリューション事業部メンバーは、Guild（稼働管理ツール）の自分の稼働状況の更新を期間中３回以上行い、最新の状態に保った',
             'genre_id' => 1 ,
             'difficulty_id' => 1],
            ['task_name' => 'バーチャルオフィスツールoViceを３回以上利用したことがある',
             'genre_id' => 1 ,
             'difficulty_id' => 2],
            ['task_name' => 'バーチャルオフィスツールoViceを４回以上利用したことがある',
             'genre_id' => 1 ,
             'difficulty_id' => 2],
            ['task_name' => 'バーチャルオフィスツールoViceを５回以上利用したことがある',
             'genre_id' => 1 ,
             'difficulty_id' => 2]
        ];

        foreach($tasks as $task) {
            Task::create($task);
        }
    }
}
