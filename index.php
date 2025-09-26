<?php
$logado = isset($_SESSION['usuario']);

include('./templates/header.php');
include('consulta-prod.php');

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
        <img src="<?php echo './img/roupas/' . ($linha['img']); ?>" class="card-img-top" alt="<?php echo $linha['nome']; ?>">
        <figcaption class="card-body">
          <h3 class="card-title"><?php echo $linha['nome']; ?></h3>
          <p class="card-text"><?php echo $linha['descricao']; ?></p>
          <div class="preco mb-2">R$ <?php echo $linha['preco']; ?></div>
          <p class="size mb-3">Tamanhos: <?php echo $linha['tamanho']; ?></p>

          <div class="d-flex justify-content-between">
            <a href="./produtos.php?id=<?php echo $linha['id']; ?>" class="btn buy-btn flex-grow-1 me-1">
              <p>Comprar <i class="bi bi-cart-plus"></i></p>
            </a>
            <button class="btn fav-btn me-1" title="Favorito">
              <p><i class="bi bi-heart"></i></p>
            </button>
            <button class="btn cart-btn"
              data-id="<?php echo $linha['id']; ?>"
              data-nome="<?php echo $linha['nome']; ?>"
              data-img="<?php echo $linha['img']; ?>"
              data-tamanho="<?php echo $linha['tamanho']; ?>"
              data-preco="<?php echo $linha['preco']; ?>">
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
      const nome = btn.dataset.nome;
      const preco = btn.dataset.preco;

      fetch("form-carrinho.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: `id=${id}&nome=${nome}&preco=${preco}`
        })
        .then(r => r.text())
        .then(res => {
          alert("Produto adicionado ao carrinho!");
        });
    });
  });
</script>

<script type="module">
  import Typebot from 'https://cdn.jsdelivr.net/npm/@typebot.io/js@0/dist/web.js'

  Typebot.initBubble({
    typebot: "novuz-z7-fqmkeok",
    theme: {
      button: {
        backgroundColor: "#ff5924"
      },
      chatWindow: {
        backgroundColor: "#1D1D1D"
      },
    },
  });
</script>

<?php include('./templates/footer.php'); ?>

</body>

</html>