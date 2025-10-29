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

      <h1 sclass="cart-header">Meus pedidos</h1>
      <div class="cart-container">
        <div class="cart-header">
          <h2>meus pedidos</h2>


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

          
          

        <?php else: ?>
          <p class="empty-cart">Seu carrinho está vazio 🕸</p>

        <?php endif; ?>

      </div>
    </main>
  </section>
</body>

</html>