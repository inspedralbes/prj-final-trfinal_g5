<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserController extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->post('/users', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password'
        ]);
        $response->assertStatus(201);
    }

    public function testShow()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->get("/users/{$user->id}");
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->put("/users/{$user->id}", [
            'name' => 'Updated User'
        ]);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->delete("/users/{$user->id}");
        $response->assertStatus(204);
    }
}
