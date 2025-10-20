<?php
require 'config.php';

$logado = isset($_SESSION['usuario']);
$adm = $logado && isset($_SESSION['usuario']['adm']) && (int)$_SESSION['usuario']['adm'] === 1;

$sql = "SELECT * FROM tb_produtos";
$stmt = $conn->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

include('./templates/header.php');
?>

<!-- Carrossel -->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./img/carrossel/c-img2.jpg" class="d-block w-100 c-img" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./img/fundo.png" class="d-block w-100 c-img" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./img/logo.jpg" class="d-block w-100 c-img" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>

<!-- Produtos -->
<section class="container-produtos py-5">
  <h1 class="text-center text-light mb-4">Produtos disponíveis</h1>
  <main class="d-flex flex-wrap justify-content-center gap-4" id="container-produtos">

    <?php if (!empty($produtos)) :
      foreach ($produtos as $produto) :
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


          <img src="./img/roupas/<?= htmlspecialchars($produto['img']) ?>"
            class="card-img-top" alt="<?= htmlspecialchars($produto['nome']) ?>"
            style="<?= $inativo && $adm ? 'opacity: 0.5; filter: grayscale(50%);' : '' ?>">
          <figcaption class="card-body"
            style="<?= $inativo && $adm ? 'opacity: 0.5; filter: grayscale(50%);' : '' ?>">

            <h3 class="card-title text-uppercase"><?= htmlspecialchars($produto['nome']) ?></h3>
            <p class="card-text"><?= htmlspecialchars($produto['descricao']) ?></p>
            <div class="preco text-danger fw-bold mb-2">R$ <?= htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) ?></div>
            <p class="size mb-3">Tamanhos: <?= htmlspecialchars($produto['tamanho']) ?></p>

            <?php if ($inativo && $adm) { ?>
              <p class="Removido badge bg-danger text-uppercase fw-bold">
                Removido
              </p>

            <?php } else { ?>
              <div class="d-flex justify-content-between align-items-center">
                <a href="./produtos.php?id=<?= $produto['id'] ?>" class="btn btn-outline-light flex-grow-1 me-1">
                  Comprar <i class="bi bi-cart-plus"></i>
                </a>
                <button class="btn text-light me-1" title="Favorito">
                  <i class="bi bi-heart"></i>
                </button>
                <button class="btn text-light btn-add-carrinho" title="Adicionar ao carrinho" data-id="<?= $produto['id'] ?>">
                  <i class="bi bi-bag-plus"></i>
                </button>
              </div>
            <?php }; ?>

          </figcaption>
        </figure>
      <?php endforeach; ?>

    <?php else:  ?>
      <p class="text-center text-light mt-5">Nenhum produto disponível no momento.</p>
    <?php endif; ?>

  </main>
</section>

<!-- Toast container -->
<div id="toast-container-novusz7"></div>

<script src="./js/add-card.js"></script>



<?php include('./templates/footer.php'); ?>