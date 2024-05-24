<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SolicitudController extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/solicitudes');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->post('/solicitudes', [
            'user_id' => 1,
            'status' => 'pending'
        ]);
        $response->assertStatus(201);
    }

    public function testShow()
    {
        $solicitud = \App\Models\Solicitud::factory()->create();
        $response = $this->get("/solicitudes/{$solicitud->id}");
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $solicitud = \App\Models\Solicitud::factory()->create();
        $response = $this->put("/solicitudes/{$solicitud->id}", [
            'status' => 'approved'
        ]);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $solicitud = \App\Models\Solicitud::factory()->create();
        $response = $this->delete("/solicitudes/{$solicitud->id}");
        $response->assertStatus(204);
    }
}
