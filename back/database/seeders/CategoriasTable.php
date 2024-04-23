<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "id" => 1,
                "nomCategoria" => "Bíceps",
                "imatgeCategoria" => "imagen_biceps.jpg"
            ],
            [
                "id" => 2,
                "nomCategoria" => "Abdominales",
                "imatgeCategoria" => "imagen_abdominales.jpg"
            ],
            [
                "id" => 3,
                "nomCategoria" => "Abductores",
                "imatgeCategoria" => "imagen_abductores.jpg"
            ],
            [
                "id" => 4,
                "nomCategoria" => "Pectoral",
                "imatgeCategoria" => "imagen_pectoral.jpg"
            ],
            [
                "id" => 5,
                "nomCategoria" => "Glúteos",
                "imatgeCategoria" => "imagen_gluteos.jpg"
            ],
            [
                "id" => 6,
                "nomCategoria" => "Isquiotibiales",
                "imatgeCategoria" => "imagen_isquiotibiales.jpg"
            ],
            [
                "id" => 7,
                "nomCategoria" => "Dorsales",
                "imatgeCategoria" => "imagen_dorsales.jpg"
            ],
            [
                "id" => 8,
                "nomCategoria" => "Espalda Baja",
                "imatgeCategoria" => "imagen_espalda_baja.jpg"
            ],
            [
                "id" => 9,
                "nomCategoria" => "Espalda Media",
                "imatgeCategoria" => "imagen_espalda_media.jpg"
            ],
            [
                "id" => 10,
                "nomCategoria" => "Cuádriceps",
                "imatgeCategoria" => "imagen_cuadriceps.jpg"
            ],
            [
                "id" => 11,
                "nomCategoria" => "Trapecios",
                "imatgeCategoria" => "imagen_trapecios.jpg"
            ],
            [
                "id" => 12,
                "nomCategoria" => "Tríceps",
                "imatgeCategoria" => "imagen_triceps.jpg"
            ]
        ];
        
        DB::table('categoriasm')->insert($data);

    }
}
