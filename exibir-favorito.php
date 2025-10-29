<?php
session_start();
require 'config.php';



$logado = isset($_SESSION['usuario']);
if (!$logado) {
    header('Location: cadastro.php');
    exit;
}
$adm = isset($_SESSION['usuario']['adm']) && (int)$_SESSION['usuario']['adm'] === 1;

$usuarioId = $_SESSION['usuario']['id'] ?? null;

// Pega apenas os produtos favoritados pelo usuário
$stmt = $conn->prepare("
    SELECT p.*
    FROM tb_produtos p
    JOIN tb_favoritos f ON p.id = f.id_produto
    WHERE f.id_usuario = ?
    ORDER BY f.id DESC
");
$stmt->execute([$usuarioId]);
$produtosFavoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/perfil.css" />
  <link rel="stylesheet" href="./css/footer.css" />
  <link rel="stylesheet" href="./css/header.css" />
  <link rel="stylesheet" href="./css/exibir-favorito.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

<!-- Produtos Favoritos -->
<section class="container-produtos py-5">
  <a class="btn-exibirfav" href="./index.php">voltar</a>
  <h1 class="text-center text-light mb-4">Meus ffavoritos❤️</h1>
  <main class="d-flex flex-wrap justify-content-center gap-4">

    <?php if (!empty($produtosFavoritos)) :
      foreach ($produtosFavoritos as $produto) :
        $inativo = ((int)$produto['ativo'] === 0);
        if ($inativo && !$adm) continue;
    ?>
        <figure class="product card bg-dark text-light p-2 position-relative">
          <?php if ($adm) { ?>
            <div class="bnt-adm position-absolute end-0 top-0 m-2">
              <a href="./form-cardApagar.php?id=<?= $produto['id'] ?>" class="text-danger" title="Excluir produto">
                <i class="bi bi-x-circle fs-4"></i>
              </a>
              <a href="./editar_produto.php?id=<?= $produto['id'] ?>" class="text-warning" title="Editar produto">
                <i class="bi bi-pencil-fill fs-4"></i>
              </a>
              <?php if ($inativo) { ?>
                <a href="./form-cardReativar.php?id=<?= $produto['id'] ?>" class="text-success" title="Reativar produto">
                  <i class="bi bi-arrow-clockwise fs-4"></i>
                </a>
              <?php } ?>
            </div>
          <?php } ?>

          <img src="./img/roupas/<?= htmlspecialchars($produto['img']) ?>" class="card-img-top" alt="<?= htmlspecialchars($produto['nome']) ?>"
            style="<?= $inativo && $adm ? 'opacity: 0.5; filter: grayscale(50%);' : '' ?>">

          <figcaption class="card-body" style="<?= $inativo && $adm ? 'opacity: 0.5; filter: grayscale(50%);' : '' ?>">
            <h3 class="card-title text-uppercase"><?= htmlspecialchars($produto['nome']) ?></h3>
            <p class="card-text"><?= htmlspecialchars($produto['descricao']) ?></p>
            <div class="preco text-danger fw-bold mb-2">R$ <?= htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) ?></div>
            <p class="size mb-3">Tamanhos: <?= htmlspecialchars($produto['tamanho']) ?></p>

            <div class="d-flex justify-content-between align-items-center">
              <a href="./produtos.php?id=<?= $produto['id'] ?>" class="btn btn-outline-light flex-grow-1 me-1">
                Comprar <i class="bi bi-cart-plus"></i>
              </a>
              <button class="btn text-light btn-fav me-1" data-id="<?= $produto['id'] ?>" title="Favorito">
                <i class="bi bi-heart-fill text-danger"></i>
              </button>
            </div>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center text-light mt-5">Você ainda não favoritou nenhum produto.</p>
    <?php endif; ?>

  </main>
</section>

<!-- Toast container -->
<div id="toast-container-novusz7"></div>

<script src="./js/add-fav.js"></script>
<?php include('./templates/footer.php'); ?>
