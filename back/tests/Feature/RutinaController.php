<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RutinaController extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/rutinas');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->post('/rutinas', [
            'name' => 'Test Rutina',
            'description' => 'Test Description'
        ]);
        $response->assertStatus(201);
    }

    public function testShow()
    {
        $rutina = \App\Models\Rutina::factory()->create();
        $response = $this->get("/rutinas/{$rutina->id}");
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $rutina = \App\Models\Rutina::factory()->create();
        $response = $this->put("/rutinas/{$rutina->id}", [
            'name' => 'Updated Rutina'
        ]);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $rutina = \App\Models\Rutina::factory()->create();
        $response = $this->delete("/rutinas/{$rutina->id}");
        $response->assertStatus(204);
    }
}
