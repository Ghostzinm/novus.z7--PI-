<?php
require 'config.php';

// Adiciona ao carrinho
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

// Consulta o produto
$id = $_GET['id'] ?? null;
if (!$id) {
  die('Produto não encontrado.');
}

$stmt = $conn->prepare("SELECT * FROM tb_produtos WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
  die('Produto não encontrado.');
}

$usuarioId = $_SESSION['usuario']['id'] ?? null;

foreach ($produtos as $key => $produto) {
    $produtos[$key]['favorito'] = $usuarioId ? Favoritos::isFavorito($conn, $produto['id'], $usuarioId) : false;
}
include('./templates/header.php');
?>

<link rel="stylesheet" href="./css/produtos.css">

<section class="produto-section">
  <div class="produto-container">

    <!-- GALERIA -->
    <div class="produto-galeria">
      <div class="produto-miniaturas">
        <?php for ($i = 1; $i <= 4; $i++): ?>
          <?php if (!empty($produto["img$i"])): ?>
            <img src="img/roupas/<?= $produto["img$i"] ?>"
              alt="Imagem <?= $i ?>"
              onclick="trocarImagem(this)">
          <?php endif; ?>
        <?php endfor; ?>
      </div>

      <div class="produto-imagem-principal">
        <img id="imagem-principal"
          src="img/roupas/<?= $produto['img'] ?>"
          alt="<?= htmlspecialchars($produto['nome']) ?>">
      </div>
    </div>

    <!-- INFORMAÇÕES -->
    <div class="produto-info">
      <h1 class="produto-nome"><?= htmlspecialchars($produto['nome']) ?></h1>
      <p class="produto-preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
      <p class="produto-frete">🚚 Frete Grátis para todo o Brasil</p>

      <div class="produto-opcoes">
        <select id="tamanho" name="tamanho">
          <option value="P">P</option>
          <option value="M">M</option>
          <option value="G">G</option>
          <option value="GG">GG</option>
        </select>
      </div>

      <p class="produto-descricao"><?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>

      <a href="./add-carrinho.php" class="produto-btn-comprar cart-btn"
        data-id="<?= $produto['id'] ?>"
        data-nome="<?= htmlspecialchars($produto['nome']) ?>"
        data-preco="<?= $produto['preco'] ?>"
        data-tamanho="<?= $produto['tamanho'] ?>"
        data-img="<?= $produto['img'] ?>">
        Comprar Agora 🛒
      </a>
      <button class="btn text-light btn-fav me-1" id="fav-<?= $produto['id'] ?>" data-id="<?= $produto['id'] ?>">
        <i class="bi <?= $produto['favorito'] ? 'bi-heart-fill text-danger' : 'bi-heart' ?>"></i>
      </button>
      <button class="btn text-light btn-add-carrinho" data-id="<?= $produto['id'] ?>">
        <i class="bi bi-bag-plus"></i>
      </button>
    </div>
  </div>
</section>

<script src="./js/add-card.js"></script>
<script src="./js/add-fav.js"> </script>
<script>
  function trocarImagem(elemento) {
    const principal = document.getElementById('imagem-principal');
    document.querySelectorAll('.produto-miniaturas img').forEach(img => img.classList.remove('produto-selected'));
    elemento.classList.add('produto-selected');
    principal.src = elemento.src;
  }
</script>

<?php include('./templates/footer.php'); ?>