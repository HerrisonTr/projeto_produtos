<?php

if (!isset($_POST['id']) || !isset($_POST['nome']) || !isset($_POST['marca']) || !isset($_POST['tamanho'])) {
    die("ERROR");
    return;
}

include "../config/config.php";
include "../config/conn.php";

$id = (int) $_POST['id'];
$nome = mysqli_real_escape_string($con, trim($_POST['nome']));
$marca = mysqli_real_escape_string($con, trim($_POST['marca']));
$tamanho = mysqli_real_escape_string($con, trim($_POST['tamanho']));

if (empty($id) || empty(trim($nome)) || empty(trim($marca)) || empty(trim($tamanho))) {
    $msg = "Preencha todos os campos corretamente";
    $alert = "danger";
    $status = false;
} else {

    //Verifica se o produto já foi cadastrado anteriormente
    $sqlConfere = "select 1 from produto where nome = '$nome' and marca = '$marca' and id != $id";
    $resultConfere = mysqli_query($con, $sqlConfere);
    if (!mysqli_num_rows($resultConfere)) {

        $sql = "update produto set nome = '$nome', marca = '$marca', tamanho = '$tamanho' where id = $id";
        if (mysqli_query($con, $sql)) {
            $msg = "Produto <b> $nome </b> atualizado com sucesso";
            $alert = "success";
            $status = true;
        } else {
            $msg = "Falha ao atualizar o produto";
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
