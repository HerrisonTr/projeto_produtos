<?php

if (!isset($_POST['id'])) {
    die("ERROR");
    return;
}

include "../config/config.php";
include "../config/conn.php";
include "./functions.php";

$id = (int) $_POST['id'];

$sql = "delete from produto_estabelecimento where id = $id";
if (mysqli_query($con, $sql)) {
    $msg = "Produto deletado com sucesso";
    $alert = "success";
    $status = true;
} else {
    $msg = "Falha ao deletar o produto";
    $alert = "danger";
    $status = false;
}

mysqli_close($con);
$response = ["mensagem" => $msg, "alert" => $alert, "status" => $status];
echo json_encode($response);
