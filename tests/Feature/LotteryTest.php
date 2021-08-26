<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

use App\Models\User;
use App\Models\Genre;
use App\Models\Difficulty;
use App\Models\Task;

class LotteryTest extends TestCase
{
    use DatabaseTransactions;

    private $admin = [
            'user_name' => 'admin',
            'email' => 'newadmin@yumemi.co.jp',
            'password' => 'admin',
            'is_admin' => true
        ];
    private $user = [
            'email' => 'user@example.com',
            'user_name' => 'Tanaka Taro',
            'password' => '123456',
            'is_admin' => false
        ];
    private $vote = ['voted_number' => 10];

    protected function setUp(): Void // ※ Voidが必要
    {
        // 必ずparent::setUp()を呼び出す
        parent::setUp(); 
        
    }
    
    public function testUserStatusが取得できる()
    {
        Sanctum::actingAs(
            User::create($this->user),
            ['*']
        );
        $response = $this->get('api/user/lottery');
        $response->assertStatus(200);
    }

    public function test_リモ達なら投票できる()
    {
        Sanctum::actingAs(
            User::create($this->user),
            ['*']
        );
        $task_ids = [ "task_ids" => []];
        for ($i = 3; $i < 19; $i++){
            $task_ids["task_ids"][] = $i;
        }

        $response = $this->put('api/achievements', $task_ids);
        $response = $this->post('api/vote', $this->vote);
        $response->assertStatus(200);

    }

    public function test_adminは投票できない()
    {
        Sanctum::actingAs(
            User::create($this->admin),
            ['*']
        );
        $response = $this->post('api/vote', $this->vote);
        $response->assertStatus(400)
        ->assertJson([
            'message' => 'Admin can not vote',
        ]);;
    }

    public function test_ネガティブチェック()
    {
        Sanctum::actingAs(
            User::create($this->user),
            ['*']
        );
        $task_ids = [ "task_ids" => []];
        for ($i = 1; $i < 19; $i++){
            $task_ids["task_ids"][] = $i;
        }

        $response = $this->put('api/achievements', $task_ids);
        $response = $this->post('api/vote', $this->vote);
        $response->assertStatus(400)
        ->assertJson([
            'message' => 'You have negative check',
        ]);;

    }

    public function test_達成数チェック()
    {
        Sanctum::actingAs(
            User::create($this->user),
            ['*']
        );
        $task_ids = [ "task_ids" => []];
        for ($i = 3; $i < 17; $i++){
            $task_ids["task_ids"][] = $i;
        }

        $response = $this->put('api/achievements', $task_ids);
        $response = $this->post('api/vote', $this->vote);
        $response->assertStatus(400)
        ->assertJson([
            'message' => 'Achievements are not enough',
        ]);;

    }

    public function test_当選者取得()
    {
        Sanctum::actingAs(
            User::create($this->admin),
            ['*']
        );

        $response = $this->get('api/winner');
        $response->assertStatus(200);

    }
    
    public function test_adminでなければ当選者取得できない()
    {
        Sanctum::actingAs(
            User::create($this->user),
            ['*']
        );

        $response = $this->get('api/winner');
        $response->assertStatus(400);

    }
}
