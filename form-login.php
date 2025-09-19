<?php
require('config.php');
session_start();

$formEmail = $_POST["email"];
$formSenha = $_POST["senha"];

// Prepara a consulta para buscar o usuário pelo email
$scripEmail = $conn->prepare("SELECT * FROM tb_cadastro WHERE email = :email");
$scripEmail->bindParam(':email', $formEmail);
$scripEmail->execute();

$usuario = $scripEmail->fetch(PDO::FETCH_ASSOC);

if ($usuario) {  
    // Se o usuário foi encontrado e a senha estiver correta
    $_SESSION['usuario'] = [
        'id' => $usuario['id'],
        'nome' => $usuario['nome'],
        'email' => $usuario['email']
    ];
    header('location:index.php');
    exit;
} else {
    echo "<h1>Usuário ou senha inválidos</h1>";
    exit;
}
