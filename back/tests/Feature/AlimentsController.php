<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlimentsController extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/aliments');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->post('/aliments', [
            'name' => 'Test Aliment',
            'calories' => 100
        ]);
        $response->assertStatus(201);
    }

    public function testShow()
    {
        $aliment = \App\Models\Aliment::factory()->create();
        $response = $this->get("/aliments/{$aliment->id}");
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $aliment = \App\Models\Aliment::factory()->create();
        $response = $this->put("/aliments/{$aliment->id}", [
            'name' => 'Updated Aliment'
        ]);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $aliment = \App\Models\Aliment::factory()->create();
        $response = $this->delete("/aliments/{$aliment->id}");
        $response->assertStatus(204);
    }
}
