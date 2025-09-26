<?php
session_start();
require('config.php');

// Se não existir carrinho, cria vazio
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Se veio um produto pela URL (ex: add)
if (isset($_GET['idProduto'])) {
    $id = (int) $_GET['idProduto'];

    // Consulta produto no banco
    $stmt = $conn->prepare("SELECT * FROM tb_produtos WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        // Adiciona ao carrinho
        $_SESSION['carrinho'][] = $produto;
    }
}

// Agora lista o carrinho inteiro
$itensCarrinho = $_SESSION['carrinho'];
$total = 0;
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
          <a href="carrinho-delete.php?acao=limpar" class="btn limpar-btn">🗑 Esvaziar carrinho</a>


    <?php if (count($itensCarrinho) > 0): ?>
      <?php foreach ($itensCarrinho as $item): ?>
        <div class="cart-item">
          <img src="img/roupas/<?= $item['img'] ?>" alt="<?= $item['nome'] ?>">
          <div class="item-details">
            <h2><?= $item['nome'] ?></h2>
            <p>Tamanho: <?= $item['tamanho'] ?></p>
            <p>Preço: R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
          </div>
          <button class="remove-btn">Remover</button>
        </div>
        <?php $total += $item['preco']; ?>
      <?php endforeach; ?>

      <div class="cart-total">
        <p>Total: <strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></p>
        <a class="checkout-btn" href="./form-carrinho.php" target="_blank">Finalizar Compra</a>
      </div>

    <?php else: ?>
      <p>Seu carrinho está vazio!</p>
    <?php endif; ?>
  </div>
</body>
</html>
