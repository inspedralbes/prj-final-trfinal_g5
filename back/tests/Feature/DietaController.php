<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DietaController extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/dietas');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->post('/dietas', [
            'name' => 'Test Dieta',
            'description' => 'Test Description'
        ]);
        $response->assertStatus(201);
    }

    public function testShow()
    {
        $dieta = \App\Models\Dieta::factory()->create();
        $response = $this->get("/dietas/{$dieta->id}");
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $dieta = \App\Models\Dieta::factory()->create();
        $response = $this->put("/dietas/{$dieta->id}", [
            'name' => 'Updated Dieta'
        ]);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $dieta = \App\Models\Dieta::factory()->create();
        $response = $this->delete("/dietas/{$dieta->id}");
        $response->assertStatus(204);
    }
}
