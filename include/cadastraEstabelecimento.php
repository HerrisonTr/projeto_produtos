<?php

if (!isset($_POST['nome']) || !isset($_POST['total'])) {
    die("ERROR");
    return;
}

include "../config/config.php";
include "../config/conn.php";

$nome = mysqli_real_escape_string($con, trim($_POST['nome']));
$total = (int) $_POST['total'];
$cep = (int) $_POST['cep'];
$estado = mysqli_real_escape_string($con, trim($_POST['estado']));
$cidade = mysqli_real_escape_string($con, trim($_POST['cidade']));
$bairro = mysqli_real_escape_string($con, trim($_POST['bairro']));

if (empty(trim($nome))) {
    $msg = "Preencha todos os campos corretamente";
    $alert = "danger";
    $status = false;
} else {
    //Verifica se o produto já foi cadastrado anteriormente
    $sqlConfere = "select 1 from estabelecimento where nome_fantasia = '$nome'";
    $resultConfere = mysqli_query($con, $sqlConfere);
    if (!mysqli_num_rows($resultConfere)) {

        $sql = "insert into estabelecimento (nome_fantasia, total_lojas, cep, estado, cidade, bairro) 
            values ('$nome', $total, $cep, '$estado', '$cidade', '$bairro')";
        if (mysqli_query($con, $sql)) {
            $msg = "Estabelecimento <b> $nome </b> cadastrado corretamente";
            $alert = "success";
            $status = true;
        } else {
            $msg = "Falha ao cadastrar o estabelecimento <b> $nome </b>";
            $alert = "danger";
            $status = false;
        }
    } else {
        $msg = "O Estabelecimento <b> $nome </b>já foi cadastrado anteriormente";
        $alert = "warning";
        $status = false;
    }
}

mysqli_close($con);
$response = ["mensagem" => $msg, "alert" => $alert, "status" => $status];
echo json_encode($response);
