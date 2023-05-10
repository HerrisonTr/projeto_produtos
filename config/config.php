<?php

session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['login'])) {
    $_SESSION['mensagem'] = "Sessão expirada";
    $_SESSION['alert'] = "danger";
    header("Location: ./");
    return;
}

// Padrão brasileiro
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

