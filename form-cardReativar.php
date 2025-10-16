<?php 
session_start();
require('config.php');

$id = $_GET["id"];

$sql = "UPDATE tb_produtos SET ativo = 1 WHERE id = :id";
$scrip = $conn->prepare($sql);
$scrip->bindValue(":id", $id);
$scrip->execute();



header("Location: index.php");




