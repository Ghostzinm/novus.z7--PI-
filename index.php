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
    <?php if (!empty($ativo)) : ?>
      <?php foreach ($ativo as $linha) : ?>
        <figure class="product card bg-dark text-light p-2 position-relative" data-id="<?= $linha['id'] ?>">

          <?php if ($adm) : ?>
            <a href="./form-apagaroscardla.php?id=<?= $linha['id'] ?>"
               class="delete-btn position-absolute end-0 m-2 p-0 text-danger"
               data-id="<?= $linha['id'] ?>">
               <i class="bi bi-x-circle fs-4"></i>
            </a>
          <?php endif; ?>

          <div class="overlay-desativado">DESATIVADO</div>

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
              <button class="btn cart-btn" data-id="<?= $linha['id'] ?>">
                <p><i class="bi bi-bag-plus"></i></p>
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

<!-- ====== ESTILO PARA O DESATIVADO ====== -->
<style>
  .product {
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
  }

  .product.desativado {
    opacity: 0.4;
    filter: grayscale(70%);
    pointer-events: none;
  }

  .overlay-desativado {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.75);
    color: #fff;
    font-size: 1.6rem;
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
    text-transform: uppercase;
    letter-spacing: 2px;
    opacity: 0;
    transition: opacity 0.4s ease;
  }

  .product.desativado .overlay-desativado {
    opacity: 1;
  }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {

  // ===== Adicionar ao carrinho =====
  document.querySelectorAll('.cart-btn').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      const id = btn.dataset.id;

      fetch("add-carrinho.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${id}`
      })
      .then(r => r.json())
      .then(res => {
        if (res.success) alert("Produto adicionado ao carrinho!");
        else alert(res.msg);
      })
      .catch(() => alert("Erro ao adicionar ao carrinho!"));
    });
  });

  // ===== Desativar produto (botão X) =====
  document.querySelectorAll('.delete-btn').forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault(); // evita reload da página
      const card = link.closest('.product');
      if (!card) return;

      // Aplica visual desativado
      card.classList.add('desativado');

      // Chama seu PHP para atualizar banco
      fetch(link.href)
        .then(r => r.text())
        .then(txt => console.log("Backend respondeu:", txt))
        .catch(err => {
          console.error("Erro ao chamar PHP:", err);
          card.classList.remove('desativado'); // reverte se der erro
          alert("Erro ao desativar produto!");
        });
    });
  });

});
</script>

<?php include('./templates/footer.php'); ?>
