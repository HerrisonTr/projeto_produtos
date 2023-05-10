<?php

if (!isset($_POST['nome']) || !isset($_POST['marca']) || !isset($_POST['tamanho'])) {
    die("ERROR");
    return;
}

include "../config/config.php";
include "../config/conn.php";

$nome = mysqli_real_escape_string($con, trim($_POST['nome']));
$marca = mysqli_real_escape_string($con, trim($_POST['marca']));
$tamanho = mysqli_real_escape_string($con, trim($_POST['tamanho']));

if (empty(trim($nome)) || empty(trim($marca)) || empty(trim($tamanho))) {
    $msg = "Preencha todos os campos corretamente";
    $alert = "danger";
    $status = false;
} else {

    //Verifica se o produto já foi cadastrado anteriormente
    $sqlConfere = "select 1 from produto where nome = '$nome' and marca = '$marca'";
    $resultConfere = mysqli_query($con, $sqlConfere);
    if (!mysqli_num_rows($resultConfere)) {

        $sql = "insert into produto (nome, marca, tamanho) values ('$nome', '$marca', '$tamanho')";
        if (mysqli_query($con, $sql)) {
            $msg = "Produto <b> $nome </b> cadastrado corretamente";
            $alert = "success";
            $status = true;
        } else {
            $msg = "Falha ao cadastrar o produto <b> $nome </b>";
            $alert = "danger";
            $status = false;
        }
    } else {
        $msg = "O produto <b> $nome </b> da marca <b> $marca </b> já foi cadastrado anteriormente";
        $alert = "warning";
        $status = false;
    }
}

mysqli_close($con);
$response = ["mensagem" => $msg, "alert" => $alert, "status" => $status];
echo json_encode($response);
