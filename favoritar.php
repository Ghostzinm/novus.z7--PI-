<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require 'config.php';

if(!isset($_SESSION['usuario'])) {
    echo json_encode(['error' => 'Usuário não logado']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
if(!$data || !isset($data['produtoId'])){
    echo json_encode(['error' => 'Produto inválido']);
    exit;
}

$produtoId = $data['produtoId'];
$usuarioId = $_SESSION['usuario']['id'];

// Verifica se já existe
$stmt = $conn->prepare("SELECT id FROM tb_favoritos WHERE id_usuario = ? AND id_produto = ?");
$stmt->execute([$usuarioId, $produtoId]);
$fav = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$fav){
    $stmt = $conn->prepare("INSERT INTO tb_favoritos (id_usuario, id_produto) VALUES (?, ?)");
    $stmt->execute([$usuarioId, $produtoId]);
    echo json_encode(['favorito' => true]);
} else {
    $stmt = $conn->prepare("DELETE FROM tb_favoritos WHERE id_usuario = ? AND id_produto = ?");
    $stmt->execute([$usuarioId, $produtoId]);
    echo json_encode(['favorito' => false]);
}
?>
