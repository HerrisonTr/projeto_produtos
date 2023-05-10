<?php

if (!isset($_POST['estabelecimento']) || !isset($_POST['produto'])) {
    die("ERROR");
    return;
}

include "../config/config.php";
include "../config/conn.php";
include "./functions.php";

$idEstabelecimento = (int) $_POST['estabelecimento'];
$idProduto = (int) $_POST['produto'];
$tempValor = converteDecimal($_POST['valor']); //CONVERTE EM DECIMAL PARA CADASTRAR NO BANCO
$valor = $tempValor > 00.00 ? $tempValor : 00.00;

$sqlConfere = "select 1 from produto_estabelecimento where produto = $idProduto and estabelecimento = $idEstabelecimento";
$resultConfere = mysqli_query($con, $sqlConfere);
if (!mysqli_num_rows($resultConfere)) {

    $sql = "insert into produto_estabelecimento (produto, estabelecimento, valor) 
            values ($idProduto, $idEstabelecimento, $valor)";
    if (mysqli_query($con, $sql)) {
        $msg = "Produto vinculado com sucesso";
        $alert = "success";
        $status = true;
    } else {
        $msg = "Falha ao cadastrar o produto dentro do estabelecimento";
        $alert = "danger";
        $status = false;
    }
} else {
    $msg = "Produto já cadastrado no estabelecimento";
    $alert = "warning";
    $status = false;
}

mysqli_close($con);
$response = ["mensagem" => $msg, "alert" => $alert, "status" => $status];
echo json_encode($response);
