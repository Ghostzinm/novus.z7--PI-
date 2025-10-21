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
  <title>Carrinho | novus.z7 ☯</title>
  <link rel="stylesheet" href="./css/carrinho.css">
</head>

<body>
  <header>
    <a class="btn-carrinho" href="./index.php">voltar</a>
  </header>

  <section class="cart-section">
    <main class="cart-main">

      <h1 sclass="cart-header">Carrinho de Compras</h1>
      <div class="cart-container">
        <div class="cart-header">
          <h2>Seu Carrinho</h2>


          <a href="carrinho-delete.php?acao=limpar" class="btn limpar-btn">🗑 Esvaziar</a>
        </div>

        <?php if (count($itensCarrinho) > 0): ?>
          <div class="cart-list">
            <?php foreach ($itensCarrinho as $item): ?>
              <div class="cart-item">
                <img src="img/roupas/<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['nome']) ?>">
                <div class="item-details">
                  <h2><?= htmlspecialchars($item['nome']) ?></h2>
                  <p>Tamanho: <span><?= htmlspecialchars($item['tamanho']) ?></span></p>
                  <p>Preço: <span>R$ <?= number_format($item['preco'], 2, ',', '.') ?></span></p>
                  <p>Qtd: <span><?= $item['quantidade'] ?></span></p>
                </div>
                <a href="carrinho-delete.php?acao=remover&id=<?= $item['id'] ?>" class="remove-btn">✖</a>
              </div>
              <?php $total += $item['preco'] * $item['quantidade']; ?>
            <?php endforeach; ?>
          </div>

          <?php
          $frete = ($total > 150) ? 0 : 19.90;
          $subtotal = $total;
          $totalFinal = $subtotal + $frete;
          ?>

          <div class="summary">
            <h3>Resumo do Pedido</h3>
            <div class="summary-line">
              <span>Subtotal</span>
              <span>R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
            </div>
            <div class="summary-line">
              <span>Frete</span>
              <span><?= $frete == 0 ? 'Grátis 🚀' : 'R$ ' . number_format($frete, 2, ',', '.') ?></span>
            </div>
            <div class="summary-total">
              <span>Total Final</span>
              <strong>R$ <?= number_format($totalFinal, 2, ',', '.') ?></strong>
            </div>
          </div>

          <!-- formas de pagamento -->
          <form action="pagamento.php" method="post" class="checkout-form">
            <label for="metodo_pagamento">Forma de Pagamento</label>
            <select name="metodo_pagamento" id="metodo_pagamento" required>
              <option value="">Selecione</option>
              <option value="cartao">Cartão de Crédito</option>
              <option value="Pix">Pix</option>
            </select>
            <input type="hidden" name="valor" value="<?= number_format($totalFinal, 2, '.', '') ?>">
            <button type="submit" class="checkout-btn">Finalizar Compra </button>
          </form>

        <?php else: ?>
          <p class="empty-cart">Seu carrinho está vazio 🕸</p>

        <?php endif; ?>

      </div>
    </main>
  </section>
</body>

</html>