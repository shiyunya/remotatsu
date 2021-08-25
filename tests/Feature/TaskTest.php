<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    private $access_token = null;

    public function testGetTasks()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
