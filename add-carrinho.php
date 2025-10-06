<?php
session_start();
require 'config.php';

// garante sessão
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    $stmt = $conn->prepare("SELECT id, nome, tamanho, preco, img FROM tb_produtos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        if (isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id]['quantidade']++;
        } else {
            $_SESSION['carrinho'][$id] = [
                'id' => $produto['id'],
                'nome' => $produto['nome'],
                'tamanho' => $produto['tamanho'],
                'preco' => $produto['preco'],
                'img' => $produto['img'],
                'quantidade' => 1
            ];
        }

        echo json_encode([
            "success" => true,
            "carrinho_qtd" => count($_SESSION['carrinho']),
            "produto" => $_SESSION['carrinho'][$id]
        ]);
    } else {
        echo json_encode(["success" => false, "msg" => "Produto não encontrado."]);
    }
} else {
    echo json_encode(["success" => false, "msg" => "Nenhum produto enviado."]);
}
