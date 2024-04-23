<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EjerciciosTableSeeder extends Seeder
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
                "nombre" => "Curl de Martillo Inclinado",
                "dificultad" => "principiante",
                "idCategoria" => 1,
                "imagen" => "imagen_curl_martillo_inclinado.jpg",
                "descripcion" => "Flexiona los codos levantando las mancuernas hacia los hombros."
            ],
            [
                "id" => 2,
                "nombre" => "Curl de Barra de Agarre Ancho",
                "dificultad" => "principiante",
                "idCategoria" => 1,
                "imagen" => "imagen_curl_barra_agarre_ancho.jpg",
                "descripcion" => "Flexiona los codos levantando la barra ancha hacia los hombros."
            ],
            [
                "id" => 3,
                "nombre" => "Curl de Martillo",
                "dificultad" => "intermedio",
                "idCategoria" => 1,
                "imagen" => "imagen_curl_martillo.jpg",
                "descripcion" => "Levanta las mancuernas hacia los hombros manteniendo las palmas hacia dentro."
            ],
            [
                "id" => 4,
                "nombre" => "Curl de Barra Z",
                "dificultad" => "intermedio",
                "idCategoria" => 1,
                "imagen" => "imagen_curl_barra_ez.jpg",
                "descripcion" => "Flexiona los codos levantando la barra Z hacia los hombros."
            ],
            [
                "id" => 5,
                "nombre" => "Curl de Barra",
                "dificultad" => "intermedio",
                "idCategoria" => 1,
                "imagen" => "imagen_curl_barra.jpg",
                "descripcion" => "Flexiona los codos levantando la barra recta hacia los hombros."
            ],
            [
                "id" => 6,
                "nombre" => "Curl Concentrado",
                "dificultad" => "intermedio",
                "idCategoria" => 1,
                "imagen" => "imagen_curl_concentrado.jpg",
                "descripcion" => "Realiza curls concentrados para aislar y fortalecer los bíceps."
            ],
            [
                "id" => 7,
                "nombre" => "Curl de Martillo Inclinado Flexor",
                "dificultad" => "principiante",
                "idCategoria" => 1,
                "imagen" => "imagen_curl_martillo_inclinado_flexor.jpg",
                "descripcion" => "Flexiona los codos levantando las mancuernas hacia los hombros con agarre neutro."
            ],
            [
                "id" => 8,
                "nombre" => "Giro de barra",
                "dificultad" => "intermedio",
                "idCategoria" => 2,
                "imagen" => "imagen_giro_barra.jpg",
                "descripcion" => "Haz giros con la barra para fortalecer los abdominales."
            ],
            [
                "id" => 9,
                "nombre" => "Plancha de codos",
                "dificultad" => "intermedio",
                "idCategoria" => 2,
                "imagen" => "imagen_plancha_codos.jpg",
                "descripcion" => "Mantén la posición de plancha con codos apoyados."
            ],
            [
                "id" => 10,
                "nombre" => "Abdominales suspendidos",
                "dificultad" => "intermedia",
                "idCategoria" => 2,
                "imagen" => "imagen_abdominales_suspendidos.jpg",
                "descripcion" => "Levanta piernas con el torso suspendido para fortalecer el core."
            ],
            [
                "id" => 11,
                "nombre" => "Jab Cruzado V-sit con Mancuerna",
                "dificultad" => "intermedio",
                "idCategoria" => 3,
                "imagen" => "imagen_jab_cruzado_mancuerna.jpg",
                "descripcion" => "Sentado, realiza jab cruzado con mancuerna en posición V-Sit."
            ],
            [
                "id" => 12,
                "nombre" => "Giro de Cable de Pie",
                "dificultad" => "intermedio",
                "idCategoria" => 3,
                "imagen" => "imagen_giro_cable.jpg",
                "descripcion" => "De pie, gira el cable de abajo hacia arriba."
            ],
            [
                "id" => 13,
                "nombre" => "Press de Banca con Mancuernas",
                "dificultad" => "intermedio",
                "idCategoria" => 3,
                "imagen" => "imagen_press_banca_mancuernas.jpg",
                "descripcion" => "Acostado, levanta mancuerna con brazos extendidos."
            ],
            [
                "id" => 14,
                "nombre" => "Crunch Inverso en Banco Declinado",
                "dificultad" => "intermedio",
                "idCategoria" => 2,
                "imagen" => "imagen_crunch_inverso_banco_declinado.jpg",
                "descripcion" => "Haz crunch inverso en banco declinado para abdominales inferiores."
            ],
            [
                "id" => 15,
                "nombre" => "Círculos de Cadera de Pie",
                "dificultad" => "intermedio",
                "idCategoria" => 4,
                "imagen" => "imagen_circulos_cadera.jpg",
                "descripcion" => "De pie, haz círculos con la cadera para abductores."
            ],
            [
                "id" => 16,
                "nombre" => "Movimientos Circulares de Piernas",
                "dificultad" => "intermedio",
                "idCategoria" => 4,
                "imagen" => "imagen_movimientos_circulares_piernas.jpg",
                "descripcion" => "De pie, realiza movimientos circulares con las piernas."
            ],
            [
                "id" => 17,
                "nombre" => "Estiramiento de Abductores",
                "dificultad" => "intermedio",
                "idCategoria" => 4,
                "imagen" => "imagen_estiramiento_abductores.jpg",
                "descripcion" => "Acostado, cruza una pierna para estirar los abductores."
            ],
            [
                "id" => 18,
                "nombre" => "Press de Banca con Mancuernas",
                "dificultad" => "intermedio",
                "idCategoria" => 5,
                "imagen" => "imagen_press_banca_mancuernas.jpg",
                "descripcion" => "Acostado, press de banca con mancuernas para pectorales."
            ],
            [
                "id" => 19,
                "nombre" => "Flexiones en Plancha",
                "dificultad" => "intermedio",
                "idCategoria" => 5,
                "imagen" => "imagen_flexiones_plancha.jpg",
                "descripcion" => "Flexiones desde posición de plancha para pectorales."
            ],
            [
                "id" => 20,
                "nombre" => "Press de Banca Inclinado con Mancuernas",
                "dificultad" => "intermedio",
                "idCategoria" => 5,
                "imagen" => "imagen_press_banca_inclinado_mancuernas.jpg",
                "descripcion" => "Press de banca inclinado con mancuernas para pectorales superiores."
            ],
            [
                "id" => 21,
                "nombre" => "Cross-Over con Cables Bajos",
                "dificultad" => "intermedio",
                "idCategoria" => 5,
                "imagen" => "imagen_cross_over_cables_bajos.jpg",
                "descripcion" => "Cross-over con cables bajos para aislar pectorales."
            ],
            [
                "id" => 22,
                "nombre" => "Press de Banca con Barra",
                "dificultad" => "intermedio",
                "idCategoria" => 5,
                "imagen" => "imagen_press_banca_barra.jpg",
                "descripcion" => "Acostado, press de banca con barra para pectorales."
            ],
            [
                "id" => 23,
                "nombre" => "Dips Enfocados en Pecho",
                "dificultad" => "intermedio",
                "idCategoria" => 5,
                "imagen" => "imagen_dips_enfocados_pecho.jpg",
                "descripcion" => "Dips enfocados en pecho para pectorales y tríceps."
            ],
            [
                "id" => 24,
                "nombre" => "Aperturas con Mancuernas Declinadas",
                "dificultad" => "intermedio",
                "idCategoria" => 5,
                "imagen" => "imagen_aperturas_mancuernas_declinadas.jpg",
                "descripcion" => "Aperturas con mancuernas declinadas para pectorales inferiores."
            ],
            [
                "id" => 25,
                "nombre" => "Aperturas con Mancuernas",
                "dificultad" => "intermedio",
                "idCategoria" => 5,
                "imagen" => "imagen_aperturas_mancuernas.jpg",
                "descripcion" => "Aperturas con mancuernas para pectorales."
            ],
            [
                "id" => 26,
                "nombre" => "Empuje de Cadera",
                "dificultad" => "intermedio",
                "idCategoria" => 6,
                "imagen" => "imagen_empuje_cadera.jpg",
                "descripcion" => "Empuje de cadera desde posición sentada para fortalecer glúteos."
            ],
            [
                "id" => 27,
                "nombre" => "Extensiones de Cadera con Cable en una Pierna",
                "dificultad" => "intermedio",
                "idCategoria" => 6,
                "imagen" => "imagen_extensiones_cadera_cable_pierna.jpg",
                "descripcion" => "Extensiones de cadera con cable en una pierna para glúteos."
            ],
            [
                "id" => 28,
                "nombre" => "Puente de Glúteos",
                "dificultad" => "intermedio",
                "idCategoria" => 6,
                "imagen" => "imagen_puente_gluteos.jpg",
                "descripcion" => "Puente de glúteos desde posición acostada para fortalecerlos."
            ],
            [
                "id" => 29,
                "nombre" => "Puente de Glúteos en una Pierna",
                "dificultad" => "intermedio",
                "idCategoria" => 6,
                "imagen" => "imagen_puente_gluteos_pierna.jpg",
                "descripcion" => "Puente de glúteos en una pierna para estabilidad."
            ],
            [
                "id" => 30,
                "nombre" => "Elevación de Rodilla al Pecho",
                "dificultad" => "intermedio",
                "idCategoria" => 6,
                "imagen" => "imagen_elevacion_rodilla_pecho.jpg",
                "descripcion" => "Eleva la rodilla al pecho mientras das un paso."
            ],
            [
                "id" => 31,
                "nombre" => "Sentadilla desde Posición Arrodillada",
                "dificultad" => "intermedio",
                "idCategoria" => 6,
                "imagen" => "imagen_sentadilla_posicion_arrodillada.jpg",
                "descripcion" => "Sentadilla desde posición arrodillada para glúteos."
            ],
            [
                "id" => 32,
                "nombre" => "Patadas Laterales desde Posición Cuadrúpeda",
                "dificultad" => "intermedio",
                "idCategoria" => 6,
                "imagen" => "imagen_patadas_laterales_cuadrupeda.jpg",
                "descripcion" => "Patadas hacia los lados desde posición cuadrúpeda para glúteos."
            ],
            [
                "id" => 33,
                "nombre" => "Patada hacia Atrás desde Posición de Pie",
                "dificultad" => "intermedio",
                "idCategoria" => 6,
                "imagen" => "imagen_patada_atras_posicion_pie.jpg",
                "descripcion" => "Patada hacia atrás desde posición de pie para glúteos."
            ],
            [
                "id" => 34,
                "nombre" => "Levantamiento de Barra desde el Suelo",
                "dificultad" => "intermedio",
                "idCategoria" => 7,
                "imagen" => "imagen_levantamiento_barra_suelo.jpg",
                "descripcion" => "Levanta la barra desde el suelo para fortalecer isquiotibiales."
            ],
            [
                "id" => 35,
                "nombre" => "Peso Muerto con Mancuernas desde Posición Inclinada",
                "dificultad" => "intermedio",
                "idCategoria" => 7,
                "imagen" => "imagen_peso_muerto_mancuernas_inclinada.jpg",
                "descripcion" => "Peso muerto con mancuernas desde posición inclinada para isquiotibiales."
            ],
            [
                "id" => 36,
                "nombre" => "Levantamiento de Barra hasta los Hombros",
                "dificultad" => "intermedio",
                "idCategoria" => 7,
                "imagen" => "imagen_levantamiento_barra_hombros.jpg",
                "descripcion" => "Levanta la barra hasta los hombros en un solo movimiento."
            ],
            [
                "id" => 37,
                "nombre" => "Peso Muerto con Pies Separados",
                "dificultad" => "intermedio",
                "idCategoria" => 7,
                "imagen" => "imagen_peso_muerto_pies_separados.jpg",
                "descripcion"=> "Levanta la barra hasta los hombros en un solo movimiento."
            ],
            [
                "id" => 38,
                "nombre" => "Peso Muerto Sumo",
                "dificultad" => "principiante",
                "idCategoria" => 6,
                "imagen" => "peso_muerto_sumo.jpg",
                "descripcion" => "Peso muerto con pies separados para trabajar isquiotibiales."
            ],
            [
                "id" => 39,
                "nombre" => "Peso Muerto Rumano desde un Deficit",
                "dificultad" => "principiante",
                "idCategoria" => 6,
                "imagen" => "peso_muerto_rumano_deficit.jpg",
                "descripcion" => "Peso muerto rumano desde posición más baja."
            ],
            [
                "id" => 40,
                "nombre" => "Peso Muerto con Pies Separados",
                "dificultad" => "intermedio",
                "idCategoria" => 7,
                "imagen" => "imagen_peso_muerto_pies_separados.jpg",
                "descripcion" => "Levanta la barra hasta los hombros en un solo movimiento."
            ], [
                "id" => 41,
                "nombre" => "Elevación de Glúteos e Isquiotibiales",
                "dificultad" => "principiante",
                "idCategoria" => 6,
                "imagen" => "elevacion_gluteos_isquiotibiales.jpg",
                "descripcion" => "Levanta las caderas tumbado para fortalecer glúteos e isquiotibiales."
            ],
            [
                "id" => 42,
                "nombre" => "Peso Muerto de Arrancada",
                "dificultad" => "principiante",
                "idCategoria" => 6,
                "imagen" => "peso_muerto_arrancada.jpg",
                "descripcion" => "Levanta la barra hasta los hombros en un movimiento explosivo."
            ],[
                "id" => 43,
                "nombre" => "Jalon Abierto Poleas Altas",
                "dificultad" => "principiante",
                "idCategoria" => 7,
                "imagen" => "imagen_jalon_abierto_poleas_altas.jpg",
                "descripcion" => "Ajusta el peso y sujeta las empuñaduras. Lleva las manos hacia abajo y los lados."
            ],
            [
                "id" => 44,
                "nombre" => "Jalon de Agarre Cerrado",
                "dificultad" => "intermedio",
                "idCategoria" => 7,
                "imagen" => "imagen_jalon_agarre_cerrado.jpg",
                "descripcion" => "Con agarre cerrado, tira hacia abajo manteniendo los codos cerca."
            ],
            [
                "id" => 45,
                "nombre" => "Dominadas",
                "dificultad" => "principiante",
                "idCategoria" => 7,
                "imagen" => "imagen_dominadas.jpg",
                "descripcion" => "Agarra la barra con manos al ancho de los hombros."
            ],
            [
                "id" => 46,
                "nombre" => "Remo con Barra",
                "dificultad" => "intermedio",
                "idCategoria" => 7,
                "imagen" => "imagen_remo_barra_shotgun_row.jpg",
                "descripcion" => "Inclínate hacia adelante con agarre amplio y lleva la barra al abdomen."
            ],
            [
                "id" => 47,
                "nombre" => "Jalon de Agarre Cerrado Frontal",
                "dificultad" => "intermedio",
                "idCategoria" => 7,
                "imagen" => "imagen_jalon_agarre_cerrado_frontal.jpg",
                "descripcion" => "Con agarre cerrado frontal, lleva la barra hacia abajo al frente."
            ],
            [
                "id" => 48,
                "nombre" => "Dominadas con Barra en V",
                "dificultad" => "intermedio",
                "idCategoria" => 7,
                "imagen" => "imagen_dominadas_barra_en_v.jpg",
                "descripcion" => "Agarra la barra en forma de V y realiza el movimiento."
            ],
            [
                "id" => 49,
                "nombre" => "Peso Muerto con Eje",
                "dificultad" => "principiante",
                "idCategoria" => 8,
                "imagen" => "imagen_peso_muerto_eje.jpg",
                "descripcion" => "Levanta la barra hasta la cadera para fortalecer la parte baja de la espalda."
            ],
            [
                "id" => 50,
                "nombre" => "Hiperextensiones sin Banco",
                "dificultad" => "principiante",
                "idCategoria" => 8,
                "imagen" => "imagen_hiperextensiones_sin_banco.jpg",
                "descripcion" => "Haz una extensión hacia atrás sin banco para fortalecer la parte baja de la espalda."
            ],
            [
                "id" => 51,
                "nombre" => "Peso Muerto con Bandas",
                "dificultad" => "principiante",
                "idCategoria" => 8,
                "imagen" => "imagen_peso_muerto_bandas.jpg",
                "descripcion" => "Levanta la barra con bandas de resistencia para fortalecer la parte baja de la espalda."
            ],
            [
                "id" => 52,
                "nombre" => "Peso Muerto con Mancuernas",
                "dificultad" => "principiante",
                "idCategoria" => 8,
                "imagen" => "imagen_peso_muerto_mancuernas.jpg",
                "descripcion" => "Levanta las mancuernas hasta la cadera para fortalecer la parte baja de la espalda."
            ], [
                "id" => 53,
                "nombre" => "Superman",
                "dificultad" => "intermedio",
                "idCategoria" => 8,
                "imagen" => "imagen_superman.jpg",
                "descripcion" => "Acuéstate boca abajo. Levanta brazos, pecho y piernas para fortalecer la parte baja de la espalda."
            ],
            [
                "id" => 54,
                "nombre" => "Remo T-Bar con Asa",
                "dificultad" => "intermedia",
                "idCategoria" => 9,
                "imagen" => "imagen_remo_tbar_con_asa.jpg",
                "descripcion" => "Agarra el asa y tira hacia el abdomen manteniendo la espalda recta."
            ],
            [
                "id" => 55,
                "nombre" => "Remo con Barra Inclinada de Agarre Revertido",
                "dificultad" => "intermedia",
                "idCategoria" => 9,
                "imagen" => "imagen_remo_barra_inclinada_agarre_revertido.jpg",
                "descripcion" => "Inclínate hacia adelante y tira la barra hacia el abdomen."
            ],
            [
                "id" => 56,
                "nombre" => "Remo con Mancuerna de un Brazo",
                "dificultad" => "intermedia",
                "idCategoria" => 9,
                "imagen" => "imagen_remo_mancuerna_un_brazo.jpg",
                "descripcion" => "Tira de la mancuerna hacia el abdomen manteniendo la espalda recta."
            ],
            [
                "id" => 57,
                "nombre" => "Remo con Barra de un Brazo",
                "dificultad" => "intermedia",
                "idCategoria" => 9,
                "imagen" => "imagen_remo_barra_un_brazo.jpg",
                "descripcion" => "Tira de la barra hacia el abdomen manteniendo la espalda recta."
            ],
            [
                "id" => 58,
                "nombre" => "Remo T-Bar",
                "dificultad" => "intermedia",
                "idCategoria" => 9,
                "imagen" => "imagen_remo_tbar.jpg",
                "descripcion" => "Agarra el asa y tira la barra hacia el abdomen."
            ],
            [
                "id" => 59,
                "nombre" => "Remo con Barra de Dos Brazos Inclinado",
                "dificultad" => "intermedia",
                "idCategoria" => 9,
                "imagen" => "imagen_remo_barra_dos_brazos_inclinado.jpg",
                "descripcion" => "Inclínate hacia adelante y tira la barra hacia el abdomen."
            ],
            [
                "id" => 60,
                "nombre" => "Remo de Máquina",
                "dificultad" => "intermedia",
                "idCategoria" => 9,
                "imagen" => "imagen_remo_maquina.jpg",
                "descripcion" => "Tira de las empuñaduras hacia el torso manteniendo la espalda recta."
            ],
            [
                "id" => 61,
                "nombre" => "Remo Sentado con Polea",
                "dificultad" => "intermedia",
                "idCategoria" => 9,
                "imagen" => "imagen_remo_sentado_polea.jpg",
                "descripcion" => "Tira de la barra hacia el abdomen manteniendo la espalda recta."
            ],
            [
                "id" => 62,
                "nombre" => "Remo Inclinado con Mancuernas",
                "dificultad" => "intermedia",
                "idCategoria" => 9,
                "imagen" => "imagen_remo_inclinado_mancuernas.jpg",
                "descripcion" => "Lleva los codos hacia arriba y hacia atrás con las mancuernas."
            ], [
                "id" => 63,
                "nombre" => "Fondos en Paralelas",
                "dificultad" => "intermedia",
                "idCategoria" => 10,
                "imagen" => "imagen_fondos_paralelas.jpg",
                "descripcion" => "Flexiona los codos para bajar y luego extiéndelos para subir en fondos paralelas."
            ],
            [
                "id" => 64,
                "nombre" => "Fondos en Máquina Asistida",
                "dificultad" => "principiante",
                "idCategoria" => 10,
                "imagen" => "imagen_fondos_maquina_asistida.jpg",
                "descripcion" => "Ajusta el peso de la máquina y flexiona los codos para bajar y extiéndelos para subir."
            ],
            [
                "id" => 65,
                "nombre" => "Fondos en Banco con Peso",
                "dificultad" => "intermedia",
                "idCategoria" => 10,
                "imagen" => "imagen_fondos_banco_peso.jpg",
                "descripcion" => "Coloca peso adicional sobre tu cuerpo y flexiona los codos para bajar y extiéndelos para subir en fondos."
            ],
            [
                "id" => 66,
                "nombre" => "Press Francés con Mancuerna",
                "dificultad" => "intermedia",
                "idCategoria" => 10,
                "imagen" => "imagen_press_frances_mancuerna.jpg",
                "descripcion" => "Flexiona los codos con las mancuernas hacia la cabeza y luego extiéndelos."
            ],
            [
                "id" => 67,
                "nombre" => "Press Francés con Barra EZ",
                "dificultad" => "intermedia",
                "idCategoria" => 10,
                "imagen" => "imagen_press_frances_barra_ez.jpg",
                "descripcion" => "Flexiona los codos con la barra hacia la cabeza y luego extiéndelos."
            ],
            [
                "id" => 68,
                "nombre" => "Extensiones de Tríceps en Polea Alta",
                "dificultad" => "intermedia",
                "idCategoria" => 10,
                "imagen" => "imagen_extensiones_triceps_polea_alta.jpg",
                "descripcion" => "Estira los codos hacia abajo con la polea alta y luego flexiónalos para volver."
            ],
            [
                "id" => 69,
                "nombre" => "Fondos en Anillas",
                "dificultad" => "intermedia",
                "idCategoria" => 10,
                "imagen" => "imagen_fondos_anillas.jpg",
                "descripcion" => "Flexiona los codos para bajar y luego extiéndelos para subir en fondos en anillas."
            ],
            [
                "id" => 70,
                "nombre" => "Press Francés con Barra Recta",
                "dificultad" => "intermedia",
                "idCategoria" => 10,
                "imagen" => "imagen_press_frances_barra_recta.jpg",
                "descripcion" => "Flexiona los codos con la barra hacia la cabeza y luego extiéndelos."
            ],
            [
                "id" => 71,
                "nombre" => "Extensiones de Tríceps en Máquina",
                "dificultad" => "intermedia",
                "idCategoria" => 10,
                "imagen" => "imagen_extensiones_triceps_maquina.jpg",
                "descripcion" => "Estira los codos hacia abajo en la máquina y luego flexiónalos para volver."
            ],
            [
                "id" => 72,
                "nombre" => "Press Francés con Máquina",
                "dificultad" => "intermedia",
                "idCategoria" => 10,
                "imagen" => "imagen_press_frances_maquina.jpg",
                "descripcion" => "Flexiona los codos con la máquina hacia la cabeza y luego extiéndelos."
            ],
            [
                "id" => 73,
                "nombre" => "Dips de tríceps",
                "dificultad" => "intermedia",
                "idCategoria" => 12,
                "imagen" => "imagen_dips_triceps.jpg",
                "descripcion" => "Flexiona los brazos bajando el cuerpo y luego extiéndelos."
            ],
            [
                "id" => 74,
                "nombre" => "Press Frances",
                "dificultad" => "intermedia",
                "idCategoria" => 12,
                "imagen" => "imagen_press_frances.jpg",
                "descripcion" => "Flexiona los brazos bajando la barra detrás de la cabeza."
            ],
            [
                "id" => 75,
                "nombre" => "Press Frances con mancuernas",
                "dificultad" => "intermedia",
                "idCategoria" => 12,
                "imagen" => "imagen_press_frances_mancuernas.jpg",
                "descripcion" => "Flexiona los brazos bajando las mancuernas detrás de la cabeza."
            ],
            [
                "id" => 76,
                "nombre" => "Empuje hacia abajo con Barra-V polea",
                "dificultad" => "intermedia",
                "idCategoria" => 12,
                "imagen" => "imagen_empuje_abajo_barra_v_polea.jpg",
                "descripcion" => "Estira los brazos hacia abajo utilizando una barra en forma de V."
            ],
            [
                "id" => 77,
                "nombre" => "Press Frances con barra Z",
                "dificultad" => "intermedia",
                "idCategoria" => 12,
                "imagen" => "imagen_press_frances_barra_z.jpg",
                "descripcion" => "Flexiona los brazos bajando la barra detrás de la cabeza con barra Z."
            ],
            [
                "id" => 78,
                "nombre" => "Empuje hacia abajo de tríceps con agarre invertido",
                "dificultad" => "intermedia",
                "idCategoria" => 12,
                "imagen" => "imagen_empuje_abajo_triceps_agarre_invertido.jpg",
                "descripcion" => "Estira los brazos hacia abajo con agarre invertido."
            ],
            [
                "id" => 79,
                "nombre" => "Flexiones de tríceps - Posición de manos cerrada",
                "dificultad" => "intermedia",
                "idCategoria" => 12,
                "imagen" => "imagen_flexiones_triceps_posicion_mano_cerrada.jpg",
                "descripcion" => "Realiza flexiones con las manos cerca del cuerpo para trabajar los tríceps."
            ],
            [
                "id" => 80,
                "nombre" => "Extensión de tríceps con cable de un solo brazo",
                "dificultad" => "intermedia",
                "idCategoria" => 12,
                "imagen" => "imagen_extension_triceps_cable_un_brazo.jpg",
                "descripcion" => "Estira el brazo hacia abajo con el cable para trabajar los tríceps."
            ],
            [
                "id" => 81,
                "nombre" => "Extensión de tríceps con mancuerna",
                "dificultad" => "principiante",
                "idCategoria" => 12,
                "imagen" => "imagen_extension_triceps_mancuerna.jpg",
                "descripcion" => "Flexiona y extiende el brazo con la mancuerna para trabajar los tríceps."
            ]
            
            
            
        ];

        // Insertar los datos en la base de datos
        DB::table('ejercicios')->insert($data);
    }
}