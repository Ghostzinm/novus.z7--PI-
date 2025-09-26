<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// se clicar no botão de limpar
if (isset($_GET['acao']) && $_GET['acao'] === 'limpar') {
    unset($_SESSION['carrinho']); // limpa tudo
    header("Location: carrinho.php"); // redireciona sem GET
    exit;
}
?>
