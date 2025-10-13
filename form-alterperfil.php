<?php
require('config.php');
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["usuario"])) {
    echo "Erro: usuário não autenticado.";
    exit;
}

$usuario = $_SESSION["usuario"]["id"];
$nome = $_POST["nome"] ?? null;

// Verifica se o nome foi enviado
if (!$nome) {
    echo "Erro: Nome não informado.";
    exit;
}

// Atualiza apenas o nome
$sql = "UPDATE tb_cadastro SET nome = :nome WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(":nome", $nome);
$stmt->bindValue(":id", $usuario);
$stmt->execute();

// Redireciona para o perfil
header("Location: perfil.php");
exit;
?>
