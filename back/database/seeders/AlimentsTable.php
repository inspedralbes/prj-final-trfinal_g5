<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'nom_plat' => 'Avena amb fruites i nous',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Avena', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Llet', 'quantitat' => 200, 'unitat' => 'ml'],
                    ['nom' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Nous', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteïnes' => 8.5,
                'carbohidrats' => 32.1,
                'greixos' => 10.7,
                'calories' => 275
            ],
            [
                'nom_plat' => 'Torrades amb tomàquet i pernil',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Torrades', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Pernil', 'quantitat' => 50, 'unitat' => 'grams']
                ]),
                'proteïnes' => 9.8,
                'carbohidrats' => 17.4,
                'greixos' => 6.5,
                'calories' => 168
            ],
            [
                'nom_plat' => 'Iogurt amb fruita i granola',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Iogurt', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Granola', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteïnes' => 6.9,
                'carbohidrats' => 39.2,
                'greixos' => 7.8,
                'calories' => 251
            ],
            [
                'nom_plat' => 'Batut de proteïnes amb espinacs i fruita',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Proteïna en pols', 'quantitat' => 1, 'unitat' => 'serving'],
                    ['nom' => 'Espinacs', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Maduixes', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom' => 'Llet d\'ametlles', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteïnes' => 29.3,
                'carbohidrats' => 29.8,
                'greixos' => 10.1,
                'calories' => 327
            ],
            [
                'nom_plat' => 'Ous ferrats amb esparrecs',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom' => 'Esparrecs', 'quantitat' => 100, 'unitat' => 'grams']
                ]),
                'proteïnes' => 12.9,
                'carbohidrats' => 3.4,
                'greixos' => 15.8,
                'calories' => 204
            ], [
                'nom_plat' => 'Batut de plàtan i ametlles',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Ametlles', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom' => 'Llet', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteïnes' => 7.3,
                'carbohidrats' => 30.1,
                'greixos' => 9.5,
                'calories' => 235
            ],
            [
                'nom_plat' => 'Sandvitx de salmó fumat',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'trossos'],
                    ['nom' => 'Salmó fumat', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Rúcula', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteïnes' => 14.7,
                'carbohidrats' => 25.6,
                'greixos' => 9.8,
                'calories' => 230
            ],
            [
                'nom_plat' => 'Macedònia de fruites',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Kiwi', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Pinya', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Meló', 'quantitat' => 50, 'unitat' => 'grams']
                ]),
                'proteïnes' => 2.5,
                'carbohidrats' => 27.9,
                'greixos' => 0.7,
                'calories' => 127
            ],
            [
                'nom_plat' => 'Creps amb xocolata i plàtan',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Creps', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom' => 'Xocolata negra', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteïnes' => 5.4,
                'carbohidrats' => 34.2,
                'greixos' => 6.8,
                'calories' => 216
            ],
            [
                'nom_plat' => 'Truita de verdures',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom' => 'Espàrrecs', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Berenjena', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Ceba', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteïnes' => 11.8,
                'carbohidrats' => 6.3,
                'greixos' => 11.5,
                'calories' => 176
            ],[
                'nom_plat' => 'Batut de proteïna amb fruita',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Proteïna en pols', 'quantitat' => 1, 'unitat' => 'serving'],
                    ['nom' => 'Maduixes', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Llet d\'ametlles', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteïnes' => 28.4,
                'carbohidrats' => 28.9,
                'greixos' => 9.3,
                'calories' => 315
            ],
            [
                'nom_plat' => 'Iogurt amb fruits secs',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Iogurt', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom' => 'Nous', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom' => 'Alvocat', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteïnes' => 6.8,
                'carbohidrats' => 9.3,
                'greixos' => 14.5,
                'calories' => 187
            ],
            [
                'nom_plat' => 'Batut de fruita i ametlles',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Ametlles', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom' => 'Llet', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteïnes' => 7.2,
                'carbohidrats' => 31.4,
                'greixos' => 8.6,
                'calories' => 238
            ],
            [
                'nom_plat' => 'Torrades amb alvocat i tomàquet',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'trossos'],
                    ['nom' => 'Alvocat', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat']
                ]),
                'proteïnes' => 6.1,
                'carbohidrats' => 24.5,
                'greixos' => 9.2,
                'calories' => 200
            ],
            [
                'nom_plat' => 'Macedònia de fruites amb iogurt',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Poma', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Iogurt', 'quantitat' => 150, 'unitat' => 'grams']
                ]),
                'proteïnes' => 5.9,
                'carbohidrats' => 28.2,
                'greixos' => 3.7,
                'calories' => 171
            ],
            [
                'nom_plat' => 'Barretes de cereals amb fruits secs',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Barretes de cereals', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Fruits secs variats', 'quantitat' => 30, 'unitat' => 'grams']
                ]),
                'proteïnes' => 3.2,
                'carbohidrats' => 31.5,
                'greixos' => 8.6,
                'calories' => 205
            ],
            [
                'nom_plat' => 'Ous remenats amb espinacs',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Ous', 'quantitat' => 2, 'unitat' => 'unitats'],
                    ['nom' => 'Espinacs', 'quantitat' => 50, 'unitat' => 'grams']
                ]),
                'proteïnes' => 13.1,
                'carbohidrats' => 2.1,
                'greixos' => 14.9,
                'calories' => 206
            ],
            [
                'nom_plat' => 'Batut de proteïna amb fruita',
                'apat' => 'segon esmorzar',
                'ingredients' => json_encode([
                    ['nom' => 'Proteïna en pols', 'quantitat' => 1, 'unitat' => 'serving'],
                    ['nom' => 'Maduixes', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Llet d\'ametlles', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteïnes' => 28.4,
                'carbohidrats' => 28.9,
                'greixos' => 9.3,
                'calories' => 315
            ],   
            [
                'nom_plat' => 'Batut de proteïnes amb plàtan',
                'apat' => 'post-entrenament',
                'ingredients' => json_encode([
                    ['nom' => 'Proteïna en pols (sabor a vainilla)', 'quantitat' => 30, 'unitat' => 'grams'],
                    ['nom' => 'Llet d\'ametlla', 'quantitat' => 250, 'unitat' => 'ml'],
                    ['nom' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Mantega d\'ametlla', 'quantitat' => 15, 'unitat' => 'grams'],
                    ['nom' => 'Glaç', 'quantitat' => 'al gust']
                ]),
                'proteïnes' => 25.7,
                'carbohidrats' => 32.4,
                'greixos' => 12.9,
                'calories' => 340
            ],
            [
                'nom_plat' => 'Truita de clares d\'ou amb espinacs',
                'apat' => 'post-entrenament',
                'ingredients' => json_encode([
                    ['nom' => 'Clares d\'ou', 'quantitat' => 6, 'unitat' => 'unitats'],
                    ['nom' => 'Espinacs frescs', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Formatge cottage baix en greix', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Tomàquet cherry', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Oli d\'oliva', 'quantitat' => 5, 'unitat' => 'ml']
                ]),
                'proteïnes' => 27.8,
                'carbohidrats' => 6.3,
                'greixos' => 8.2,
                'calories' => 218
            ],
            [
                'nom_plat' => 'Sandvitx de gall dindi i alvocat en pa integral',
                'apat' => 'post-entrenament',
                'ingredients' => json_encode([
                    ['nom' => 'Gall dindi en llesques', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Alvocat', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'tallades'],
                    ['nom' => 'Enciam', 'quantitat' => 'al gust'],
                    ['nom' => 'Tomàquet', 'quantitat' => 'al gust']
                ]),
                'proteïnes' => 18.5,
                'carbohidrats' => 28.7,
                'greixos' => 10.9,
                'calories' => 276
            ],
            [
                'nom_plat' => 'Iogurt grec amb fruites i granola',
                'apat' => 'post-entrenament',
                'ingredients' => json_encode([
                    ['nom' => 'Iogurt grec baix en greix', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Rais', 'quantitat' => 30, 'unitat' => 'grams'],
                    ['nom' => 'Granola sense sucre afegit', 'quantitat' => 20, 'unitat' => 'grams']
                ]),
                'proteïnes' => 15.4,
                'carbohidrats' => 27.8,
                'greixos' => 4.9,
                'calories' => 205
            ],
            [
                'nom_plat' => 'Amanida de quinoa amb pollastre a la graella',
                'apat' => 'post-entrenament',
                'ingredients' => json_encode([
                    ['nom' => 'Quinoa cuita', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom' => 'Pit de pollastre a la graella', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom' => 'Pebrer vermell', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Pebrer verd', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Ceba vermella', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteïnes' => 32.1,
                'carbohidrats' => 32.9,
                'greixos' => 11.5,
                'calories' => 375
            ],
            [
                'nom_plat' => 'Batut de proteïnes amb fruita i ametlles',
                'apat' => 'berenar',
                'ingredients' => json_encode([
                    ['nom' => 'Proteïna en pols (sabor a vainilla)', 'quantitat' => 30, 'unitat' => 'grams'],
                    ['nom' => 'Llet d\'ametlla', 'quantitat' => 250, 'unitat' => 'ml'],
                    ['nom' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Ametlles', 'quantitat' => 20, 'unitat' => 'grams']
                ]),
                'proteïnes' => 25.7,
                'carbohidrats' => 32.4,
                'greixos' => 12.9,
                'calories' => 340
            ],
            [
                'nom_plat' => 'Iogurt grec amb fruits secs i mel',
                'apat' => 'berenar',
                'ingredients' => json_encode([
                    ['nom' => 'Iogurt grec baix en greix', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom' => 'Nous', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom' => 'Avellanes', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom' => 'Mel', 'quantitat' => 'al gust']
                ]),
                'proteïnes' => 11.5,
                'carbohidrats' => 19.8,
                'greixos' => 9.2,
                'calories' => 200
            ],
            [
                'nom_plat' => 'Crema d\'ametlles amb tostades de pa integral',
                'apat' => 'berenar',
                'ingredients' => json_encode([
                    ['nom' => 'Crema d\'ametlles', 'quantitat' => 30, 'unitat' => 'grams'],
                    ['nom' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'trossos'],
                    ['nom' => 'Plàtans', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Mel', 'quantitat' => 'al gust']
                ]),
                'proteïnes' => 6.4,
                'carbohidrats' => 33.7,
                'greixos' => 14.8,
                'calories' => 289
            ],
            [
                'nom_plat' => 'Sàndwich de salmó fumat amb cogombre i formatge fresc',
                'apat' => 'berenar',
                'ingredients' => json_encode([
                    ['nom' => 'Salmó fumat', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Cogombre', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom' => 'Formatge fresc baix en greix', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Pa integral', 'quantitat' => 2, 'unitat' => 'trossos']
                ]),
                'proteïnes' => 22.3,
                'carbohidrats' => 29.6,
                'greixos' => 9.5,
                'calories' => 292
            ],
            [
                'nom_plat' => 'Bol de cereals integrals amb fruita fresca i llet',
                'apat' => 'berenar',
                'ingredients' => json_encode([
                    ['nom' => 'Cereals integrals', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Llet d\'ametlla', 'quantitat' => 200, 'unitat' => 'ml'],
                    ['nom' => 'Maduixes', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Plàtan', 'quantitat' => 1/2, 'unitat' => 'unitat']
                ]),
                'proteïnes' => 9.8,
                'carbohidrats' => 41.2,
                'greixos' => 6.3,
                'calories' => 265
            ],
            [
                'nom_plat' => 'Saltejat de verdures amb tofu',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom' => 'Tofu', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom' => 'Broquil', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom' => 'Pastanaga', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Ceba', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Berenjena', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteïnes' => 18.2,
                'carbohidrats' => 14.8,
                'greixos' => 8.6,
                'calories' => 220
            ],
            [
                'nom_plat' => 'Salmó al forn amb patata dolça i espàrrecs',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom' => 'Filet de salmó', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom' => 'Patata dolça', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Espàrrecs', 'quantitat' => 6, 'unitat' => 'unitats'],
                    ['nom' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml'],
                    ['nom' => 'Llimona', 'quantitat' => 'al gust'],
                    ['nom' => 'Sal i pebre', 'quantitat' => 'al gust']
                ]),
                'proteïnes' => 23.5,
                'carbohidrats' => 18.9,
                'greixos' => 9.7,
                'calories' => 280
            ],
            [
                'nom_plat' => 'Quinoa amb pollastre i verdures al vapor',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom' => 'Quinoa', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom' => 'Pit de pollastre', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom' => 'Bròquil', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Pastanaga', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteïnes' => 31.2,
                'carbohidrats' => 28.6,
                'greixos' => 11.4,
                'calories' => 375
            ],
            [
                'nom_plat' => 'Amanida de tonyina amb enciam, tomàquet i oli d\'oliva',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom' => 'Tonyina en conserva', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom' => 'Enciam', 'quantitat' => 1, 'unitat' => 'tassa'],
                    ['nom' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteïnes' => 25.8,
                'carbohidrats' => 5.2,
                'greixos' => 10.4,
                'calories' => 230
            ],
            [
                'nom_plat' => 'Pasta integral amb gambes i tomàquet',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom' => 'Pasta integral', 'quantitat' => 80, 'unitat' => 'grams'],
                    ['nom' => 'Gambes', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'All', 'quantitat' => 1/2, 'unitat' => 'dents'],
                    ['nom' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteïnes' => 20.1,
                'carbohidrats' => 31.5,
                'greixos' => 6.8,
                'calories' => 276
            ],
            [
                'nom_plat' => 'Pollastre al forn amb patates i bròquil',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom' => 'Pit de pollastre', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom' => 'Patata', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Bròquil', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml'],
                    ['nom' => 'Sal i pebre', 'quantitat' => 'al gust']
                ]),
                'proteïnes' => 26.4,
                'carbohidrats' => 21.8,
                'greixos' => 10.5,
                'calories' => 296
            ],
            [
                'nom_plat' => 'Llenties estofades amb verdures',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom' => 'Llenties', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom' => 'Ceba', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Pastanaga', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Tomàquet', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom' => 'Oli d\'oliva', 'quantitat' => 10, 'unitat' => 'ml']
                ]),
                'proteïnes' => 14.7,
                'carbohidrats' => 27.5,
                'greixos' => 5.8,
                'calories' => 218
            ],
            [
                'nom_plat' => 'Sopa de verdures amb fideus integrals',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom' => 'Fideus integrals', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom' => 'Bròquil', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Pastanaga', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Ceba', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Caldo vegetal', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteïnes' => 8.3,
                'carbohidrats' => 17.5,
                'greixos' => 2.1,
                'calories' => 125
            ],
            [
                'nom_plat' => 'Tacos de peix al vapor amb salsa de mango',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom' => 'Filet de peix blanc', 'quantitat' => 150, 'unitat' => 'grams'],
                    ['nom' => 'Mango', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Ceba vermella', 'quantitat' => 1/4, 'unitat' => 'unitat'],
                    ['nom' => 'Culantro', 'quantitat' => 'al gust'],
                    ['nom' => 'Llimona', 'quantitat' => 'al gust']
                ]),
                'proteïnes' => 28.1,
                'carbohidrats' => 15.4,
                'greixos' => 7.9,
                'calories' => 245
            ],
            [
                'nom_plat' => 'Ratatouille amb quinoa',
                'apat' => 'sopar',
                'ingredients' => json_encode([
                    ['nom' => 'Quinoa', 'quantitat' => 80, 'unitat' => 'grams'],
                    ['nom' => 'Albergínia', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Ceba', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Pebrer vermell', 'quantitat' => 1/2, 'unitat' => 'unitat'],
                    ['nom' => 'Tomàquet triturat', 'quantitat' => 100, 'unitat' => 'ml']
                ]),
                'proteïnes' => 11.6,
                'carbohidrats' => 31.9,
                'greixos' => 5.4,
                'calories' => 215
            ]
              ];
        
              DB::table('aliments')->insert($data);
          
    }
}
