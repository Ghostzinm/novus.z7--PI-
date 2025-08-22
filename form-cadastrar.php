<?php
echo "<h1>cadastro php </h1>";


$formNome = $_POST["nome"];
$formEmail = $_POST["email"];
$formSenha = $_POST["senha"];
$formConfSenha = $_POST["cSenha"];

$dsn = 'mysql:dbname=db_novus;host=127.0.0.1';
$usuario = 'root';
$senha = '';

if ($formSenha != $formConfSenha) {
    echo'ta errado';
} else {

$conn = new PDO($dsn, $usuario, $senha);

$scriptCadastro = "INSERT INTO
    tb_cadastro (
        nome,
        email,
        senha
    )
    VALUES (
        :nome,
        :email,
        :senha
    )";


    $scriptPreparado = $conn->prepare($scriptCadastro);
    $scriptPreparado->execute([
        ":nome" => $formNome,
        ":email"=> $formEmail,
        ":senha" => $formSenha
    ]);
    header('location:index.php');
    
};