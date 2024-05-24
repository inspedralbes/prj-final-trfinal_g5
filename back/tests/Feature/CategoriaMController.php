<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaMController extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/categorias');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->post('/categorias', [
            'name' => 'Test Categoria'
        ]);
        $response->assertStatus(201);
    }

    public function testShow()
    {
        $categoria = \App\Models\Categoria::factory()->create();
        $response = $this->get("/categorias/{$categoria->id}");
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $categoria = \App\Models\Categoria::factory()->create();
        $response = $this->put("/categorias/{$categoria->id}", [
            'name' => 'Updated Categoria'
        ]);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $categoria = \App\Models\Categoria::factory()->create();
        $response = $this->delete("/categorias/{$categoria->id}");
        $response->assertStatus(204);
    }
}
