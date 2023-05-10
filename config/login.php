<?php

session_start();

if (empty(trim($_POST['login'])) || empty(trim($_POST['senha']))) {
    $_SESSION['mensagem'] = "Preencha todos os campos corretamente";
    $_SESSION['alert'] = "danger";
    session_destroy();
    
    header("Location: ../");
    return;
}

include "conn.php"; //Arquivo de conexão com o BD

$login = mysqli_real_escape_string($con, trim($_POST['login']));
$senha = mysqli_real_escape_string($con, trim($_POST['senha']));

//Verifica se o login existe no banco de dados
$sql = "select nome, senha from usuario where login = '$login'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result)) {
    $row = mysqli_fetch_array($result);

    if (password_verify($senha, $row[1])) { //Verifica se as senhas confem
        $_SESSION['nome'] = $row[0];
        $_SESSION['login'] = false;

        header("Location: ../inicio.php");
        return;
    } else {
        $_SESSION['mensagem'] = "Senha inválida";
        $_SESSION['alert'] = "danger";
    }
} else {
    $_SESSION['mensagem'] = "Login não encontrado";
    $_SESSION['alert'] = "danger";
}

mysqli_close($con); //Fechando conexão
header("Location: ../");

