<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlimentsTable extends Seeder
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
                'nom_plat' => 'Muesli amb iogurt i fruita seca',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Muesli', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Iogurt', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Panses', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Ametlles', 'quantitat' => 20, 'unitat' => 'grams']
                ]),
                'proteines' => 8.7,
                'carbohidrats' => 45.3,
                'greixos' => 12.6,
                'calories' => 321
            ],
            [
                'nom_plat' => 'Torrades integrals amb ou ferrat i tomàquet',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'trossos'],
                    ['nom_ingredient' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 14.6,
                'carbohidrats' => 24.3,
                'greixos' => 11.8,
                'calories' => 237
            ],
            [
                'nom_plat' => 'Iogurt desnatat amb maduixes i llavors de chia',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Iogurt desnatat', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llavors de chia', 'quantitat' => 10, 'unitat' => 'grams']
                ]),
                'proteines' => 7.8,
                'carbohidrats' => 12.3,
                'greixos' => 2.9,
                'calories' => 105
            ],
            [
                'nom_plat' => 'Avena amb fruites i nous',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Avena', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llet', 'quantitat' => 200, 'unitat' => 'ml'],
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Nous', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteines' => 8.5,
                'carbohidrats' => 32.1,
                'greixos' => 10.7,
                'calories' => 275
            ],
            [
                'nom_plat' => 'Torrades amb tomàquet i pernil',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Torrades', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Pernil', 'quantitat' => 50, 'unitat' => 'grams']
                ]),
                'proteines' => 9.8,
                'carbohidrats' => 17.4,
                'greixos' => 6.5,
                'calories' => 168
            ],
            [
                'nom_plat' => 'Iogurt amb fruita i granola',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Iogurt', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Granola', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteines' => 6.9,
                'carbohidrats' => 39.2,
                'greixos' => 7.8,
                'calories' => 251
            ],
            [
                'nom_plat' => 'Ous ferrats amb esparrecs',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Esparrecs', 'quantitat' => 100, 'unitat' => 'grams']
                ]),
                'proteines' => 12.9,
                'carbohidrats' => 3.4,
                'greixos' => 15.8,
                'calories' => 204
            ],
            [
                'nom_plat' => 'Sanditx de salmó fumat',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'trossos'],
                    ['nom_ingredient' => 'Salmó fumat', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Rúcula', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteines' => 14.7,
                'carbohidrats' => 25.6,
                'greixos' => 9.8,
                'calories' => 230
            ],
            [
                'nom_plat' => 'Macedònia de fruites',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Kiwi', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Pinya', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Meló', 'quantitat' => 50, 'unitat' => 'grams']
                ]),
                'proteines' => 2.5,
                'carbohidrats' => 27.9,
                'greixos' => 0.7,
                'calories' => 127
            ],
            [
                'nom_plat' => 'Creps amb xocolata i plàtan',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Creps', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Xocolata negra', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 5.4,
                'carbohidrats' => 34.2,
                'greixos' => 6.8,
                'calories' => 216
            ],
            [
                'nom_plat' => 'Truita de verdures',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Espàrrecs', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Berenjena', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Ceba', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteines' => 11.8,
                'carbohidrats' => 6.3,
                'greixos' => 11.5,
                'calories' => 176
            ],
            [
                'nom_plat' => 'Batut de proteïnes amb plàtan i mantega de cacauet',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Proteïna en pols', 'quantitat' => 1, 'unitat' => 'serving'],
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Mantega de cacauet', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llet', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteines' => 25.3,
                'carbohidrats' => 34.7,
                'greixos' => 11.5,
                'calories' => 336
            ],
            
            [
                'nom_plat' => 'Truita de patates amb alvocat',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Patata', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 13.4,
                'carbohidrats' => 20.8,
                'greixos' => 22.1,
                'calories' => 312
            ],
            
            [
                'nom_plat' => 'Torrades amb alvocat, ou i salmó fumat',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Torrades', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ou dur', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Salmó fumat', 'quantitat' => 50, 'unitat' => 'grams']
                ]),
                'proteines' => 16.7,
                'carbohidrats' => 24.3,
                'greixos' => 17.8,
                'calories' => 304
            ],
            
            [
                'nom_plat' => 'Cereals integrals amb iogurt grec, mel i fruits secs',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Cereals integrals', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Iogurt grec', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Mel', 'quantitat' => 10, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Fruits secs variats', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteines' => 10.8,
                'carbohidrats' => 43.2,
                'greixos' => 14.3,
                'calories' => 332
            ],
            [
                'nom_plat' => 'Crepes amb avena, plàtan i mel',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Crepes', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Mel', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 10.5,
                'carbohidrats' => 49.2,
                'greixos' => 6.9,
                'calories' => 309
            ],
            [
                'nom_plat' => 'Torrades integrals amb alvocat i tomaquet',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'trossos'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Tomaquet', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 3.6,
                'carbohidrats' => 18.9,
                'greixos' => 8.7,
                'calories' => 158
            ],     
            [
                'nom_plat' => 'Ous remenats amb espinacs i pebrot vermell',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Espinacs', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pebrot vermell', 'quantitat' => 50, 'unitat' => 'grams']
                ]),
                'proteines' => 15.4,
                'carbohidrats' => 5.6,
                'greixos' => 11.1,
                'calories' => 186
            ],      
            [
                'nom_plat' => 'Avena amb nabius i llavors de lli',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Avena', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Nabius', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llavors de lli', 'quantitat' => 10, 'unitat' => 'grams']
                ]),
                'proteines' => 7.3,
                'carbohidrats' => 27.4,
                'greixos' => 6.1,
                'calories' => 195
            ],
            [
                'nom_plat' => 'Iogurt desnatat amb fruits vermells i ametlles laminades',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Iogurt desnatat', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Gerds', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Ametlles laminades', 'quantitat' => 10, 'unitat' => 'grams']
                ]),
                'proteines' => 6.1,
                'carbohidrats' => 13.8,
                'greixos' => 3.9,
                'calories' => 114
            ],


            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



            [
                'nom_plat' => 'Batut de proteïna amb fruita',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Proteïna en pols', 'quantitat' => 1, 'unitat' => 'serving'],
                    ['nom_ingredient' => 'Maduixes', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Llet d\'ametlles', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteines' => 28.4,
                'carbohidrats' => 28.9,
                'greixos' => 9.3,
                'calories' => 315
            ],
            [
                'nom_plat' => 'Iogurt amb fruits secs',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Iogurt', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Nous', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 6.8,
                'carbohidrats' => 9.3,
                'greixos' => 14.5,
                'calories' => 187
            ],
            [
                'nom_plat' => 'Batut de fruita i ametlles',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Ametlles', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llet', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteines' => 7.2,
                'carbohidrats' => 31.4,
                'greixos' => 8.6,
                'calories' => 238
            ],
            [
                'nom_plat' => 'Torrades amb alvocat i tomàquet',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'trossos'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 6.1,
                'carbohidrats' => 24.5,
                'greixos' => 9.2,
                'calories' => 200
            ],
            [
                'nom_plat' => 'Macedònia de fruites amb iogurt',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Poma', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Iogurt', 'quantitat' => 150, 'unitat' => 'grams']
                ]),
                'proteines' => 5.9,
                'carbohidrats' => 28.2,
                'greixos' => 3.7,
                'calories' => 171
            ],
            [
                'nom_plat' => 'Barretes de cereals amb fruits secs',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Barretes de cereals', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Fruits secs variats', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteines' => 3.2,
                'carbohidrats' => 31.5,
                'greixos' => 8.6,
                'calories' => 205
            ],
            [
                'nom_plat' => 'Ous remenats amb espinacs',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Espinacs', 'quantitat' => 50, 'unitat' => 'grams']
                ]),
                'proteines' => 13.1,
                'carbohidrats' => 2.1,
                'greixos' => 14.9,
                'calories' => 206
            ], 
            [
                'nom_plat' => 'Amanida de pollastre i alvocat',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pit de pollastre a la planxa', 'quantitat' => 1, 'unitat' => 'porció'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 0.5, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Enciam', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Tomaquet', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 25.3,
                'carbohidrats' => 7.9,
                'greixos' => 15.6,
                'calories' => 277
            ],
            [
                'nom_plat' => 'Batut de proteïnes amb espinacs i maduixes',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Proteïna en pols', 'quantitat' => 1, 'unitat' => 'serving'],
                    ['nom_ingredient' => 'Espinacs', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Maduixes', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llet d ametlles', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteines' => 24.6,
                'carbohidrats' => 17.8,
                'greixos' => 7.2,
                'calories' => 231
            ],
            [
                'nom_plat' => 'Salmó al forn amb quinoa i bròquil',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Salmó', 'quantitat' => 1, 'unitat' => 'filet'],
                    ['nom_ingredient' => 'Quinoa cuita', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Bròquil al vapor', 'quantitat' => 1, 'unitat' => 'tassa']
                ]),
                'proteines' => 30.5,
                'carbohidrats' => 32.1,
                'greixos' => 18.3,
                'calories' => 409
            ],
            [
                'nom_plat' => 'Tacos de carn picada amb guacamole i salsa de tomàquet casolana',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Carn picada magra', 'quantitat' => 1, 'unitat' => 'porció'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 0.5, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Tomaquet', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ceba', 'quantitat' => 0.5, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Tortilles integrals', 'quantitat' => 2, 'unitat' => 'unitats']
                ]),
                'proteines' => 26.9,
                'carbohidrats' => 34.7,
                'greixos' => 19.2,
                'calories' => 413
            ],
            [
                'nom_plat' => 'Amanida de quinoa i cigrons amb alvocat',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Quinoa cuita', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Cigrons cuits', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 0.5, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Tomaquet', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ceba morada', 'quantitat' => 0.5, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Culantre', 'quantitat' => 1, 'unitat' => 'manat'],
                    ['nom_ingredient' => 'Suc de llimona', 'quantitat' => 1, 'unitat' => 'cullerada'],
                    ['nom_ingredient' => 'Oli d oliva', 'quantitat' => 1, 'unitat' => 'cullerada']
                ]),
                'proteines' => 11.8,
                'carbohidrats' => 37.4,
                'greixos' => 18.7,
                'calories' => 328
            ],
            [
                'nom_plat' => 'Filet de vedella a la planxa amb moniato al forn i espàrrecs',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Filet de vedella magra', 'quantitat' => 1, 'unitat' => 'porció'],
                    ['nom_ingredient' => 'Moniatos', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Espàrrecs', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Oli d oliva', 'quantitat' => 1, 'unitat' => 'cullerada'],
                    ['nom_ingredient' => 'Sal', 'quantitat' => 1, 'unitat' => 'pessic'],
                    ['nom_ingredient' => 'Pebr', 'quantitat' => 1, 'unitat' => 'pessic'],
                    ['nom_ingredient' => 'All en pols', 'quantitat' => 1, 'unitat' => 'pessic']
                ]),
                'proteines' => 32.2,
                'carbohidrats' => 31.5,
                'greixos' => 11.8,
                'calories' => 370
            ],
            [
                'nom_plat' => 'Truita de clares d\'ou amb espinacs i formatge',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Clars d\'ou', 'quantitat' => 5, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Espinacs fresques', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Formatge baix en greix', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteines' => 19.1,
                'carbohidrats' => 2.1,
                'greixos' => 7.4,
                'calories' => 160
            ],
            [
                'nom_plat' => 'Batut d\'Avena amb plàtan i mantega de cacauets',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Avena', 'quantitat' => 40, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llet (o aigua)', 'quantitat' => 200, 'unitat' => 'ml'],
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Mantega de cacauets', 'quantitat' => 15, 'unitat' => 'grams']
                ]),
                'proteines' => 7.5,
                'carbohidrats' => 37.6,
                'greixos' => 6.9,
                'calories' => 249
            ],
            [
                'nom_plat' => 'Iogurt grec amb granola i fruita',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Iogurt grec natural', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Granola baixa en sucre', 'quantitat' => 30, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Fruita fresca (maduixes, nabius, kiwi, etc.)', 'quantitat' => 100, 'unitat' => 'grams']
                ]),
                'proteines' => 6.2,
                'carbohidrats' => 26.3,
                'greixos' => 3.7,
                'calories' => 184
            ],
            

            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            

            [
                'nom_plat' => 'Salmó al forn amb quinoa i espàrrecs',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Filet de salmó', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Quinoa', 'quantitat' => 80, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Espàrrecs', 'quantitat' => 6, 'unitat' => 'unitats']
                ]),
                'proteines' => 30.2,
                'carbohidrats' => 21.4,
                'greixos' => 13.8,
                'calories' => 320
            ],
            [
                'nom_plat' => 'Amanida de pollastre amb enciam i alvocat',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pit de pollastre', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Enciam', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 1/4, 'unitat' => 'unitat']
                ]),
                'proteines' => 26.3,
                'carbohidrats' => 9.7,
                'greixos' => 18.5,
                'calories' => 280
            ],
            [
                'nom_plat' => 'Pasta integral amb tonyina i verdures',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pasta integral', 'quantitat' => 80, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Tonyina en conserva', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Bròquil', 'quantitat' => 1/2, 'unitat' => 'tassa']
                ]),
                'proteines' => 22.8,
                'carbohidrats' => 33.6,
                'greixos' => 6.2,
                'calories' => 290
            ],
            [
                'nom_plat' => 'Carn de vedella rostida amb patata i espinacs',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Carn de vedella', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Patata', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Espinacs', 'quantitat' => 1/2, 'unitat' => 'tassa']
                ]),
                'proteines' => 26.4,
                'carbohidrats' => 15.9,
                'greixos' => 9.3,
                'calories' => 290
            ],
            [
                'nom_plat' => 'Tacos de pollastre amb fajita integral i verdura',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pit de pollastre', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Fajita integral', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ceba', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Pebrer', 'quantitat' => 1/4, 'unitat' => 'unitat']
                ]),
                'proteines' => 25.1,
                'carbohidrats' => 25.3,
                'greixos' => 8.2,
                'calories' => 270
            ],
            [
                'nom_plat' => 'Truita de patates amb tomàquet i cogombre',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Patata', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Cogombre', 'quantitat' => 1/4, 'unitat' => 'unitat']
                ]),
                'proteines' => 13.6,
                'carbohidrats' => 22.4,
                'greixos' => 11.5,
                'calories' => 230
            ],
            [
                'nom_plat' => 'Hamburguesa de llenties amb amanida de col',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Llenties', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pa de hamburguesa integral', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Col', 'quantitat' => 1/2, 'unitat' => 'tassa']
                ]),
                'proteines' => 18.9,
                'carbohidrats' => 37.2,
                'greixos' => 6.4,
                'calories' => 270
            ],
            [
                'nom_plat' => 'Fideus de sègol amb gambes i verdures',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Fideus de sègol', 'quantitat' => 80, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Gambes', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pebrer vermell', 'quantitat' => 1/4, 'unitat' => 'unitat']
                ]),
                'proteines' => 20.6,
                'carbohidrats' => 31.7,
                'greixos' => 4.8,
                'calories' => 250
            ],
            [
                'nom_plat' => 'Cuscús amb pollastre i fruita seca',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Cuscús', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pit de pollastre', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pinyons', 'quantitat' => 10, 'unitat' => 'grams']
                ]),
                'proteines' => 19.7,
                'carbohidrats' => 32.1,
                'greixos' => 6.9,
                'calories' => 270
            ],
            [
                'nom_plat' => 'Truita de verdures amb patates al vapor',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Patata', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Espàrrecs', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Ceba', 'quantitat' => 1/4, 'unitat' => 'unitat']
                ]),
                'proteines' => 13.1,
                'carbohidrats' => 19.2,
                'greixos' => 5.3,
                'calories' => 190
            ],
            [
                'nom_plat' => 'Entrecot a la planxa amb patates braves',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Entrecot', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Patata', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Salsa brava', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 25.8,
                'carbohidrats' => 17.4,
                'greixos' => 28.5,
                'calories' => 390
            ],
            [
                'nom_plat' => 'Arros amb pollastre',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Arròs', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Pollastre', 'quantitat' => 200, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Ceba', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Pastanaga', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 22.6,
                'carbohidrats' => 31.8,
                'greixos' => 8.2,
                'calories' => 320
            ],[
                'nom_plat' => 'Ensalada de salmó i quinoa amb alvocat',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Salmó', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Quinoa', 'quantitat' => 80, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Espinacs', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Tomàquet cherry', 'quantitat' => 6, 'unitat' => 'unitats']
                ]),
                'proteines' => 26.4,
                'carbohidrats' => 22.3,
                'greixos' => 14.3,
                'calories' => 340
            ],
            
            [
                'nom_plat' => 'Pollastre al curry amb arròs integral i bròquil al vapor',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pit de pollastre', 'quantitat' => 120, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Arròs integral', 'quantitat' => 80, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Bròquil', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Ceba', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Curry', 'quantitat' => 1, 'unitat' => 'culleradeta']
                ]),
                'proteines' => 29.8,
                'carbohidrats' => 29.5,
                'greixos' => 9.7,
                'calories' => 360
            ],
            
            [
                'nom_plat' => 'Bol de tofu amb quinoa i verdures a la planxa',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Tofu', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Quinoa', 'quantitat' => 80, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pastanaga', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Berenjena', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ceba', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Brot de bròquil', 'quantitat' => 1/4, 'unitat' => 'unitat']
                ]),
                'proteines' => 21.6,
                'carbohidrats' => 23.4,
                'greixos' => 11.8,
                'calories' => 310
            ],
            
            [
                'nom_plat' => 'Wrap de gall dindi amb espinacs i guacamole en tortilla integral',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Gall dindi', 'quantitat' => 80, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Espinacs', 'quantitat' => 1/2, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Guacamole', 'quantitat' => 2, 'unitat' => 'cullerades'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Tortilla integral', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 21.9,
                'carbohidrats' => 27.8,
                'greixos' => 12.5,
                'calories' => 320
            ],
            
            [
                'nom_plat' => 'Salmó a la planxa amb bròquil al vapor i amanida de cogombre i tomàquet',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Salmó', 'quantitat' => 120, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Bròquil', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Cogombre', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Enciam', 'quantitat' => 1/2, 'unitat' => 'tassa']
                ]),
                'proteines' => 28.5,
                'carbohidrats' => 18.7,
                'greixos' => 15.2,
                'calories' => 350
            ],
            
            [
                'nom_plat' => 'Amanida de tofu amb alvocat, nous i vinagreta de llimona',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Tofu', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Nous', 'quantitat' => 10, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Enciam', 'quantitat' => 1/2, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Llimona', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteines' => 19.8,
                'carbohidrats' => 16.3,
                'greixos' => 18.7,
                'calories' => 290
            ],
            
            [
                'nom_plat' => 'Hamburguesa de vedella amb formatge cheddar en pa integral amb patates dolces fregides al forn',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Vedella', 'quantitat' => 120, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Formatge cheddar', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pa integral', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Patates dolces', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Oli d\'oliva', 'quantitat' => 1, 'unitat' => 'cullerada']
                ]),
                'proteines' => 26.4,
                'carbohidrats' => 38.2,
                'greixos' => 17.5,
                'calories' => 410
            ],
            
            [
                'nom_plat' => 'Pasta amb albóndigues de porc en salsa marinera amb formatge parmesà',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pasta', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Albóndigues de porc', 'quantitat' => 120, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Formatge parmesà', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Herbes', 'quantitat' => 1, 'unitat' => 'culleradeta']
                ]),
                'proteines' => 20.5,
                'carbohidrats' => 27.9,
                'greixos' => 13.8,
                'calories' => 350
            ],
            
            [
                'nom_plat' => 'Truita d\'espinacs i bolets amb patates al forn',
                'apat' => 'dinar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Espinacs', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Bolets', 'quantitat' =>100, 'unitat' => 'grams'],                    
                    ['nom_ingredient' => 'Patata', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'ceba', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Oli d\'oliva', 'quantitat' => 1, 'unitat' => 'cullerada']
                  
                ]),
                'proteines' => 19.6,
                'carbohidrats' => 28.3,
                'greixos' => 15.9,
                'calories' => 330
            ],  



            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



            [
                'nom_plat' => 'Batut de proteines amb plàtan',
                'apat' => 'post-entrenament',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Proteïna en pols (sabor a vainilla)', 'quantitat' => 30, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llet d\'ametlla', 'quantitat' => 250, 'unitat' => 'ml'],
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Mantega d\'ametlla', 'quantitat' => 15, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Glaç', 'quantitat' => 'al gust']
                ]),
                'proteines' => 25.7,
                'carbohidrats' => 32.4,
                'greixos' => 12.9,
                'calories' => 340
            ],
            [
                'nom_plat' => 'Truita de clares d\'ou amb espinacs',
                'apat' => 'post-entrenament',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Clares d\'ou', 'quantitat' => 6, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Espinacs frescs', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Formatge cottage baix en greix', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Tomàquet cherry', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Oli d\'oliva', 'quantitat' => 5, 'unitat' => 'ml']
                ]),
                'proteines' => 27.8,
                'carbohidrats' => 6.3,
                'greixos' => 8.2,
                'calories' => 218
            ],
            [
                'nom_plat' => 'Sandvitx de gall dindi i alvocat en pa integral',
                'apat' => 'post-entrenament',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Gall dindi en llesques', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Alvocat', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'tallades'],
                    ['nom_ingredient' => 'Enciam', 'quantitat' => 'al gust'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 'al gust']
                ]),
                'proteines' => 18.5,
                'carbohidrats' => 28.7,
                'greixos' => 10.9,
                'calories' => 276
            ],
            [
                'nom_plat' => 'Iogurt grec amb fruites i granola',
                'apat' => 'post-entrenament',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Iogurt grec baix en greix', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Rais', 'quantitat' => 30, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Granola sense sucre afegit', 'quantitat' => 20, 'unitat' => 'grams']
                ]),
                'proteines' => 15.4,
                'carbohidrats' => 27.8,
                'greixos' => 4.9,
                'calories' => 205
            ],
            [
                'nom_plat' => 'Amanida de quinoa amb pollastre a la graella',
                'apat' => 'post-entrenament',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Quinoa cuita', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pit de pollastre a la graella', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pebrer vermell', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Pebrer verd', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ceba vermella', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteines' => 32.1,
                'carbohidrats' => 32.9,
                'greixos' => 11.5,
                'calories' => 375
            ],
            [
                'nom_plat' => 'Batut de proteines amb fruita i ametlles',
                'apat' => 'berenar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Proteïna en pols (sabor a vainilla)', 'quantitat' => 30, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llet d\'ametlla', 'quantitat' => 250, 'unitat' => 'ml'],
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ametlles', 'quantitat' => 20, 'unitat' => 'grams']
                ]),
                'proteines' => 25.7,
                'carbohidrats' => 32.4,
                'greixos' => 12.9,
                'calories' => 340
            ],
            [
                'nom_plat' => 'Iogurt grec amb fruits secs i mel',
                'apat' => 'berenar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Iogurt grec baix en greix', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Nous', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Avellanes', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Mel', 'quantitat' => 'al gust']
                ]),
                'proteines' => 11.5,
                'carbohidrats' => 19.8,
                'greixos' => 9.2,
                'calories' => 200
            ],
            [
                'nom_plat' => 'Crema d\'ametlles amb tostades de pa integral',
                'apat' => 'berenar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Crema d\'ametlles', 'quantitat' => 30, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'trossos'],
                    ['nom_ingredient' => 'Plàtans', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Mel', 'quantitat' => 'al gust']
                ]),
                'proteines' => 6.4,
                'carbohidrats' => 33.7,
                'greixos' => 14.8,
                'calories' => 289
            ],
            [
                'nom_plat' => 'Sàndwich de salmó fumat amb cogombre i formatge fresc',
                'apat' => 'berenar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Salmó fumat', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Cogombre', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Formatge fresc baix en greix', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'trossos']
                ]),
                'proteines' => 22.3,
                'carbohidrats' => 29.6,
                'greixos' => 9.5,
                'calories' => 292
            ],
            [
                'nom_plat' => 'Bol de cereals integrals amb fruita fresca i llet',
                'apat' => 'berenar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Cereals integrals', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llet d\'ametlla', 'quantitat' => 200, 'unitat' => 'ml'],
                    ['nom_ingredient' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1/2, 'unitat' => 'unitat']
                ]),
                'proteines' => 9.8,
                'carbohidrats' => 41.2,
                'greixos' => 6.3,
                'calories' => 265
            ],



            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



            [
                'nom_plat' => 'Saltejat de verdures amb tofu',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Tofu', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Broquil', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Pastanaga', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ceba', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Berenjena', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteines' => 18.2,
                'carbohidrats' => 14.8,
                'greixos' => 8.6,
                'calories' => 220
            ],
            [
                'nom_plat' => 'Salmó al forn amb patata dolça i espàrrecs',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Filet de salmó', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Patata dolça', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Espàrrecs', 'quantitat' => 6, 'unitat' => 'unitats'],
                    ['nom_ingredient' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml'],
                    ['nom_ingredient' => 'Llimona', 'quantitat' => 'al gust'],
                    ['nom_ingredient' => 'Sal i pebre', 'quantitat' => 'al gust']
                ]),
                'proteines' => 23.5,
                'carbohidrats' => 18.9,
                'greixos' => 9.7,
                'calories' => 280
            ],
            [
                'nom_plat' => 'Quinoa amb pollastre i verdures al vapor',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Quinoa', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pit de pollastre', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Bròquil', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Pastanaga', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteines' => 31.2,
                'carbohidrats' => 28.6,
                'greixos' => 11.4,
                'calories' => 375
            ],
            [
                'nom_plat' => 'Amanida de tonyina amb enciam, tomàquet i oli d\'oliva',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Tonyina en conserva', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Enciam', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteines' => 25.8,
                'carbohidrats' => 5.2,
                'greixos' => 10.4,
                'calories' => 230
            ],
            [
                'nom_plat' => 'Pasta integral amb gambes i tomàquet',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pasta integral', 'quantitat' => 80, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Gambes', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'All', 'quantitat' => 1/2, 'unitat' => 'dents'],
                    ['nom_ingredient' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteines' => 20.1,
                'carbohidrats' => 31.5,
                'greixos' => 6.8,
                'calories' => 276
            ],
            [
                'nom_plat' => 'Pollastre al forn amb patates i bròquil',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pit de pollastre', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Patata', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Bròquil', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml'],
                    ['nom_ingredient' => 'Sal i pebre', 'quantitat' => 'al gust']
                ]),
                'proteines' => 26.4,
                'carbohidrats' => 21.8,
                'greixos' => 10.5,
                'calories' => 296
            ],
            [
                'nom_plat' => 'Llenties estofades amb verdures',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Llenties', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Ceba', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Pastanaga', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteines' => 14.7,
                'carbohidrats' => 27.5,
                'greixos' => 5.8,
                'calories' => 218
            ],
            [
                'nom_plat' => 'Sopa de verdures amb fideus integrals',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Fideus integrals', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Bròquil', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Pastanaga', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ceba', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Caldo vegetal', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteines' => 8.3,
                'carbohidrats' => 17.5,
                'greixos' => 2.1,
                'calories' => 125
            ],
            [
                'nom_plat' => 'Tacos de peix al vapor amb salsa de mango',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Filet de peix blanc', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Mango', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ceba vermella', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Culantro', 'quantitat' => 'al gust'],
                    ['nom_ingredient' => 'Llimona', 'quantitat' => 'al gust']
                ]),
                'proteines' => 28.1,
                'carbohidrats' => 15.4,
                'greixos' => 7.9,
                'calories' => 245
            ],
            [
                'nom_plat' => 'Ratatouille amb quinoa',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Quinoa', 'quantitat' => 80, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Albergínia', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ceba', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Pebrer vermell', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Tomàquet triturat', 'quantitat' => 100, 'unitat' => 'ml']
                ]),
                'proteines' => 11.6,
                'carbohidrats' => 31.9,
                'greixos' => 5.4,
                'calories' => 215
            ],
            [
                'nom_plat' => 'Amanida de tonyina i enciam',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Tonyina', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Enciam', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Oli oliva', 'quantitat' => 1, 'unitat' => 'cullerada']
                ]),
                'proteines' => 30.2,
                'carbohidrats' => 3.5,
                'greixos' => 7.8,
                'calories' => 215
            ],
            [
                'nom_plat' => 'Peix a la planxa amb espàrrecs',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Filet de peix blanc', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Espàrrecs', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Oli oliva', 'quantitat' => 1, 'unitat' => 'cullerada'],
                    ['nom_ingredient' => 'Llimona', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Sal', 'quantitat' => 1, 'unitat' => 'pessic']
                ]),
                'proteines' => 25.9,
                'carbohidrats' => 3.7,
                'greixos' => 7.8,
                'calories' => 220
            ],
            [
                'nom_plat' => 'Pollastre a la planxa amb verdures al vapor',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Pechuga de pollastre', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Bròquil', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Pastanaga', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Oli oliva', 'quantitat' => 1, 'unitat' => 'cullerada'],
                    ['nom_ingredient' => 'Sal', 'quantitat' => 1, 'unitat' => 'pessic']
                ]),
                'proteines' => 27.4,
                'carbohidrats' => 5.2,
                'greixos' => 6.5,
                'calories' => 240
            ],
        ];
        
    DB::table('aliments')->insert($data);
          
    }
}
