<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MensajeController extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/mensajes');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->post('/mensajes', [
            'content' => 'Test Message'
        ]);
        $response->assertStatus(201);
    }

    public function testShow()
    {
        $mensaje = \App\Models\Mensaje::factory()->create();
        $response = $this->get("/mensajes/{$mensaje->id}");
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $mensaje = \App\Models\Mensaje::factory()->create();
        $response = $this->put("/mensajes/{$mensaje->id}", [
            'content' => 'Updated Message'
        ]);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $mensaje = \App\Models\Mensaje::factory()->create();
        $response = $this->delete("/mensajes/{$mensaje->id}");
        $response->assertStatus(204);
    }
}
