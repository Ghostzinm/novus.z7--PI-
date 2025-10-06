<?php 
require('config.php');
session_start();

$id = $_GET["id"];

$sql = "UPDATE tb_produtos SET ativo = 0 WHERE id = :id";
$scrip = $conn->prepare($sql);
$scrip->bindValue(":id", $id);
$scrip->execute();

header("Location: index.php");



