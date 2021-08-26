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

    private $admin;
    private $user;
    private $genre;
    private $difficulty;

    protected function setUp(): Void // ※ Voidが必要
    {
        // 必ずparent::setUp()を呼び出す
        parent::setUp(); 

        $this->admin = User::create([
            'user_name' => 'admin',
            'email' => 'admin@yumemi.co.jp',
            'password' => 'admin',
            'is_admin' => true
        ]);

        $this->user = User::create([
            'email' => 'user@gmail.com',
            'user_name' => 'Tanaka Taro',
            'password' => '123456',
            'is_admin' => false
        ]);

        $this->genre = Genre::create(['genre_name' => 'sample genre']);
        $this->difficulty = Difficulty::create(['difficulty_name' => 'sample diff']);
        

    }
    
    public function testTaskが取得できる()
    {
        Sanctum::actingAs(
            $this->user,
            ['*']
        );

        $response = $this->get('api/tasks');
        $response->assertStatus(200);
    }

    public function test_adminでなければタスク追加できない()
    {
        Sanctum::actingAs(
            $this->user,
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

    public function test_adminならタスク追加できる()
    {
        Sanctum::actingAs(
            $this->admin,
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

    public function testAchievementを追加できる()
    {
        Sanctum::actingAs(
            $this->user,
            ['*']
        );
        $task = [
            'task_name' => 'sample task',
            'description' => 'sample text',
            'genre_id' => $this->genre->id,
            'difficulty_id' => $this->difficulty->id
        ];

        $tasks = array();
        for ($i = 0; $i < 15; $i++){
            $tasks[] = $task;
        }

        Task::insert($tasks);

        $task_ids = [
            'task_ids' => [2, 3, 5, 6, 10 , 11]
        ];

        $response = $this->put('api/achievements', $task_ids);
        $response->assertStatus(200);

    }
}
