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
        $negatives = [

            ['task_name' => '感情的になって暴言・暴力的な発言を会議やSlackで行った',
            'is_negative' => true],
            ['task_name' => '事実の有無に関わらず、社員の社内評価を下げるような発言を会議やSlackで行った',
            'is_negative' => true]
        ];

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
             'description' => "",
             'genre_id' => 1 ,
             'difficulty_id' => 1],
            ['task_name' => 'バーチャルオフィスツールoViceを３回以上利用したことがある',
             'description' => "",
             'genre_id' => 1 ,
             'difficulty_id' => 2],
            ['task_name' => 'バーチャルオフィスツールoViceを４回以上利用したことがある',
             'description' => "",
             'genre_id' => 1 ,
             'difficulty_id' => 2],
            ['task_name' => 'バーチャルオフィスツールoViceを５回以上利用したことがある',
             'description' => "",
             'genre_id' => 1 ,
             'difficulty_id' => 2],
            ['task_name' => '集中して仕事を行う目的の机の上は整理されている（創造する時の脳の働きは集中する時の脳とは部位が別である。従って、敢えて散逸的な机の方が良い場合もあるが、その場合も集中して作業をするエリアを机の上で分離した上で、そのエリアは整理がされていること）',
            'description' => "",
            'genre_id' => 2,
            'difficulty_id' => 1],
            ['task_name' => '自宅での作業環境を、自宅の環境・制約がある中でも、自身なりに工夫して構築した。必ずしも最適な環境が整っている必要はない',
            'description' => "",
            'genre_id' => 2,
            'difficulty_id' => 1],
            ['task_name' => '音声通話においては、最低限の通話品質を維持する為の工夫を行っている（例：ヘッドセットの利用、ミュートを行うようにする等でも良い）',
            'description' => "",
            'genre_id' => 2,
            'difficulty_id' => 1],
            ['task_name' => 'Slackに依存しないように、未読を見るタイミングは１日３回などと決めて概ねコントロールができている（１週間の中で４日以上）',
            'description' => "",
            'genre_id' => 2,
            'difficulty_id' => 2],
            ['task_name' => 'SNSに依存しないように、見るタイミングを定めて概ねコントロールができている（１週間の中で４日以上）',
            'description' => "",
            'genre_id' => 2,
            'difficulty_id' => 2],
            ['task_name' => 'PCにおいて多くのアプリケーションを必要がないのに一度に沢山開くような事はしていない',
            'description' => "",
            'genre_id' => 2,
            'difficulty_id' => 2],
            ['task_name' => '自分のOJTチャンネルへの投稿日数が月間平均３日以上となっている',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 1],
            ['task_name' => '自分のOJTチャンネルへの投稿日数が月間平均５日以上となっている',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 1],
            ['task_name' => 'オンライン会議における（例えばチェックインよる）雑談・自己開示を期間中１回以上行った',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 1],
            ['task_name' => 'チェックイン、チェックアウト、アイスブレイク、ディープイン、ディープアウトなどslackbotを活用したOJTチャンネルへの投稿を月間平均１件以上実施できている',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 2],
            ['task_name' => 'チェックイン、チェックアウト、アイスブレイク、ディープイン、ディープアウトなどslackbotを活用したOJTチャンネルへの投稿を月間平均３件以上実施できている',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 2],
            ['task_name' => 'チェックイン、チェックアウト、アイスブレイク、ディープイン、ディープアウトなどslackbotを活用したOJTチャンネルへの投稿を月間平均５件以上実施できている',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 2],
            ['task_name' => 'チェックイン、チェックアウト、アイスブレイク、ディープイン、ディープアウトなどslackbotを活用したOJTチャンネルへの投稿を月間平均７件以上実施できている',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 2],
            ['task_name' => 'チェックイン、チェックアウト、アイスブレイク、ディープイン、ディープアウトなどslackbotを活用したOJTチャンネルへの投稿を月間平均９件以上実施できている',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 2],
            ['task_name' => '自分が知らないこと、分からないことをOJTチャンネルで披露することが期間中一度でもできた',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 2],
            ['task_name' => '自分のミスや失敗をOJTチャンネルで披露することが期間中一度でもできた',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 2],
            ['task_name' => '他人の新しい試み、実験、挑戦に対して、称賛やエールを贈ることが期間中一度でもできた',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 3],
            ['task_name' => '他人からの異論や反論を快く受け入れることが期間中一度でもできた',
            'description' => "",
            'genre_id' => 3,
            'difficulty_id' => 3]
        ];

        Task::insert($negatives);
        Task::insert($tasks);
    }
}
