<?php

defined('BASEPATH') or exit('El acceso a este archivo no está permitido');


function url_amigable($string = NULL) {
    $string = remover_acentos($string);
    return url_title($string, '-', TRUE);
}

function remover_acentos($string = NULL) {
    $buscar = array('À', 'Á', 'Ã', 'Â', 'É', 'Ê', 'Í', 'Ó', 'Õ', 'Ô', 'Ú', 'Ü', 'Ç', 'à', 'á', 'ã', 'â', 'é', 'ê', 'í', 'ó', 'õ', 'ô', 'ú', 'ü', 'ç');
    $reemplazar = array('a', 'a', 'a', 'a', 'e', 'r', 'i', 'o', 'o', 'o', 'u', 'u', 'c', 'a', 'a', 'a', 'a', 'e', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'c');
    return str_replace($buscar, $reemplazar, $string);
}

function formato_fecha_con_hora($string) {

    $dia_sem = date('w', strtotime($string));

    if ($dia_sem == 0) {
        $semana = "Domingo";
    } elseif ($dia_sem == 1) {
        $semana = "Lunes";
    } elseif ($dia_sem == 2) {
        $semana = "Martes";
    } elseif ($dia_sem == 3) {
        $semana = "Miércoles";
    } elseif ($dia_sem == 4) {
        $semana = "Jueves";
    } elseif ($dia_sem == 5) {
        $semana = "Viernes";
    } else {
        $semana = "Sábado";
    }

    $dia = date('d', strtotime($string));

    $mes_num = date('m', strtotime($string));

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));

    return $dia . '/' . $mes_num . '/' . $ano . ' ' . $hora;
}

function formato_fecha_sin_hora($string) {

    $dia_sem = date('w', strtotime($string));

    if ($dia_sem == 0) {
        $semana = "Domingo";
    } elseif ($dia_sem == 1) {
        $semana = "Lunes";
    } elseif ($dia_sem == 2) {
        $semana = "Martes";
    } elseif ($dia_sem == 3) {
        $semana = "Miércoles";
    } elseif ($dia_sem == 4) {
        $semana = "Jueves";
    } elseif ($dia_sem == 5) {
        $semana = "Viernes";
    } else {
        $semana = "Sábado";
    }

    $dia = date('d', strtotime($string));

    $mes_num = date('m', strtotime($string));

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));

    return $dia . '/' . $mes_num . '/' . $ano;
}
