<?php
session_start();
include 'config.php';

$id_usuario = $_SESSION['usuario']['id'] ?? null;
if (!$id_usuario) {
    die("Usuário não está logado.");
}

if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) === 0) {
    die("Carrinho vazio.");
}

// Supondo que endereço e método venham via POST
$endereco_entrega = $_POST['endereco_entrega'] ?? 'Não informado';
$metodo_pagamento = $_POST['metodo_pagamento'] ?? 'Não informado';

// Calcula total
$total = 0;
foreach ($_SESSION['carrinho'] as $item) {
    $total += $item['preco'] * $item['quantidade'];
} 


try {
    $conn->beginTransaction();

    // Inserir pedido
    $sqlPedido = "INSERT INTO tb_pedidos (id_usuario, preco_total, status, data_pedido, endereco_entrega, metodo_pagamento) 
                  VALUES (:id_usuario, :preco_total, 'Pendente', NOW(), :endereco_entrega, :metodo_pagamento)";
    $stmtPedido = $conn->prepare($sqlPedido);
    $stmtPedido->execute([
        ':id_usuario' => $id_usuario,
        ':preco_total' => $total,
        ':endereco_entrega' => $endereco_entrega,
        ':metodo_pagamento' => $metodo_pagamento,
    ]);

    $pedido_id = $conn->lastInsertId();

    // Inserir itens do pedido
    $sqlItens = "INSERT INTO tb_pedido_itens (pedido_id, id_produto, nome, tamanho, preco, quantidade) 
                 VALUES (:pedido_id, :id_produto, :nome, :tamanho, :preco, :quantidade)";
    $stmtItens = $conn->prepare($sqlItens);

    foreach ($_SESSION['carrinho'] as $item) {
        $stmtItens->execute([
            ':pedido_id' => $pedido_id,
            ':id_produto' => $item['id'],
            ':nome' => $item['nome'],
            ':tamanho' => $item['tamanho'],
            ':preco' => $item['preco'],
            ':quantidade' => $item['quantidade'],
        ]);
    }

    $conn->commit();

    unset($_SESSION['carrinho']);

    echo "Pedido realizado com sucesso! Número do pedido: $pedido_id";

} catch (Exception $e) {
    $conn->rollBack();
    echo "Erro ao salvar pedido: " . $e->getMessage();
}
?>
