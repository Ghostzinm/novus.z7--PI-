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

    foreach ($_SESSION['carrinho'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['carrinho'][$key]);
            break;
        }
    }

    header("Location: carrinho.php");
    exit;
}
