<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    private $user = [
        'email' => 'user@example.com',
        'user_name' => 'Tanaka Taro',
        'password' => '123456'
    ];

    public function testRegister()
    {
        $response = $this->post('api/register', $this->user);
        $response->assertOk();
    }

    public function testLogin()
    {
        $response = $this->post('api/register', $this->user);
        $response = $this->post('api/login', $this->user);
        $response->assertOk();
    }

}
