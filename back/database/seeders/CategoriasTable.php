<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                "idCategoria" => 1,
                "nombreCategoria" => "Bíceps",
                "imagenCategoria" => "imagen_biceps.jpg"
            ],
            [
                "idCategoria" => 2,
                "nombreCategoria" => "Abdominales",
                "imagenCategoria" => "imagen_abdominales.jpg"
            ],
            [
                "idCategoria" => 3,
                "nombreCategoria" => "Abductores",
                "imagenCategoria" => "imagen_abductores.jpg"
            ],
            [
                "idCategoria" => 4,
                "nombreCategoria" => "Pectoral",
                "imagenCategoria" => "imagen_pectoral.jpg"
            ],
            [
                "idCategoria" => 5,
                "nombreCategoria" => "Glúteos",
                "imagenCategoria" => "imagen_gluteos.jpg"
            ],
            [
                "idCategoria" => 6,
                "nombreCategoria" => "Isquiotibiales",
                "imagenCategoria" => "imagen_isquiotibiales.jpg"
            ],
            [
                "idCategoria" => 7,
                "nombreCategoria" => "Dorsales",
                "imagenCategoria" => "imagen_dorsales.jpg"
            ],
            [
                "idCategoria" => 8,
                "nombreCategoria" => "Espalda Baja",
                "imagenCategoria" => "imagen_espalda_baja.jpg"
            ],
            [
                "idCategoria" => 9,
                "nombreCategoria" => "Espalda Media",
                "imagenCategoria" => "imagen_espalda_media.jpg"
            ],
            [
                "idCategoria" => 10,
                "nombreCategoria" => "Cuádriceps",
                "imagenCategoria" => "imagen_cuadriceps.jpg"
            ],
            [
                "idCategoria" => 11,
                "nombreCategoria" => "Trapecios",
                "imagenCategoria" => "imagen_trapecios.jpg"
            ],
            [
                "idCategoria" => 12,
                "nombreCategoria" => "Tríceps",
                "imagenCategoria" => "imagen_triceps.jpg"
            ]
        ];
        DB::table('categorias')->insert($data);

    }
}
