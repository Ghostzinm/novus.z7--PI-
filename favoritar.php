<?php
require 'config.php';
require_once './classes/Favoritos.php';

header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['usuario'])) {
    echo json_encode(['error' => 'Usuário não logado']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$produtoId = isset($data['produtoId']) ? (int)$data['produtoId'] : 0;
if ($produtoId <= 0) {
    echo json_encode(['error' => 'ID inválido']);
    exit;
}

$usuarioId = $_SESSION['usuario']['id'];

// Verifica se já existe
$stmt = $conn->prepare("SELECT id FROM tb_favoritos WHERE id_usuario = ? AND id_produto = ?");
$stmt->execute([$usuarioId, $produtoId]);
$fav = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$fav) {
    // Adiciona favorito
    $stmt = $conn->prepare("INSERT INTO tb_favoritos (id_usuario, id_produto) VALUES (?, ?)");
    $stmt->execute([$usuarioId, $produtoId]);
    echo json_encode(['favorito' => true]);
    exit;
} else {
    // Remove favorito
    $stmt = $conn->prepare("DELETE FROM tb_favoritos WHERE id_usuario = ? AND id_produto = ?");
    $stmt->execute([$usuarioId, $produtoId]);
    echo json_encode(['favorito' => false]);
    exit;
}
