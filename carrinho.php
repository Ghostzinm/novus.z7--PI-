<?php

require('config.php');

$id = (int) $_GET['idProduto'];
$scriptBusca = "SELECT * FROM tb_cadastro WHERE id = $id";

$scriptConsulta = 'SELECT * FROM tb_produtos';

$resultadoConsulta = $conn->query($scriptConsulta)->fetchAll();

$produto = $resultadoConsulta[$id];

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Carrinho - Loja</title>
  <link rel="stylesheet" href="./css/carrinho.css">
</head>

<body>
  <div class="cart-container">
    <h1>Carrinho de Compras</h1>
      <h3>quantidade</h3>

    <div class="cart-item">
      <img src="img/roupas/<?= $produto['img'] ?>" alt="Tênis Nike">
      <div class="item-details">
        <h2><?= $produto['nome'] ?> </h2>
        <p>Tamanho:<?= $produto['tamanho'] ?></p>
        <p><?= $produto['preco'] ?> </p>
          
      </div>
     
    </div>
 <button class="remove-btn">Remover</button>
    <div class="cart-total">
      <p>Total: <strong><?= $produto['preco'] ?> </strong></p>
            <a class="checkout-btn" href="./index.php" target="_blank">Finalizar Compra</a>

    </div>


  </div>
</body>
</html>
