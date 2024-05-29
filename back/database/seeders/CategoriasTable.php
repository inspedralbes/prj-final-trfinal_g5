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
                "imatgeCategoria" => "imatge_biceps.jpg"
            ],
            [
                "id" => 2,
                "nomCategoria" => "Abdominals",
                "imatgeCategoria" => "imatge_abdominales.jpg"
            ],
            [
                "id" => 3,
                "nomCategoria" => "Abductors",
                "imatgeCategoria" => "imatge_abductores.jpg"
            ],
            [
                "id" => 4,
                "nomCategoria" => "Pit",
                "imatgeCategoria" => "imatge_pectoral.jpg"
            ],
           
            [
                "id" => 5,
                "nomCategoria" => "Glutis",
                "imatgeCategoria" => "imatge_gluteos.jpg"
            ],
            [
                "id" => 6,
                "nomCategoria" => "Isquiotibials",
                "imatgeCategoria" => "imatge_isquiotibials.jpg"
            ],
            [
                "id" => 7,
                "nomCategoria" => "Dorsals",
                "imatgeCategoria" => "imatge_dorsals.jpg"
            ],
            [
                "id" => 8,
                "nomCategoria" => "Esquena Baixa",
                "imatgeCategoria" => "imatge_esquena_baixa.jpg"
            ],
            [
                "id" => 9,
                "nomCategoria" => "Esquena Mitjana",
                "imatgeCategoria" => "imatge_esquena_media.jpg"
            ],
            [
                "id" => 10,
                "nomCategoria" => "Quàdriceps",
                "imatgeCategoria" => "imatge_cuadriceps.jpg"
            ],
            [
                "id" => 11,
                "nomCategoria" => "Trapezis",
                "imatgeCategoria" => "imatge_trapecios.jpg"
            ],
            [
                "id" => 12,
                "nomCategoria" => "Tríceps",
                "imatgeCategoria" => "imatge_triceps.jpg"
            ]
        ];
        
        DB::table('categoriasm')->insert($data);

    }
}
