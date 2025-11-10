<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['usuario'])) {
  header('Location: login.php');
  exit;
}

$id_usuario = $_SESSION['usuario']['id'];
$id_endereco = $_POST['id'] ?? null;

if ($id_endereco) {
  $sql = "DELETE FROM tb_enderecos WHERE id = :id AND id_usuario = :id_usuario";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id_endereco, PDO::PARAM_INT);
  $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
  $stmt->execute();
}

header('Location: perfil.php');
exit;
?>
