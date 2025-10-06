<?php
$logado = isset($_SESSION['usuario']);


include('./templates/header.php');
include('consulta-prod.php');

$adm = isset($_SESSION['usuario']) && (int)$_SESSION['usuario']['adm'] === 1;


?>

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./img/carrossel/c-img1.jpg" class="d-block w-100 c-img" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./img/carrossel/c-img2.jpg" class="d-block w-100 c-img" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./img/fundo.png" class="d-block w-100 c-img" alt="...">
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

<section class="container-produtos">
  <main class="conteudo container" id="container-produtos">
    <?php foreach ($resultado as $linha): ?>
      <figure class="product card bg-dark text-light p-2">
        <?php if ($adm) { ?>
          <a href="./form-apagaroscardla.php?id=<?= $linha['id'] ?>"><i class="bi bi-x-circle"></i></a>
        <?php } ?>

        <img src="./img/roupas/<?= htmlspecialchars($linha['img']) ?>" class="card-img-top" alt="<?= htmlspecialchars($linha['nome']) ?>">
        <figcaption class="card-body">
          <h3 class="card-title"><?= htmlspecialchars($linha['nome']) ?></h3>
          <p class="card-text"><?= htmlspecialchars($linha['descricao']) ?></p>
          <div class="preco mb-2">R$ <?= htmlspecialchars($linha['preco']) ?></div>
          <p class="size mb-3">Tamanhos: <?= htmlspecialchars($linha['tamanho']) ?></p>

          <div class="d-flex justify-content-between">
            <a href="./produtos.php?id=<?= $linha['id'] ?>" class="btn buy-btn flex-grow-1 me-1">
              <p>Comprar <i class="bi bi-cart-plus"></i></p>
            </a>
            <button class="btn fav-btn me-1" title="Favorito">
              <p><i class="bi bi-heart"></i></p>
            </button>
            <button class="btn cart-btn"
              data-id="<?= $linha['id'] ?>">
              <p><i class="bi bi-bag-plus"></i></p>
            </button>
          </div>
        </figcaption>
      </figure>
    <?php endforeach; ?>
  </main>
</section>

<script>
  document.querySelectorAll('.cart-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;

      fetch("add-carrinho.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: `id=${id}`
        })
        .then(r => r.json())
        .then(res => {
          if (res.success) {
            alert("Produto adicionado ao carrinho!");
          } else {
            alert(res.msg);
          }
        });
    });
  });
</script>

<?php include('./templates/footer.php'); ?>