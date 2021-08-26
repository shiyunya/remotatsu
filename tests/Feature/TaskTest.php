<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

use App\Models\User;
use App\Models\Genre;
use App\Models\Difficulty;
use App\Models\Task;

class TaskTest extends TestCase
{
    //use RefreshDatabase;
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
    private $genre;
    private $difficulty;

    protected function setUp(): Void
    {
        parent::setUp(); 
    }
    
    public function testTaskが取得できる()
    {
        Sanctum::actingAs(
            User::create($this->user),
            ['*']
        );

        $response = $this->get('api/tasks');
        $response->assertStatus(200);
    }

    public function test_タスク追加()
    {
        Sanctum::actingAs(
            User::create($this->admin),
            ['*']
        );
        $task = [
            'task_name' => 'new task',
            'description' => '',
            'genre_id' => 1,
            'difficulty_id' => 1
        ];

        $response = $this->post('api/admin/task', $task);
        $response->assertStatus(200);
    }

    public function test_adminでなければタスク追加できない()
    {
        Sanctum::actingAs(
            User::create($this->user),
            ['*']
        );
        $task = [
            'task_name' => 'new task',
            'description' => '',
            'genre_id' => 1,
            'difficulty_id' => 1
        ];

        $response = $this->post('api/admin/task', $task);
        $response->assertStatus(400);
    }

    public function testAchievement更新()
    {
        Sanctum::actingAs(
            User::create($this->user),
            ['*']
        );

        $task_ids = [
            'task_ids' => [2, 3, 5, 6, 10 , 11]
        ];

        $response = $this->put('api/achievements', $task_ids);
        $response->assertStatus(200);
    }
}
