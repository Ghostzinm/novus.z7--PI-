<?php
include('./templates/header.php');
include('config.php');

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $preco = $_POST['preco'];
  $tamanho = $_POST['tamanho'] ?? 'Único';

  if (isset($_SESSION['carrinho'][$id])) {
    $_SESSION['carrinho'][$id]['quantidade'] += 1;
  } else {
    $_SESSION['carrinho'][$id] = [
      'nome' => $nome,
      'preco' => $preco,
      'tamanho' => $tamanho,

      'quantidade' => 1
    ];
  }
}

// Consulta produto
$stmtProduto = $conn->prepare("SELECT * FROM tb_produtos WHERE id = :id");
$stmtProduto->bindParam(':id', $id, PDO::PARAM_INT);
$stmtProduto->execute();
$produto = $stmtProduto->fetch();


// Lista de imagens
$imagensProduto = array_filter([$produto['img'], $produto['img2'], $produto['img3'], $produto['img4']]);

?>

<link rel="stylesheet" href="./css/produtos.css">

<section class="produto-section">

  <main class="produto-container">

    <!-- Galeria de imagens -->
    <div class="produto-galeria">
      <div class="produto-miniaturas">
        <?php foreach ($imagensProduto as $i => $img): ?>
          <img src="img/roupas/<?= htmlspecialchars($img) ?>"
            alt="Imagem <?= $i + 1 ?> do <?= htmlspecialchars($produto['nome']) ?>"
            onclick="produtoTrocarImagem(this)"
            class="<?= $i === 0 ? 'produto-selected' : '' ?>">
        <?php endforeach; ?>
      </div>
      <div class="produto-imagem-principal">
        <img id="produto-imagem-principal"
          src="img/roupas/<?= htmlspecialchars($produto['img']) ?>"
          alt="<?= htmlspecialchars($produto['nome']) ?>">
      </div>
    </div>

    <!-- Informações do produto -->
    <div class="produto-info">
      <h1 class="produto-nome"><?= htmlspecialchars($produto['nome']) ?></h1>
      <p class="produto-preco">R$ <?= number_format($produto['preco'], 2, ",", ".") ?></p>

      <?php if (!empty($produto['tags'])): ?>
        <div class="produto-tags">
          <?php foreach (explode(',', $produto['tags']) as $tag): ?>
            <span>#<?= htmlspecialchars(trim($tag)) ?></span>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <p class="produto-descricao"><?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>

      <button class="produto-btn-comprar cart-btn btn-add-carrinho"
        data-id="<?= $produto['id'] ?>"
        data-nome="<?= $produto['nome'] ?>"
        data-img="<?= $produto['img'] ?>"
        data-tamanho="<?= $produto['tamanho'] ?>"
        data-preco="<?= $produto['preco'] ?>">
        <p>Comprar Agora <i class="bi bi-bag-plus"></i></p>
      </button>
    </div>

  </main>


</section>

<div id="toast-container-novusz7"></div>


<script src="./js/add-card.js"></script>

<?php include('./templates/footer.php'); ?>