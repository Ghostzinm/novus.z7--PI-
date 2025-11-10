<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['usuario'])) {
  header('Location: login.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $cep = trim($_POST['formCep']);
  $rua = trim($_POST['formRua']);
  $bairro = trim($_POST['formBairro']);
  $cidade = trim($_POST['formCidade']);
  $estado = strtoupper(trim($_POST['formEstado']));
  $numero = trim($_POST['formNumero']);
  $complemento = trim($_POST['formComplemento']);
  $id_usuario = $_SESSION['usuario']['id'];

  $sql = "UPDATE tb_enderecos 
          SET cep = :cep, rua = :rua, bairro = :bairro, cidade = :cidade, estado = :estado, 
              numero = :numero, complemento = :complemento 
          WHERE id = :id AND id_usuario = :id_usuario";

  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':cep', $cep);
  $stmt->bindParam(':rua', $rua);
  $stmt->bindParam(':bairro', $bairro);
  $stmt->bindParam(':cidade', $cidade);
  $stmt->bindParam(':estado', $estado);
  $stmt->bindParam(':numero', $numero);
  $stmt->bindParam(':complemento', $complemento);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
  $stmt->execute();
}

header('Location: perfil.php');
exit;
?>
