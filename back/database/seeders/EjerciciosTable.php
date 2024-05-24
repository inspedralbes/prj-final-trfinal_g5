<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EjerciciosTable extends Seeder
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
                "nom_exercici" => "Curl de Martell Inclinat",
                "dificultat" => "principiant",
                "idCategoria" => 1,
                "imatge" => "1imatge_curl_martillo_inclinado.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/24941201.mp4",
                "descripció" => "Flexiona els colzes elevant les mancuernes cap als muscles en banc inclinat."
            ],
            [
                "id" => 2,
                "nom_exercici" => "Curl de Barra d'Agafador Ampli",
                "dificultat" => "principiant",
                "idCategoria" => 1,
                "imatge" => "2imatge_curl_barra_agarre_ancho.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/35921201.mp4",
                "descripció" => "Flexiona els colzes elevant la barra amb un agafador ampli cap als muscles."
            ],
            [
                "id" => 3,
                "nom_exercici" => "Curl de Martell",
                "dificultat" => "intermedi",
                "idCategoria" => 1,
                "imatge" => "3imatge_curl_martillo.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/03121201.mp4",
                "descripció" => "Aixeca les mancuernes cap als muscles mantenint les palmes cap a dins."
            ],
            [
                "id" => 4,
                "nom_exercici" => "Curl de Barra Z",
                "dificultat" => "intermedi",
                "idCategoria" => 1,
                "imatge" => "4imatge_curl_barra_z.jpg",
                "link" =>"https://youtu.be/no-dXip-rJM",
                "descripció" => "Flexiona els colzes elevant la barra Z cap als muscles."
            ],
            [
                "id" => 5,
                "nom_exercici" => "Curl de Barra",
                "dificultat" => "intermedi",
                "idCategoria" => 1,
                "imatge" => "5imatge_curl_barra.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/35921201.mp4",
                "descripció" => "Flexiona els colzes elevant la barra agafantla a una amplitut basante en l'espatlla recta cap als muscles."
            ],
            [
                "id" => 6,
                "nom_exercici" => "Curl Concentrat",
                "dificultat" => "intermedi",
                "idCategoria" => 1,
                "imatge" => "6imatge_curl_concentrado.jpg",
                "link" =>"https://youtu.be/EbOn-SVVbaA",
                "descripció" => "Realitza curls concentrats per aïllar i enfortir els bíceps."
            ],
            // [
            //     "id" => 7,
            //     "nom_exercici" => "Curl de Martell Inclinat Flexor",
            //     "dificultat" => "principiant",
            //     "idCategoria" => 1,
            //     "imatge" => "imatge_curl_martillo_inclinado_flexor.jpg",
            //     "descripció" => "Flexiona els colzes elevant les mancuernes cap als muscles amb agafada neutra."
            // ],
            [
                "id" => 8,
                "nom_exercici" => "Gir de barra",
                "dificultat" => "intermedi",
                "idCategoria" => 2,
                "imatge" => "8imatge_giro_barra.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/00941201.mp4",
                "descripció" => "Fes girs amb la barra per enfortir els abdominals."
            ],
            [
                "id" => 9,
                "nom_exercici" => "Plancha de colzes",
                "dificultat" => "intermedi",
                "idCategoria" => 2,
                "imatge" => "9imatge_plancha_codos.jpg",
                "link" =>"https://www.youtube.com/embed/ygJCAPiRMDg",
                "descripció" => "Mantén la posició de planxa amb colzes recolzats."
            ],
            [
                "id" => 10,
                "nom_exercici" => "Abdominals suspesos",
                "dificultat" => "intermèdia",
                "idCategoria" => 2,
                "imatge" => "10imatge_abdominales_suspendidos.jpg",
                "link" =>"https://www.youtube.com/embed/yLuqrzNT6yw",
                "descripció" => "Aixeca cames amb el tors suspès per enfortir el core."
            ],
            [
                "id" => 11,
                "nom_exercici" => "Jab Creuat V-sit amb Mancurna",
                "dificultat" => "intermedi",
                "idCategoria" => 2,
                "imatge" => "11imatge_jab_cruzado_mancuerna.jpg",
                "link" =>"https://www.youtube.com/embed/VF7N6ZzrLWg",
                "descripció" => "Assegut, realitza jab creuat amb mancurna en posició V-Sit."
            ],
            [
                "id" => 12,
                "nom_exercici" => "Gir de Cable de baix a alt",
                "dificultat" => "intermedi",
                "idCategoria" => 3,
                "imatge" => "12imatge_giro_cable.jpg",
                "link" =>"https://www.youtube.com/embed/watch?v=olXNyQ5Yaps",
                "descripció" => "Dret, gira el cable de baix cap amunt."
            ],
            [
                "id" => 13,
                "nom_exercici" => "Llançador de sortilegis amb Mancuernes",
                "dificultat" => "principiant",
                "idCategoria" => 2,
                "imatge" => "13imatge_lanzador_hechizos_mancuernas.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/07771201.mp4",
                "descripció" => "Dret, aixeca les mancuernes amb braços estesos."
            ],
            [
                "id" => 14,
                "nom_exercici" => "Crunch Invers Declinat",
                "dificultat" => "intermedi",
                "idCategoria" => 2,
                "imatge" => "14imatge_crunch_inverso_banco_declinado.jpg",
                "link" =>"https://youtu.be/SJub6eDszec",
                "descripció" => "Fes crunch invers a banc declinat per a abdominals inferiors."
            ],
            [
                "id" => 15,
                "nom_exercici" => "Cercles de Cadera d'Peu",
                "dificultat" => "principiant",
                "idCategoria" => 3,
                "imatge" => "15imatge_circulos_cadera.jpg",
                "link" =>"https://media.physitrack.com/exercises/f813695a-4c07-42cb-bdad-7550de74e83f/es/video_720p.mp4",
                "descripció" => "Dret, fes cercles amb la cadera per abductors."
            ],
            // [
            //     "id" => 16,
            //     "nom_exercici" => "Moviments Circulars de Cames",
            //     "dificultat" => "intermedi",
            //     "idCategoria" => 3,
            //     "imatge" => "imatge_movimientos_circulares_piernas.jpg",
            //     "descripció" => "Dret, realitza moviments circulars amb les cames."
            // ],
            [
                "id" => 17,
                "nom_exercici" => "Hip-Thrust amb barra",
                "dificultat" => "intermedi",
                "idCategoria" => 5,
                "imatge" => "17imatge_empuje_cadera_barra.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/22161201.mp4",
                "descripció" => "Empenta de cadera amb una barra y pes des de posició asseguda per enfortir glúteos."
            ],
            [
                "id" => 18,
                "nom_exercici" => "Press de Banca amb Mancuernes",
                "dificultat" => "principiant",
                "idCategoria" => 4,
                "imatge" => "18imatge_press_banca_mancuernas.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/02891201.mp4",
                "descripció" => "Acostat, press de banca amb mancuernes per pectorals."
            ],
            [
                "id" => 19,
                "nom_exercici" => "Flexions de Pit",
                "dificultat" => "intermedi",
                "idCategoria" => 4,
                "imatge" => "19imatge_flexiones_plancha.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/31451201.mp4",
                "descripció" => "Flexions des de posició de planxa per pectorals."
            ],
            [
                "id" => 20,
                "nom_exercici" => "Press de Inclinat amb Mancuernes",
                "dificultat" => "intermedi",
                "idCategoria" => 4,
                "imatge" => "20imatge_press_inclinado_mancuernas.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/24411201.mp4",
                "descripció" => "Press de banca inclinat amb mancuernes per pectorals superiors."
            ],
            [
                "id" => 21,
                "nom_exercici" => "Cross-Over amb Cables Baixos",
                "dificultat" => "principiant",
                "idCategoria" => 4,
                "imatge" => "21imatge_cross_over_cables_bajos.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/22521201.mp4",
                "descripció" => "Cross-over amb cables baixos per aïllar pectorals."
            ],
            [
                "id" => 22,
                "nom_exercici" => "Press de Banca amb Barra",
                "dificultat" => "intermedi",
                "idCategoria" => 4,
                "imatge" => "22imatge_press_banca_barra.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/24401201.mp4",
                "descripció" => "Acostat, press de banca amb barra per pectorals."
            ],
            [
                "id" => 23,
                "nom_exercici" => "Dips de Pit",
                "dificultat" => "intermedi",
                "idCategoria" => 4,
                "imatge" => "23imatge_dips_enfocados_pecho.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/02511201.mp4",
                "descripció" => "Dips enfocats en pit per a pectorals i tríceps."
            ],
            [
                "id" => 24,
                "nom_exercici" => "Apertures amb Mancuernes inclinades",
                "dificultat" => "intermedi",
                "idCategoria" => 4,
                "imatge" => "24imatge_aperturas_mancuernas_inclinadas.jpg",
                "link" =>"https://youtu.be/3bBv7kgOzmE",
                "descripció" => "Apertures amb mancuernes inclinades per pectorals inferiors."
            ],
            [
                "id" => 25,
                "nom_exercici" => "Apertures amb Mancuernes planes",
                "dificultat" => "principiant",
                "idCategoria" => 4,
                "imatge" => "25imatge_aperturas_mancuernas_planes.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/22161201.mp4",
                "descripció" => "Apertures amb mancuernes per pectorals amb el banc pla."
            ],
            [
                "id" => 26,
                "nom_exercici" => "Hip-Thrust",
                "dificultat" => "intermedi",
                "idCategoria" => 5,
                "imatge" => "17imatge_empuje_cadera.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/21451201.mp4",
                "descripció" => "Empenta de cadera des de posició asseguda per enfortir glúteos."
            ],
            [
                "id" => 27,
                "nom_exercici" => "Extensions de Cadera amb Cable en una Cama",
                "dificultat" => "intermedi",
                "idCategoria" => 5,
                "imatge" => "27imatge_extensiones_cadera_cable_pierna.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/08801201.mp4",
                "descripció" => "Extensions de cadera amb cable en una cama per a glúteos."
            ],
            [
                "id" => 28,
                "nom_exercici" => "Pont de Glúteos",
                "dificultat" => "principiant",
                "idCategoria" => 5,
                "imatge" => "28imatge_puente_gluteos.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/24711201.mp4",
                "descripció" => "Pont de glúteos des de posició acostada per enfortir-los."
            ],
            [
                "id" => 29,
                "nom_exercici" => "Pont de Glúteos en una Cama",
                "dificultat" => "intermedi",
                "idCategoria" => 5,
                "imatge" => "29imatge_puente_gluteos_pierna.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/24731201.mp4",
                "descripció" => "Pont de glúteos en una cama per a estabilitat."
            ],
            [
                "id" => 30,
                "nom_exercici" => "Elevació de Genoll",
                "dificultat" => "principiant",
                "idCategoria" => 3,
                "imatge" => "30imatge_elevacion_rodilla_pecho.jpg",
                "link" =>"https://youtu.be/iBpgkuFuENY",
                "descripció" => "Eleva el genoll al pit mentre fas un pas."
            ],
            [
                "id" => 31,
                "nom_exercici" => "Sentadilla des de Posició Genolls",
                "dificultat" => "principiant",
                "idCategoria" => 5,
                "imatge" => "31imatge_sentadilla_posicion_arrodillada.jpg",
                "link" =>"https://youtu.be/ypWwfzVw6go",
                "descripció" => "Sentadilla des de posició genolls per als glutis."
            ],
            [
                "id" => 32,
                "nom_exercici" => "Puntada Laterals des de Posició Quadrúpeda",
                "dificultat" => "intermedi",
                "idCategoria" => 5,
                "imatge" => "32imatge_patadas_laterales_cuadrupeda.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/14751201.mp4",
                "descripció" => "puntada cap als costats des de posició quadrúpeda per als glutis."
            ],
            [
                "id" => 33,
                "nom_exercici" => "Puntada cap enrere des de Posició d'Peu",
                "dificultat" => "principiant",
                "idCategoria" => 5,
                "imatge" => "33imatge_patada_atras_posicion_pie.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/36131201.mp4",
                "descripció" => "Puntada cap enrere des de posició d'peu per als glutis."
            ],
            [
                "id" => 34,
                "nom_exercici" => "Pes Mort amb Barra",
                "dificultat" => "intermedi",
                "idCategoria" => 6,
                "imatge" => "34imatge_levantamiento_barra_suelo.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/00321201.mp4",
                "descripció" => "Aixeca la barra des del sòl per enfortir els isquiotibials."
            ],
            [
                "id" => 35,
                "nom_exercici" => "Pes Mort Roma amb mancuernes",
                "dificultat" => "principiant",
                "idCategoria" => 6,
                "imatge" => "35imatge_peso_muerto_mancuernas.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/14591201.mp4",
                "descripció" => "Pes mort amb mancuernes des de posició inclinada per als isquiotibials."
            ],
            [
                "id" => 36,
                "nom_exercici" => "Aixecament de Barra fins als muscles",
                "dificultat" => "principiant",
                "idCategoria" => 6,
                "imatge" => "36imatge_levantamiento_barra_hombros.jpg",
                "link" =>"https://www.youtube.com/embed/Bvlxg2HwgJQ",
                "descripció" => "Aixeca la barra fins als muscles en un sol moviment."
            ],
            [
                "id" => 37,
                "nom_exercici" => "Pes Mort Sumo",
                "dificultat" => "principiant",
                "idCategoria" => 6,
                "imatge" => "37imatge_peso_muerto_sumo.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/01171201.mp4",
                "descripció" => "Pes mort amb peus separats per treballar els isquiotibials."
            ],
            [
                "id" => 38,
                "nom_exercici" => "Pes Mort Romania des d'un Dèficit",
                "dificultat" => "principiant",
                "idCategoria" => 6,
                "imatge" => "38imatge_peso_muerto_rumano_deficit.jpg",
                "link" =>"https://www.youtube.com/embed/J4i88TYvGjc",
                "descripció" => "Pes mort romà des de posició més baixa."
            ],
            // [
            //     "id" => 39,
            //     "nom_exercici" => "Elevació Natural de Glutis i Isquiotibials",
            //     "dificultat" => "principiant",
            //     "idCategoria" => 6,
            //     "imatge" => "39imatge_elevacion_natural_gluteos_isquiotibiales.jpg",
            //     "link" =>"",
            //     "descripció" => "Aixeca les cames estirat per enfortir glutis i isquiotibials."
            // ],
            // [
            //     "id" => 40,
            //     "nom_exercici" => "Elevació de Glutis i Isquiotibials",
            //     "dificultat" => "principiant",
            //     "idCategoria" => 6,
            //     "imatge" => "40imatge_elevacion_gluteos_isquiotibiales.jpg",
            //     "link" =>"",
            //     "descripció" => "Aixeca les cames estirat per enfortir glutis i isquiotibials."
            // ],
            [
                "id" => 41,
                "nom_exercici" => "Pes Mort d'Arrencada",
                "dificultat" => "principiant",
                "idCategoria" => 6,
                "imatge" => "34imatge_levantamiento_barra_suelo.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/00321201.mp4",
                "descripció" => "Aixeca la barra en un moviment explosiu."
            ],
            [
                "id" => 42,
                "nom_exercici" => "Jaló Obert Polies Altes",
                "dificultat" => "principiant",
                "idCategoria" => 7,
                "imatge" => "42imatge_jalon_abierto_poleas_altas.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/01971201.mp4",
                "descripció" => "Ajusta el pes i subjecta les empunyadures de forma ampla. Porta les mans cap avall i els costats."
            ],
            [
                "id" => 43,
                "nom_exercici" => "Jaló d'Agafador Tancat",
                "dificultat" => "intermedi",
                "idCategoria" => 7,
                "imatge" => "43imatge_jalon_agarre_cerrado.jpg",
                "link" =>"https://www.youtube.com/embed/IgzxdPVZmyw",
                "descripció" => "Amb agafador tancat, tira cap avall mantenint els colzes a prop."
            ],
            [
                "id" => 44,
                "nom_exercici" => "Dominades",
                "dificultat" => "principiant",
                "idCategoria" => 7,
                "imatge" => "44imatge_dominadas.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/39001201.mp4",
                "descripció" => "Agafa la barra amb mans a l'amplada dels muscles."
            ],
            [
                "id" => 45,
                "nom_exercici" => "Rem amb Barra",
                "dificultat" => "intermedi",
                "idCategoria" => 7,
                "imatge" => "45imatge_remo_barra.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/22421201.mp4",
                "descripció" => "Inclina't cap endavant amb agafada ampla i porta la barra a l'abdomen."
            ],
            [
                "id" => 46,
                "nom_exercici" => "Jaló d'Agafador Tancat Frontal",
                "dificultat" => "intermedi",
                "idCategoria" => 7,
                "imatge" => "46imatge_jalon_agarre_cerrado_frontal.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/37541201.mp4",
                "descripció" => "Amb agafador tancat frontal, porta la barra cap avall al front."
            ],
            [
                "id" => 47,
                "nom_exercici" => "Dominades frontals",
                "dificultat" => "intermedi",
                "idCategoria" => 7,
                "imatge" => "47imatge_dominadas_frontales.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/23821201.mp4",
                "descripció" => "Agafa la barra de forma supina de forma tancada i realitza el moviment."
            ],
            [
                "id" => 48,
                "nom_exercici" => "Dominades Asistides amb Màquina",
                "dificultat" => "principiant",
                "idCategoria" => 7,
                "imatge" => "48imatge_Dominades_Asistides.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/05721201.mp4",
                "descripció" => "Agafa la barra de forma supina amb mans a l'amplada dels muscles y amb ajut de la maquina fes el moviment."
            ],
            [
                "id" => 49,
                "nom_exercici" => "Hiperextensions amb Banc",
                "dificultat" => "principiant",
                "idCategoria" => 8,
                "imatge" => "49imatge_hiperextensiones_en_banco.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/18601201.mp4",
                "descripció" => "Fes una extensió cap enrere recolzat en un banc per enfortir la part baixa de l'esquena."
            ],
            [
                "id" => 50,
                "nom_exercici" => "Pes Mort amb Bandes",
                "dificultat" => "principiant",
                "idCategoria" => 8,
                "imatge" => "50imatge_peso_muerto_bandas.jpg",
                "link" =>"https://www.youtube.com/embed/q65l6-MlvvA",
                "descripció" => "Aixeca la barra amb bandes de resistència per enfortir la part baixa de l'esquena."
            ],
            [
                "id" => 51,
                "nom_exercici" => "Pes Mort amb mancuernes",
                "dificultat" => "principiant",
                "idCategoria" => 8,
                "imatge" => "51imatge_peso_muerto_mancuernas.jpg",
                "link" =>"https://www.youtube.com/embed/jLmZCDBqzx0",
                "descripció" => "Aixeca les mancuernes fins a la cadera per enfortir la part baixa de l'esquena."
            ],
            [
                "id" => 52,
                "nom_exercici" => "Extensio d'esquena en maquina",
                "dificultat" => "intermedi",
                "idCategoria" => 8,
                "imatge" => "52imatge_extension_espalda.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/36071201.mp4",
                "descripció" => "Colocat a la maquina fes el moviment rotatio d'avall cap amunt per enfortir la part baixa de l'esquena."
            ],
            [
                "id" => 53,
                "nom_exercici" => "Rem amb barra-T",
                "dificultat" => "intermedi",
                "idCategoria" => 9,
                "imatge" => "53imatge_remo_barraT.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/06061201.mp4",
                "descripció" => "Agafa l'asa i tira cap a l'abdomen mantenint l'esquena recta. Es pot fer amb barra, mancuernes o maquina."
            ],
            [
                "id" => 54,
                "nom_exercici" => "Rem amb Barra Inclinada d'Agafador Revertit",
                "dificultat" => "intermedi",
                "idCategoria" => 9,
                "imatge" => "54imatge_remo_barra_inclinada_agarre_revertido.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/01181201.mp4",
                "descripció" => "Inclina't cap endavant i tira la barra cap a l'abdomen."
            ],
            [
                "id" => 55,
                "nom_exercici" => "Rem amb Mancuerna d'un Braç",
                "dificultat" => "intermedi",
                "idCategoria" => 9,
                "imatge" => "55imatge_remo_mancuerna_un_brazo.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/23931201.mp4",
                "descripció" => "Tira de la mancuerna cap a l'abdomen mantenint l'esquena recta. Es pot fer amb banc pla o inclinat."
            ],
            [
                "id" => 56,
                "nom_exercici" => "Rem amb Barra d'un Braç",
                "dificultat" => "intermedi",
                "idCategoria" => 9,
                "imatge" => "56imatge_remo_barra_un_brazo.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/40381201.mp4",
                "descripció" => "Tira de la barra cap a l'abdomen mantenint l'esquena recta."
            ],
            // [
            //     "id" => 57,
            //     "nom_exercici" => "Rem T-Bar",
            //     "dificultat" => "intermedi",
            //     "idCategoria" => 9,
            //     "imatge" => "57imatge_remo_tbar.jpg",
            //     "link" =>"",
            //     "descripció" => "Agafa l'asa i tira la barra cap a l'abdomen."
            // ],
            [
                "id" => 58,
                "nom_exercici" => "Rem amb Barra de Dos Braços Inclinada",
                "dificultat" => "intermedi",
                "idCategoria" => 9,
                "imatge" => "58imatge_remo_barra_dos_brazos_inclinado.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/00271201.mp4",
                "descripció" => "Inclina't cap endavant i tira la barra cap a l'abdomen."
            ],
            [
                "id" => 59,
                "nom_exercici" => "Rem de Màquina",
                "dificultat" => "intermedi",
                "idCategoria" => 9,
                "imatge" => "59imatge_remo_maquina.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/05881201.mp4",
                "descripció" => "Tira dels punys cap al tors mantenint l'esquena recta."
            ],
            [
                "id" => 60,
                "nom_exercici" => "Rem Assegut amb Polzada",
                "dificultat" => "intermedi",
                "idCategoria" => 9,
                "imatge" => "60imatge_remo_sentado_polea.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/13231201.mp4",
                "descripció" => "Tira de la corda de forma oberta cap a l'abdomen mantenint l'esquena recta."
            ],
            [
                "id" => 61,
                "nom_exercici" => "Rem Inclinat amb mancuernes",
                "dificultat" => "intermedi",
                "idCategoria" => 9,
                "imatge" => "61imatge_remo_inclinado_mancuernas.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/24821201.mp4",
                "descripció" => "Porta els colzes cap amunt i cap enrere amb les mancuernes."
            ], 
            [
                "id" => 62,
                "nom" => "Pressa inclinada 45º amb una cama",
                "dificultat" => "intermèdia",
                "idCategoria" => 10,
                "imatge" => "62imatge_pressa_amb_una_cama.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/14251201.mp4",
                "descripció" => "Posa un peu a la plataforma i prem cap amunt."
            ],
            [
                "id" => 63,
                "nom" => "Pressa Inclinada",
                "dificultat" => "principiant",
                "idCategoria" => 10,
                "imatge" => "63imatge_pressa_inclinada.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/07391201.mp4",
                "descripció" => "Asseu-te a la màquina amb l'esquena enganxada al respatller."
            ],
            [
                "id" => 64,
                "nom" => "Sentadilla Completa amb Barra",
                "dificultat" => "intermèdia",
                "idCategoria" => 10,
                "imatge" => "64imatge_sentadilla_completa_barra.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/01241201.mp4",
                "descripció" => "Descendeix flexionant genolls i malucs fins que l'espatlla sigui paral·la al terra."
            ],
            // [
            //     "id" => 65,
            //     "nom" => "Empenta-pressa",
            //     "dificultat" => "intermèdia",
            //     "idCategoria" => 10,
            //     "imatge" => "65imatge_empenta_pressa.jpg",
            //     "link" =>"",
            //     "descripció" => "Impulsa la barra des de l'espatlla amb l'ajuda de les cames."
            // ],
            [
                "id" => 66,
                "nom" => "Elevació barra hombrofrontal sentadilla",
                "dificultat" => "intermèdia",
                "idCategoria" => 10,
                "imatge" => "66imatge_elevacio_hombrofrontal_sentadilla.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/00421201.mp4",
                "descripció" => "Aixeca la barra des dels espatlla amb una sentadilla."
            ],
            [
                "id" => 67,
                "nom" => "Sentadilla amb Banda",
                "dificultat" => "intermèdia",
                "idCategoria" => 10,
                "imatge" => "67imatge_sentadilla_amb_banda.jpg",
                "link" =>"https://www.youtube.com/embed/i3aW4gekSRk",
                "descripció" => "Realitza sentadilles amb resistència addicional d'una banda elàstica."
            ],
            [
                "id" => 68,
                "nom" => "Salt de Corda",
                "dificultat" => "principiant",
                "idCategoria" => 10,
                "imatge" => "68imatge_salt_corda.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/26121201.mp4",
                "descripció" => "Salta sobre una corda mantenint el ritme continu."
            ],
            [
                "id" => 69,
                "nom" => "Elevació d'espatlles en màquina",
                "dificultat" => "intermèdia",
                "idCategoria" => 11,
                "imatge" => "69imatge_elevacio_espatlles_maquina.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/14541201.mp4",
                "descripció" => "Aixeca les espatlles cap amunt utilitzant una màquina especialitzada."
            ],
            [
                "id" => 70,
                "nom" => "Encogiment d'espatlles amb barra",
                "dificultat" => "principiant",
                "idCategoria" => 11,
                "imatge" => "70imatge_encogiment_espatlles_barra.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/00951201.mp4",
                "descripció" => "Encogeix les espatlles cap amunt amb pes addicional."
            ],
            // [
            //     "id" => 71,
            //     "nom_exercici" => "Press Francès amb Màquina",
            //     "dificultat" => "intermèdia",
            //     "idCategoria" => 12,
            //     "imatge" => "71imatge_press_frances_maquina.jpg",
            //     "link" =>"",
            //     "descripció" => "Flexiona els colzes amb la màquina cap al cap i després estén-los."
            // ],
            [
                "id" => 72,
                "nom_exercici" => "Dips de tríceps en banco",
                "dificultat" => "intermèdia",
                "idCategoria" => 12,
                "imatge" => "72imatge_dips_triceps.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/08121201.mp4",
                "descripció" => "Flexiona els braços baixant el cos i després estén-los."
            ],
            // [
            //     "id" => 73,
            //     "nom_exercici" => "Press Francès",
            //     "dificultat" => "intermèdia",
            //     "idCategoria" => 12,
            //     "imatge" => "73imatge_press_frances.jpg",
            //     "link" =>"",
            //     "descripció" => "Flexiona els braços baixant la barra darrere del cap."
            // ],
            [
                "id" => 74,
                "nom_exercici" => "Press Francès amb mancuernes",
                "dificultat" => "intermèdia",
                "idCategoria" => 12,
                "imatge" => "74imatge_press_frances_mancuernas.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/41511201.mp4",
                "descripció" => "Flexiona els braços baixant les mancunianes darrere del cap."
            ],
            [
                "id" => 75,
                "nom_exercici" => "Empenta cap avall amb Barra-V pols",
                "dificultat" => "intermèdia",
                "idCategoria" => 12,
                "imatge" => "75imatge_empuje_abajo_barra_v_polea.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/17221201.mp4",
                "descripció" => "Estira els braços cap avall utilitzant una barra en forma de V."
            ],
            [
                "id" => 76,
                "nom_exercici" => "Press Francès amb barra Z en banco plano",
                "dificultat" => "intermèdia",
                "idCategoria" => 12,
                "imatge" => "76imatge_press_frances_barra_z.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/36461201.mp4",
                "descripció" => "Flexiona els braços baixant la barra darrere del cap amb barra Z."
            ],
            [
                "id" => 77,
                "nom_exercici" => "Empenta cap avall de tríceps amb agafada invertida",
                "dificultat" => "intermèdia",
                "idCategoria" => 12,
                "imatge" => "77imatge_empuje_abajo_triceps_agarre_invertido.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/16061201.mp4",
                "descripció" => "Estira els braços cap avall amb agafada invertida."
            ],
            [
                "id" => 78,
                "nom_exercici" => "Flexions de tríceps - Posició de mans tancada",
                "dificultat" => "intermèdia",
                "idCategoria" => 12,
                "imatge" => "78imatge_flexiones_triceps_posicion_mano_cerrada.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/02591201.mp4",
                "descripció" => "Realitza flexions amb les mans prop del cos per treballar els tríceps."
            ],
            [
                "id" => 79,
                "nom_exercici" => "Extensió de tríceps amb cable d'un sol braç",
                "dificultat" => "intermèdia",
                "idCategoria" => 12,
                "imatge" => "79imatge_extension_triceps_cable_un_brazo.jpg",
                "link" =>"https://www.lyfta.app/video/GymvisualMP4/02311201.mp4",
                "descripció" => "Estira el braç cap avall amb el cable per treballar els tríceps."
            ],
            [
                "id" => 80,
                "nom_exercici" => "Extensió de tríceps amb mancuerna",
                "dificultat" => "principiant",
                "idCategoria" => 12,
                "imatge" => "80imatge_extension_triceps_mancuerna.jpg",
                "link" =>"https://www.youtube.com/embed/_44a_ecMyaw",
                "descripció" => "Flexiona i estén el braç amb la mancuerna per treballar els tríceps."
            ]
        ];

        // Insertar los datos en la base de datos
        DB::table('ejercicios')->insert($data);
    }
}