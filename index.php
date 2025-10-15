<?php
include('./templates/header.php');
include('consulta-prod.php');

$logado = isset($_SESSION['usuario']);
$adm = $logado && isset($_SESSION['usuario']['adm']) && (int)$_SESSION['usuario']['adm'] === 1;

$sql = "SELECT * FROM tb_produtos WHERE ativo = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$ativo = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

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
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<section class="container-produtos py-5">

  <h1 class="text-center text-light mb-4">Produtos disponíveis</h1>
  <main class="d-flex flex-wrap justify-content-center gap-4" id="container-produtos">

    <?php if (!empty($ativo)) : ?>
      <?php foreach ($ativo as $linha) : ?>
        <figure class="product card bg-dark text-light p-2 position-relative" style="width: 18rem;">

          <?php if ($adm) : ?>
            <a href="./form-apagaroscardla.php?id=<?= $linha['id'] ?>"
              class="position-absolute end-0 m-2 p-0 text-danger"
              data-id="<?= $linha['id'] ?>">
              <i class="bi bi-x-circle fs-4"></i>
            </a>
          <?php endif; ?>

          <img src="./img/roupas/<?= htmlspecialchars($linha['img']) ?>" class="card-img-top" alt="<?= htmlspecialchars($linha['nome']) ?>">

          <figcaption class="card-body">
            <h3 class="card-title text-uppercase"><?= htmlspecialchars($linha['nome']) ?></h3>
            <p class="card-text"><?= htmlspecialchars($linha['descricao']) ?></p>
            <div class="preco text-danger fw-bold mb-2">R$ <?= htmlspecialchars(number_format($linha['preco'], 2, ',', '.')) ?></div>
            <p class="size mb-3">Tamanhos: <?= htmlspecialchars($linha['tamanho']) ?></p>

            <div class="d-flex justify-content-between align-items-center">
              <a href="./produtos.php?id=<?= $linha['id'] ?>" class="btn btn-outline-light flex-grow-1 me-1">
                Comprar <i class="bi bi-cart-plus"></i>
              </a>
              <button class="btn text-light me-1" title="Favorito">
                <i class="bi bi-heart"></i>
              </button>
              <button class="btn text-light" data-id="<?= $linha['id'] ?>">
                <i class="bi bi-bag-plus"></i>
              </button>
            </div>
          </figcaption>

        </figure>
      <?php endforeach; ?>
    <?php else : ?>
      <p class="text-center text-light mt-5">Nenhum produto disponível no momento.</p>
    <?php endif; ?>
  </main>

</section>

<style>
  body {
    background-color: #000 !important;
    color: #fff;
    overflow-x: hidden;
  }

  .container-produtos {
    background-color: #000;
  }

  .product {
    border-radius: 15px;
    transition: all 0.3s ease;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 255, 255, 0.15);
  }

  .product:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.25);
  }

  .card-img-top {
    border-radius: 70px;
    height: 230px;
    object-fit: cover;
  }

  h1 {
    font-weight: 700;
    text-shadow: 0 0 10px #0ff, 0 0 25px #0ff;
  }
</style>

<?php include('./templates/footer.php'); ?>