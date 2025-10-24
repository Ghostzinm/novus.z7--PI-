<?php
session_start();
require 'config.php';

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $tamanho = $_POST['tamanho'] ?? 'Único';
    $qtd = max(1, (int)($_POST['quantidade'] ?? 1));

    $stmt = $conn->prepare("SELECT id, nome, preco, img FROM tb_produtos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        $chave = $produto['id'] . '_' . $tamanho;

        if (isset($_SESSION['carrinho'][$chave])) {
            $_SESSION['carrinho'][$chave]['quantidade'] += $qtd;
        } else {
            $_SESSION['carrinho'][$chave] = [
                'id' => $produto['id'],
                'nome' => $produto['nome'],
                'tamanho' => $tamanho,
                'preco' => (float)$produto['preco'],
                'img' => $produto['img'],
                'quantidade' => $qtd
            ];
        }

        $totalItens = 0;
        foreach ($_SESSION['carrinho'] as $item) {
            $totalItens += $item['quantidade'];
        }

        echo json_encode([
            "success" => true,
            "carrinho_qtd" => $totalItens,
            "produto" => $_SESSION['carrinho'][$chave]
        ]);
    } else {
        echo json_encode(["success" => false, "msg" => "Produto não encontrado."]);
    }
} else {
    echo json_encode(["success" => false, "msg" => "Nenhum produto enviado."]);
}
