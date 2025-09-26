<?php
session_start();
if(!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = [];
}

require_once('config.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    if(isset($_SESSION['carrinho'][$id])){
        $_SESSION['carrinho'][$id]['quantidade'] += 1;
    } else {
        $_SESSION['carrinho'][$id] = [
            'nome' => $nome,
            'preco' => $preco,
            'quantidade' => 1
        ];
    }

    echo "ok"; // resposta pro fetch
}
