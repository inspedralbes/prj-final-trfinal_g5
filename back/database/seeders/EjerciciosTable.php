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
                "nom_exercici" => "Curl de Martillo Inclinado",
                "dificultat" => "principiante",
                "idCategoria" => 1,
                "imatge" => "imatge_curl_martillo_inclinado.jpg",
                "descripció" => "Flexiona los codos levantando las mancuernas hacia los hombros."
            ],
            [
                "id" => 2,
                "nom_exercici" => "Curl de Barra de Agarre Ancho",
                "dificultat" => "principiante",
                "idCategoria" => 1,
                "imatge" => "imatge_curl_barra_agarre_ancho.jpg",
                "descripció" => "Flexiona los codos levantando la barra ancha hacia los hombros."
            ],
            [
                "id" => 3,
                "nom_exercici" => "Curl de Martillo",
                "dificultat" => "intermedio",
                "idCategoria" => 1,
                "imatge" => "imatge_curl_martillo.jpg",
                "descripció" => "Levanta las mancuernas hacia los hombros manteniendo las palmas hacia dentro."
            ],
            [
                "id" => 4,
                "nom_exercici" => "Curl de Barra Z",
                "dificultat" => "intermedio",
                "idCategoria" => 1,
                "imatge" => "imatge_curl_barra_ez.jpg",
                "descripció" => "Flexiona los codos levantando la barra Z hacia los hombros."
            ],
            [
                "id" => 5,
                "nom_exercici" => "Curl de Barra",
                "dificultat" => "intermedio",
                "idCategoria" => 1,
                "imatge" => "imatge_curl_barra.jpg",
                "descripció" => "Flexiona los codos levantando la barra recta hacia los hombros."
            ],
            [
                "id" => 6,
                "nom_exercici" => "Curl Concentrado",
                "dificultat" => "intermedio",
                "idCategoria" => 1,
                "imatge" => "imatge_curl_concentrado.jpg",
                "descripció" => "Realiza curls concentrados para aislar y fortalecer los bíceps."
            ],
            [
                "id" => 7,
                "nom_exercici" => "Curl de Martillo Inclinado Flexor",
                "dificultat" => "principiante",
                "idCategoria" => 1,
                "imatge" => "imatge_curl_martillo_inclinado_flexor.jpg",
                "descripció" => "Flexiona los codos levantando las mancuernas hacia los hombros con agarre neutro."
            ],
            [
                "id" => 8,
                "nom_exercici" => "Giro de barra",
                "dificultat" => "intermedio",
                "idCategoria" => 2,
                "imatge" => "imatge_giro_barra.jpg",
                "descripció" => "Haz giros con la barra para fortalecer los abdominales."
            ],
            [
                "id" => 9,
                "nom_exercici" => "Plancha de codos",
                "dificultat" => "intermedio",
                "idCategoria" => 2,
                "imatge" => "imatge_plancha_codos.jpg",
                "descripció" => "Mantén la posición de plancha con codos apoyados."
            ],
            [
                "id" => 10,
                "nom_exercici" => "Abdominales suspendidos",
                "dificultat" => "intermedia",
                "idCategoria" => 2,
                "imatge" => "imatge_abdominales_suspendidos.jpg",
                "descripció" => "Levanta piernas con el torso suspendido para fortalecer el core."
            ],
            [
                "id" => 11,
                "nom_exercici" => "Jab Cruzado V-sit con Mancuerna",
                "dificultat" => "intermedio",
                "idCategoria" => 3,
                "imatge" => "imatge_jab_cruzado_mancuerna.jpg",
                "descripció" => "Sentado, realiza jab cruzado con mancuerna en posición V-Sit."
            ],
            [
                "id" => 12,
                "nom_exercici" => "Giro de Cable de Pie",
                "dificultat" => "intermedio",
                "idCategoria" => 3,
                "imatge" => "imatge_giro_cable.jpg",
                "descripció" => "De pie, gira el cable de abajo hacia arriba."
            ],
            [
                "id" => 13,
                "nom_exercici" => "Press de Banca con Mancuernas",
                "dificultat" => "intermedio",
                "idCategoria" => 3,
                "imatge" => "imatge_press_banca_mancuernas.jpg",
                "descripció" => "Acostado, levanta mancuerna con brazos extendidos."
            ],
            [
                "id" => 14,
                "nom_exercici" => "Crunch Inverso en Banco Declinado",
                "dificultat" => "intermedio",
                "idCategoria" => 2,
                "imatge" => "imatge_crunch_inverso_banco_declinado.jpg",
                "descripció" => "Haz crunch inverso en banco declinado para abdominales inferiores."
            ],
            [
                "id" => 15,
                "nom_exercici" => "Círculos de Cadera de Pie",
                "dificultat" => "intermedio",
                "idCategoria" => 4,
                "imatge" => "imatge_circulos_cadera.jpg",
                "descripció" => "De pie, haz círculos con la cadera para abductores."
            ],
            [
                "id" => 16,
                "nom_exercici" => "Movimientos Circulares de Piernas",
                "dificultat" => "intermedio",
                "idCategoria" => 4,
                "imatge" => "imatge_movimientos_circulares_piernas.jpg",
                "descripció" => "De pie, realiza movimientos circulares con las piernas."
            ],
            [
                "id" => 17,
                "nom_exercici" => "Estiramiento de Abductores",
                "dificultat" => "intermedio",
                "idCategoria" => 4,
                "imatge" => "imatge_estiramiento_abductores.jpg",
                "descripció" => "Acostado, cruza una pierna para estirar los abductores."
            ],
            [
                "id" => 19,
                "nom_exercici" => "Flexiones en Plancha",
                "dificultat" => "intermedio",
                "idCategoria" => 5,
                "imatge" => "imatge_flexiones_plancha.jpg",
                "descripció" => "Flexiones desde posición de plancha para pectorales."
            ],
            [
                "id" => 20,
                "nom_exercici" => "Press de Banca Inclinado con Mancuernas",
                "dificultat" => "intermedio",
                "idCategoria" => 5,
                "imatge" => "imatge_press_banca_inclinado_mancuernas.jpg",
                "descripció" => "Press de banca inclinado con mancuernas para pectorales superiores."
            ],
            [
                "id" => 21,
                "nom_exercici" => "Cross-Over con Cables Bajos",
                "dificultat" => "intermedio",
                "idCategoria" => 5,
                "imatge" => "imatge_cross_over_cables_bajos.jpg",
                "descripció" => "Cross-over con cables bajos para aislar pectorales."
            ],
            [
                "id" => 22,
                "nom_exercici" => "Press de Banca con Barra",
                "dificultat" => "intermedio",
                "idCategoria" => 5,
                "imatge" => "imatge_press_banca_barra.jpg",
                "descripció" => "Acostado, press de banca con barra para pectorales."
            ],
            [
                "id" => 23,
                "nom_exercici" => "Dips Enfocados en Pecho",
                "dificultat" => "intermedio",
                "idCategoria" => 5,
                "imatge" => "imatge_dips_enfocados_pecho.jpg",
                "descripció" => "Dips enfocados en pecho para pectorales y tríceps."
            ],
            [
                "id" => 24,
                "nom_exercici" => "Aperturas con Mancuernas Declinadas",
                "dificultat" => "intermedio",
                "idCategoria" => 5,
                "imatge" => "imatge_aperturas_mancuernas_declinadas.jpg",
                "descripció" => "Aperturas con mancuernas declinadas para pectorales inferiores."
            ],
            [
                "id" => 25,
                "nom_exercici" => "Aperturas con Mancuernas",
                "dificultat" => "intermedio",
                "idCategoria" => 5,
                "imatge" => "imatge_aperturas_mancuernas.jpg",
                "descripció" => "Aperturas con mancuernas para pectorales."
            ],
            [
                "id" => 26,
                "nom_exercici" => "Empuje de Cadera",
                "dificultat" => "intermedio",
                "idCategoria" => 6,
                "imatge" => "imatge_empuje_cadera.jpg",
                "descripció" => "Empuje de cadera desde posición sentada para fortalecer glúteos."
            ],
            [
                "id" => 27,
                "nom_exercici" => "Extensiones de Cadera con Cable en una Pierna",
                "dificultat" => "intermedio",
                "idCategoria" => 6,
                "imatge" => "imatge_extensiones_cadera_cable_pierna.jpg",
                "descripció" => "Extensiones de cadera con cable en una pierna para glúteos."
            ],
            [
                "id" => 28,
                "nom_exercici" => "Puente de Glúteos",
                "dificultat" => "intermedio",
                "idCategoria" => 6,
                "imatge" => "imatge_puente_gluteos.jpg",
                "descripció" => "Puente de glúteos desde posición acostada para fortalecerlos."
            ],
            [
                "id" => 29,
                "nom_exercici" => "Puente de Glúteos en una Pierna",
                "dificultat" => "intermedio",
                "idCategoria" => 6,
                "imatge" => "imatge_puente_gluteos_pierna.jpg",
                "descripció" => "Puente de glúteos en una pierna para estabilidad."
            ],
            [
                "id" => 30,
                "nom_exercici" => "Elevación de Rodilla al Pecho",
                "dificultat" => "intermedio",
                "idCategoria" => 6,
                "imatge" => "imatge_elevacion_rodilla_pecho.jpg",
                "descripció" => "Eleva la rodilla al pecho mientras das un paso."
            ],
            [
                "id" => 31,
                "nom_exercici" => "Sentadilla desde Posición Arrodillada",
                "dificultat" => "intermedio",
                "idCategoria" => 6,
                "imatge" => "imatge_sentadilla_posicion_arrodillada.jpg",
                "descripció" => "Sentadilla desde posición arrodillada para glúteos."
            ],
            [
                "id" => 32,
                "nom_exercici" => "Patadas Laterales desde Posición Cuadrúpeda",
                "dificultat" => "intermedio",
                "idCategoria" => 6,
                "imatge" => "imatge_patadas_laterales_cuadrupeda.jpg",
                "descripció" => "Patadas hacia los lados desde posición cuadrúpeda para glúteos."
            ],
            [
                "id" => 33,
                "nom_exercici" => "Patada hacia Atrás desde Posición de Pie",
                "dificultat" => "intermedio",
                "idCategoria" => 6,
                "imatge" => "imatge_patada_atras_posicion_pie.jpg",
                "descripció" => "Patada hacia atrás desde posición de pie para glúteos."
            ],
            [
                "id" => 34,
                "nom_exercici" => "Levantamiento de Barra desde el Suelo",
                "dificultat" => "intermedio",
                "idCategoria" => 7,
                "imatge" => "imatge_levantamiento_barra_suelo.jpg",
                "descripció" => "Levanta la barra desde el suelo para fortalecer isquiotibiales."
            ],
            [
                "id" => 35,
                "nom_exercici" => "Peso Muerto con Mancuernas desde Posición Inclinada",
                "dificultat" => "intermedio",
                "idCategoria" => 7,
                "imatge" => "imatge_peso_muerto_mancuernas_inclinada.jpg",
                "descripció" => "Peso muerto con mancuernas desde posición inclinada para isquiotibiales."
            ],
            [
                "id" => 36,
                "nom_exercici" => "Levantamiento de Barra hasta los Hombros",
                "dificultat" => "intermedio",
                "idCategoria" => 7,
                "imatge" => "imatge_levantamiento_barra_hombros.jpg",
                "descripció" => "Levanta la barra hasta los hombros en un solo movimiento."
            ],
            [
                "id" => 37,
                "nom_exercici" => "Peso Muerto con Pies Separados",
                "dificultat" => "intermedio",
                "idCategoria" => 7,
                "imatge" => "imatge_peso_muerto_pies_separados.jpg",
                "descripció"=> "Levanta la barra hasta los hombros en un solo movimiento."
            ],
            [
                "id" => 38,
                "nom_exercici" => "Peso Muerto Sumo",
                "dificultat" => "principiante",
                "idCategoria" => 6,
                "imatge" => "peso_muerto_sumo.jpg",
                "descripció" => "Peso muerto con pies separados para trabajar isquiotibiales."
            ],
            [
                "id" => 39,
                "nom_exercici" => "Peso Muerto Rumano desde un Deficit",
                "dificultat" => "principiante",
                "idCategoria" => 6,
                "imatge" => "peso_muerto_rumano_deficit.jpg",
                "descripció" => "Peso muerto rumano desde posición más baja."
            ],
            [
                "id" => 41,
                "nom_exercici" => "Elevación de Glúteos e Isquiotibiales",
                "dificultat" => "principiante",
                "idCategoria" => 6,
                "imatge" => "elevacion_gluteos_isquiotibiales.jpg",
                "descripció" => "Levanta las caderas tumbado para fortalecer glúteos e isquiotibiales."
            ],
            [
                "id" => 42,
                "nom_exercici" => "Peso Muerto de Arrancada",
                "dificultat" => "principiante",
                "idCategoria" => 6,
                "imatge" => "peso_muerto_arrancada.jpg",
                "descripció" => "Levanta la barra hasta los hombros en un movimiento explosivo."
            ],[
                "id" => 43,
                "nom_exercici" => "Jalon Abierto Poleas Altas",
                "dificultat" => "principiante",
                "idCategoria" => 7,
                "imatge" => "imatge_jalon_abierto_poleas_altas.jpg",
                "descripció" => "Ajusta el peso y sujeta las empuñaduras. Lleva las manos hacia abajo y los lados."
            ],
            [
                "id" => 44,
                "nom_exercici" => "Jalon de Agarre Cerrado",
                "dificultat" => "intermedio",
                "idCategoria" => 7,
                "imatge" => "imatge_jalon_agarre_cerrado.jpg",
                "descripció" => "Con agarre cerrado, tira hacia abajo manteniendo los codos cerca."
            ],
            [
                "id" => 45,
                "nom_exercici" => "Dominadas",
                "dificultat" => "principiante",
                "idCategoria" => 7,
                "imatge" => "imatge_dominadas.jpg",
                "descripció" => "Agarra la barra con manos al ancho de los hombros."
            ],
            [
                "id" => 46,
                "nom_exercici" => "Remo con Barra",
                "dificultat" => "intermedio",
                "idCategoria" => 7,
                "imatge" => "imatge_remo_barra_shotgun_row.jpg",
                "descripció" => "Inclínate hacia adelante con agarre amplio y lleva la barra al abdomen."
            ],
            [
                "id" => 47,
                "nom_exercici" => "Jalon de Agarre Cerrado Frontal",
                "dificultat" => "intermedio",
                "idCategoria" => 7,
                "imatge" => "imatge_jalon_agarre_cerrado_frontal.jpg",
                "descripció" => "Con agarre cerrado frontal, lleva la barra hacia abajo al frente."
            ],
            [
                "id" => 48,
                "nom_exercici" => "Dominadas con Barra en V",
                "dificultat" => "intermedio",
                "idCategoria" => 7,
                "imatge" => "imatge_dominadas_barra_en_v.jpg",
                "descripció" => "Agarra la barra en forma de V y realiza el movimiento."
            ],
            [
                "id" => 49,
                "nom_exercici" => "Peso Muerto con Eje",
                "dificultat" => "principiante",
                "idCategoria" => 8,
                "imatge" => "imatge_peso_muerto_eje.jpg",
                "descripció" => "Levanta la barra hasta la cadera para fortalecer la parte baja de la espalda."
            ],
            [
                "id" => 50,
                "nom_exercici" => "Hiperextensiones sin Banco",
                "dificultat" => "principiante",
                "idCategoria" => 8,
                "imatge" => "imatge_hiperextensiones_sin_banco.jpg",
                "descripció" => "Haz una extensión hacia atrás sin banco para fortalecer la parte baja de la espalda."
            ],
            [
                "id" => 51,
                "nom_exercici" => "Peso Muerto con Bandas",
                "dificultat" => "principiante",
                "idCategoria" => 8,
                "imatge" => "imatge_peso_muerto_bandas.jpg",
                "descripció" => "Levanta la barra con bandas de resistencia para fortalecer la parte baja de la espalda."
            ],
            [
                "id" => 52,
                "nom_exercici" => "Peso Muerto con Mancuernas",
                "dificultat" => "principiante",
                "idCategoria" => 8,
                "imatge" => "imatge_peso_muerto_mancuernas.jpg",
                "descripció" => "Levanta las mancuernas hasta la cadera para fortalecer la parte baja de la espalda."
            ], [
                "id" => 53,
                "nom_exercici" => "Superman",
                "dificultat" => "intermedio",
                "idCategoria" => 8,
                "imatge" => "imatge_superman.jpg",
                "descripció" => "Acuéstate boca abajo. Levanta brazos, pecho y piernas para fortalecer la parte baja de la espalda."
            ],
            [
                "id" => 54,
                "nom_exercici" => "Remo T-Bar con Asa",
                "dificultat" => "intermedia",
                "idCategoria" => 9,
                "imatge" => "imatge_remo_tbar_con_asa.jpg",
                "descripció" => "Agarra el asa y tira hacia el abdomen manteniendo la espalda recta."
            ],
            [
                "id" => 55,
                "nom_exercici" => "Remo con Barra Inclinada de Agarre Revertido",
                "dificultat" => "intermedia",
                "idCategoria" => 9,
                "imatge" => "imatge_remo_barra_inclinada_agarre_revertido.jpg",
                "descripció" => "Inclínate hacia adelante y tira la barra hacia el abdomen."
            ],
            [
                "id" => 56,
                "nom_exercici" => "Remo con Mancuerna de un Brazo",
                "dificultat" => "intermedia",
                "idCategoria" => 9,
                "imatge" => "imatge_remo_mancuerna_un_brazo.jpg",
                "descripció" => "Tira de la mancuerna hacia el abdomen manteniendo la espalda recta."
            ],
            [
                "id" => 57,
                "nom_exercici" => "Remo con Barra de un Brazo",
                "dificultat" => "intermedia",
                "idCategoria" => 9,
                "imatge" => "imatge_remo_barra_un_brazo.jpg",
                "descripció" => "Tira de la barra hacia el abdomen manteniendo la espalda recta."
            ],
            [
                "id" => 58,
                "nom_exercici" => "Remo T-Bar",
                "dificultat" => "intermedia",
                "idCategoria" => 9,
                "imatge" => "imatge_remo_tbar.jpg",
                "descripció" => "Agarra el asa y tira la barra hacia el abdomen."
            ],
            [
                "id" => 59,
                "nom_exercici" => "Remo con Barra de Dos Brazos Inclinado",
                "dificultat" => "intermedia",
                "idCategoria" => 9,
                "imatge" => "imatge_remo_barra_dos_brazos_inclinado.jpg",
                "descripció" => "Inclínate hacia adelante y tira la barra hacia el abdomen."
            ],
            [
                "id" => 60,
                "nom_exercici" => "Remo de Máquina",
                "dificultat" => "intermedia",
                "idCategoria" => 9,
                "imatge" => "imatge_remo_maquina.jpg",
                "descripció" => "Tira de las empuñaduras hacia el torso manteniendo la espalda recta."
            ],
            [
                "id" => 61,
                "nom_exercici" => "Remo Sentado con Polea",
                "dificultat" => "intermedia",
                "idCategoria" => 9,
                "imatge" => "imatge_remo_sentado_polea.jpg",
                "descripció" => "Tira de la barra hacia el abdomen manteniendo la espalda recta."
            ],
            [
                "id" => 62,
                "nom_exercici" => "Remo Inclinado con Mancuernas",
                "dificultat" => "intermedia",
                "idCategoria" => 9,
                "imatge" => "imatge_remo_inclinado_mancuernas.jpg",
                "descripció" => "Lleva los codos hacia arriba y hacia atrás con las mancuernas."
            ], [
                "id" => 63,
                "nom_exercici" => "Fondos en Paralelas",
                "dificultat" => "intermedia",
                "idCategoria" => 10,
                "imatge" => "imatge_fondos_paralelas.jpg",
                "descripció" => "Flexiona los codos para bajar y luego extiéndelos para subir en fondos paralelas."
            ],
            [
                "id" => 64,
                "nom_exercici" => "Fondos en Máquina Asistida",
                "dificultat" => "principiante",
                "idCategoria" => 10,
                "imatge" => "imatge_fondos_maquina_asistida.jpg",
                "descripció" => "Ajusta el peso de la máquina y flexiona los codos para bajar y extiéndelos para subir."
            ],
            [
                "id" => 65,
                "nom_exercici" => "Fondos en Banco con Peso",
                "dificultat" => "intermedia",
                "idCategoria" => 10,
                "imatge" => "imatge_fondos_banco_peso.jpg",
                "descripció" => "Coloca peso adicional sobre tu cuerpo y flexiona los codos para bajar y extiéndelos para subir en fondos."
            ],
            [
                "id" => 66,
                "nom_exercici" => "Press Francés con Mancuerna",
                "dificultat" => "intermedia",
                "idCategoria" => 10,
                "imatge" => "imatge_press_frances_mancuerna.jpg",
                "descripció" => "Flexiona los codos con las mancuernas hacia la cabeza y luego extiéndelos."
            ],
            [
                "id" => 67,
                "nom_exercici" => "Press Francés con Barra EZ",
                "dificultat" => "intermedia",
                "idCategoria" => 10,
                "imatge" => "imatge_press_frances_barra_ez.jpg",
                "descripció" => "Flexiona los codos con la barra hacia la cabeza y luego extiéndelos."
            ],
            [
                "id" => 68,
                "nom_exercici" => "Extensiones de Tríceps en Polea Alta",
                "dificultat" => "intermedia",
                "idCategoria" => 10,
                "imatge" => "imatge_extensiones_triceps_polea_alta.jpg",
                "descripció" => "Estira los codos hacia abajo con la polea alta y luego flexiónalos para volver."
            ],
            [
                "id" => 69,
                "nom_exercici" => "Fondos en Anillas",
                "dificultat" => "intermedia",
                "idCategoria" => 10,
                "imatge" => "imatge_fondos_anillas.jpg",
                "descripció" => "Flexiona los codos para bajar y luego extiéndelos para subir en fondos en anillas."
            ],
            [
                "id" => 70,
                "nom_exercici" => "Press Francés con Barra Recta",
                "dificultat" => "intermedia",
                "idCategoria" => 10,
                "imatge" => "imatge_press_frances_barra_recta.jpg",
                "descripció" => "Flexiona los codos con la barra hacia la cabeza y luego extiéndelos."
            ],
            [
                "id" => 71,
                "nom_exercici" => "Extensiones de Tríceps en Máquina",
                "dificultat" => "intermedia",
                "idCategoria" => 10,
                "imatge" => "imatge_extensiones_triceps_maquina.jpg",
                "descripció" => "Estira los codos hacia abajo en la máquina y luego flexiónalos para volver."
            ],
            [
                "id" => 72,
                "nom_exercici" => "Press Francés con Máquina",
                "dificultat" => "intermedia",
                "idCategoria" => 10,
                "imatge" => "imatge_press_frances_maquina.jpg",
                "descripció" => "Flexiona los codos con la máquina hacia la cabeza y luego extiéndelos."
            ],
            [
                "id" => 73,
                "nom_exercici" => "Dips de tríceps",
                "dificultat" => "intermedia",
                "idCategoria" => 12,
                "imatge" => "imatge_dips_triceps.jpg",
                "descripció" => "Flexiona los brazos bajando el cuerpo y luego extiéndelos."
            ],
            [
                "id" => 74,
                "nom_exercici" => "Press Frances",
                "dificultat" => "intermedia",
                "idCategoria" => 12,
                "imatge" => "imatge_press_frances.jpg",
                "descripció" => "Flexiona los brazos bajando la barra detrás de la cabeza."
            ],
            [
                "id" => 75,
                "nom_exercici" => "Press Frances con mancuernas",
                "dificultat" => "intermedia",
                "idCategoria" => 12,
                "imatge" => "imatge_press_frances_mancuernas.jpg",
                "descripció" => "Flexiona los brazos bajando las mancuernas detrás de la cabeza."
            ],
            [
                "id" => 76,
                "nom_exercici" => "Empuje hacia abajo con Barra-V polea",
                "dificultat" => "intermedia",
                "idCategoria" => 12,
                "imatge" => "imatge_empuje_abajo_barra_v_polea.jpg",
                "descripció" => "Estira los brazos hacia abajo utilizando una barra en forma de V."
            ],
            [
                "id" => 77,
                "nom_exercici" => "Press Frances con barra Z",
                "dificultat" => "intermedia",
                "idCategoria" => 12,
                "imatge" => "imatge_press_frances_barra_z.jpg",
                "descripció" => "Flexiona los brazos bajando la barra detrás de la cabeza con barra Z."
            ],
            [
                "id" => 78,
                "nom_exercici" => "Empuje hacia abajo de tríceps con agarre invertido",
                "dificultat" => "intermedia",
                "idCategoria" => 12,
                "imatge" => "imatge_empuje_abajo_triceps_agarre_invertido.jpg",
                "descripció" => "Estira los brazos hacia abajo con agarre invertido."
            ],
            [
                "id" => 79,
                "nom_exercici" => "Flexiones de tríceps - Posición de manos cerrada",
                "dificultat" => "intermedia",
                "idCategoria" => 12,
                "imatge" => "imatge_flexiones_triceps_posicion_mano_cerrada.jpg",
                "descripció" => "Realiza flexiones con las manos cerca del cuerpo para trabajar los tríceps."
            ],
            [
                "id" => 80,
                "nom_exercici" => "Extensión de tríceps con cable de un solo brazo",
                "dificultat" => "intermedia",
                "idCategoria" => 12,
                "imatge" => "imatge_extension_triceps_cable_un_brazo.jpg",
                "descripció" => "Estira el brazo hacia abajo con el cable para trabajar los tríceps."
            ],
            [
                "id" => 81,
                "nom_exercici" => "Extensión de tríceps con mancuerna",
                "dificultat" => "principiante",
                "idCategoria" => 12,
                "imatge" => "imatge_extension_triceps_mancuerna.jpg",
                "descripció" => "Flexiona y extiende el brazo con la mancuerna para trabajar los tríceps."
            ]
            
            
            
        ];

        // Insertar los datos en la base de datos
        DB::table('ejercicios')->insert($data);
    }
}