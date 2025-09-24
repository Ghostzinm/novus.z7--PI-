<?php

require('config.php');

$id = (int) $_GET['idProduto'];

$scriptConsulta = "SELECT * FROM tb_produtos WHERE id = :id";
$stmt = $conn->prepare($scriptConsulta);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

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
            <a class="checkout-btn" href="./form-carrinho.php" target="_blank">Finalizar Compra</a>

    </div>


  </div>
</body>
</html>
