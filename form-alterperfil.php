<?php


$id = $_POST["id"];
$nome = $_POST["nome"];
$foto = $_FILES["foto"];


  if (!$id) {
    die("Erro: ID não informado.");
    }
    else if(!empty($foto["name"])){

    $id = $_POST['id'] ?? null;

 
    


    $extensao = strtolower(pathinfo($foto["name"], PATHINFO_EXTENSION));
    $novoNome = uniqid().".".$extensao;
    $caminho = "uploads/".$novoNome;

    move_uploaded_file($foto["tmp_name"], $caminho);

    require('config.php');
    session_start();
    $usuarioId = $_SESSION["usuarioId"];

    $sql = "UPDATE tb_cadastro SET nome = :nome, foto = :foto WHERE id = :id";
    $scrip = $conn->prepare($sql);
    $scrip->bindValue(":nome", $nome);
    $scrip->bindValue(":foto", $caminho);
    $scrip->bindValue(":id", $usuarioId);
    $scrip->execute();

    header("Location: perfil.php");

}



    



?>