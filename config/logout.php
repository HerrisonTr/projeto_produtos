<?php

session_destroy(); //Destroe os dados atuais da sessão
session_start(); //Inicia sessão novamente para insersão da mensagem
$_SESSION['mensagem'] = "Usuário desconctado com sucesso";
$_SESSION['alert'] = "success";
header("Location: ../");
