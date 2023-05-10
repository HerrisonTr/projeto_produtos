<?php

//CONVERTER NÙMEROS PARA VISUALIZAÇÂO DO USUARIO 
function converteReal($valor) { //10000.00
    $sinal = "";
    if ($valor < 0) {
        $valor = $valor * -1;
        $sinal = "-";
    }

    $valor = number_format($valor, 2, '.', '');
    $valor = explode('.', $valor);
    $decimal = $valor[1];
    $valor = $valor[0];
    $valor = array_map("strrev", array_reverse(str_split(strrev($valor), 3)));
    $valor = implode('.', $valor);
    $valor .= ",$decimal";
    /* Confere a primeira string */

    return $sinal . $valor; //10.000,00
}

function converteDecimal($valor) {
    $valor = str_replace(".", "", $valor); //FORMATA O VALOR PARA CADASTRAR NO BANCO
    $valor = str_replace(",", ".", $valor);
    return $valor; //10.000,00
}