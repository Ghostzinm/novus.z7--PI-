<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// limpar tudo
if (isset($_GET['acao']) && $_GET['acao'] === 'limpar') {
    unset($_SESSION['carrinho']);
    header("Location: carrinho.php");
    exit;
}

// remover item
if (isset($_GET['acao']) && $_GET['acao'] === 'remover' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    if (isset($_SESSION['carrinho'][$id])) {
        unset($_SESSION['carrinho'][$id]);
    }
    header("Location: carrinho.php");
    exit;
}
