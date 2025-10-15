<?php
echo "<h1>cadastro php </h1>";


$formNome = $_POST["nome"];
$formEmail = $_POST["email"];
$formSenha = $_POST["senha"];
$formConfSenha = $_POST["cSenha"];
$formTelefone = $_POST["telefone"];


require('config.php');

$scriptConsulta = "SELECT * FROM tb_cadastro WHERE email = '$formEmail' ";;

$email = $conn->query($scriptConsulta)->fetchAll();

if ($formSenha != $formConfSenha) {
    echo '<h1> ta errado </h1>';
    
} else {
    if (!empty($email)) {
        echo "<h1>Email ja cadastrado</h1>";
        header('location:cadastro.php');
    } else {



        $scriptCadastro = "INSERT INTO
    tb_cadastro (
        nome,
        email,
        senha,
        telefone   )
    VALUES (
        :nome,
        :email,
        :senha,
        :telefone
    )";


        $scriptPreparado = $conn->prepare($scriptCadastro);
        $scriptPreparado->execute([
            ":nome" => $formNome,
            ":email" => $formEmail,
            ":senha" => $formSenha,
            ":telefone" => $formTelefone
               ]);
        echo"<h1>cadastrado com sucesso</h1>";
        header('location:cadastro.php');
    };
};
