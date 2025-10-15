<?php
session_start();
$logado = isset($_SESSION['usuario']);

if (!$logado) {
  header('Location: cadastro.php');
  exit;
}

if (!isset($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}

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
          <img src="img/roupas/<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['nome']) ?>">
          <div class="item-details">
            <h2><?= htmlspecialchars($item['nome']) ?></h2>
            <p>Tamanho: <?= htmlspecialchars($item['tamanho']) ?></p>
            <p>Preço: R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
            <p>Qtd: <?= $item['quantidade'] ?></p>
          </div>
          <a href="carrinho-delete.php?acao=remover&id=<?= $item['id'] ?>" class="remove-btn">Remover</a>
        </div>
        <?php $total += $item['preco'] * $item['quantidade']; ?>
      <?php endforeach; ?>

      <div class="cart-total">
        <p>Total: <strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></p>
        <a class="checkout-btn" href="pagamento.php?valor=<?= number_format($total, 2, '.', '') ?>">Finalizar Compra</a>
      </div>

    <?php else: ?>
      <p>Seu carrinho está vazio!</p>
    <?php endif; ?>
  </div>
</body>

</html>