<?php
session_start();
require 'config.php';

// Verifica se o ID do produto foi enviado
if (!isset($_POST['id'])) {
  echo json_encode(['success' => false, 'msg' => 'ID do produto não informado']);
  exit;
}

$id = (int) $_POST['id'];
$tamanho = $_POST['tamanho'] ?? 'Único';
$quantidade = isset($_POST['quantidade']) ? (int) $_POST['quantidade'] : 1;

// Busca o produto no banco
$stmt = $conn->prepare("SELECT * FROM tb_produtos WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
  echo json_encode(['success' => false, 'msg' => 'Produto não encontrado']);
  exit;
}

// Inicializa o carrinho se não existir
if (!isset($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}

// Se o produto já estiver no carrinho, só soma a quantidade
if (isset($_SESSION['carrinho'][$id])) {
  $_SESSION['carrinho'][$id]['quantidade'] += $quantidade;
} else {
  $_SESSION['carrinho'][$id] = [
    'nome' => $produto['nome'],
    'preco' => $produto['preco'],
    'tamanho' => $tamanho,
    'quantidade' => $quantidade
  ];
}

// Conta o total de itens no carrinho
$total_itens = 0;
foreach ($_SESSION['carrinho'] as $item) {
  $total_itens += $item['quantidade'];
}

echo json_encode([
  'success' => true,
  'produto' => [
    'nome' => $produto['nome'],
    'preco' => $produto['preco']
  ],
  'total_itens' => $total_itens
]);
