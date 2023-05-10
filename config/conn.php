<?php

try {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'produtos_mercado';

    $con = mysqli_connect($host, $user, $password, $dbname);
    $sql = "SET NAMES 'utf8'";
    mysqli_query($con, $sql);

    $sql = 'SET character_set_connection=utf8';
    mysqli_query($con, $sql);

    $sql = 'SET character_set_client=utf8';
    mysqli_query($con, $sql);

    $sql = 'SET character_set_results=utf8';
    $res = mysqli_query($con, $sql);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
