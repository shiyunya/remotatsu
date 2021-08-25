<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    private $access_token = null;
    private $header = array();

    public function testRegister()
    {

        $user = [
            'email' => 'user@example.com',
            'user_name' => 'Tanaka Taro',
            'password' => '123456'
        ];

        $response = $this->post('api/register', $user);
        $response->assertOk();
    }

    public function testLogin()
    {

        $user = [
            'email' => 'user@example.com',
            'password' => '123456'
        ];

        $response = $this->post('api/login', $user);
        $response->assertOk();
        $this->access_token = $response->decodeResponseJson('access_token');

    }

    public function testGetTasks()
    {
        $response = $this->get('/api/tasks', $this->header);
        $response->assertStatus(200);
    }


}
