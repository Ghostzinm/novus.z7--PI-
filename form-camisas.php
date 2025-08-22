<?php
echo "<h1>cadastro de camisas php </h1>";


$formNome = $_POST["nome"];
$formPreco = $_POST["preco"];
$formDesc = $_POST["desc"];

$dsn = 'mysql:dbname=db_novus;host=127.0.0.1';
$usuario = 'root';
$senha = '';

if ($formSenha != $formConfSenha) {
    echo'ta errado';
} else {

$conn = new PDO($dsn, $usuario, $senha);

$scriptCadastro = "INSERT INTO
    tb_pordutos(
        nome,
        preco,
        descricao
    )
    VALUES (
        :nome,
        :email,
        :descricao
    )";


    $scriptPreparado = $conn->prepare($scriptCadastro);
    $scriptPreparado->execute([
        ":nome" => $formNome,
        ":preco"=> $formPreco,
        ":desc" => $formDesc
    ]);
    header('location:adm.php');
    
};