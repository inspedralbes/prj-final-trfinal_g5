<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EjercicioController extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/ejercicios');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->post('/ejercicios', [
            'name' => 'Test Ejercicio',
            'description' => 'Test Description'
        ]);
        $response->assertStatus(201);
    }

    public function testShow()
    {
        $ejercicio = \App\Models\Ejercicio::factory()->create();
        $response = $this->get("/ejercicios/{$ejercicio->id}");
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $ejercicio = \App\Models\Ejercicio::factory()->create();
        $response = $this->put("/ejercicios/{$ejercicio->id}", [
            'name' => 'Updated Ejercicio'
        ]);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $ejercicio = \App\Models\Ejercicio::factory()->create();
        $response = $this->delete("/ejercicios/{$ejercicio->id}");
        $response->assertStatus(204);
    }
}
