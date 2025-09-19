<?php 
require('config.php');
session_start();

$formEmail = $_POST["email"];
$formSenha = $_POST["senha"];

$scriptConsulta = "SELECT * FROM tb_cadastro WHERE email = '$formEmail' AND senha = '$formSenha' ";
$usuario = $conn->query($scriptConsulta)->fetchAll();

$_SESSION['usuario'] = [
    'id' => $usuario['id'],
    'nome' => $usuario['nome'],
    'email' => $usuario['email']
];

if (!empty($usuario)) {
    header('location:index.php');
} else {
    echo "<h1>Usuário ou senha inválidos</h1>";
    // header('location:cadastro.php');
}


?>