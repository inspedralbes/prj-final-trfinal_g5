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
                'nom_plat' => 'Batut de proteines amb espinacs i fruita',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Proteïna en pols', 'quantitat' => 1, 'unitat' => 'serving'],
                    ['nom_ingredient' => 'Espinacs', 'quantitat' => 50, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Maduixes', 'quantitat' => 100, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llet d\'ametlles', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteines' => 29.3,
                'carbohidrats' => 29.8,
                'greixos' => 10.1,
                'calories' => 327
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
                'nom_plat' => 'Batut de plàtan i ametlles',
                'apat' => 'esmorzar',
                'ingredients' => json_encode([
                    ['nom_ingredient' => 'Plàtan', 'quantitat' => 1, 'unitat' => 'unitat'],
                    ['nom_ingredient' => 'Ametlles', 'quantitat' => 20, 'unitat' => 'grams'],
                    ['nom_ingredient' => 'Llet', 'quantitat' => 200, 'unitat' => 'ml']
                ]),
                'proteines' => 7.3,
                'carbohidrats' => 30.1,
                'greixos' => 9.5,
                'calories' => 235
            ],
            [
                'nom_plat' => 'Sandvitx de salmó fumat',
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
            ],   
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
