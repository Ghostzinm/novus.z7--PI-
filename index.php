<?php include('./templates/header.php'); ?>

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

<main class="conteudo">
  <section class="container">
    <figure class="product">
      <img src="./img/roupas/lv.webp" alt="Camisa Premium Luis Vuitton">
      <figcaption>
        <h3>Luis Vuitton</h3>
        <p>Camisa Premium</p>
        <div class="preco">R$ 70,00</div>
        <p class="size">Tamanhos: G</p>
        <a class="buy-btn" href="https://instagram.com/novus.z7" target="_blank">Comprar no Insta</a>
      </figcaption>
    </figure>

    <figure class="product">
      <img src="./img/roupas/Anjo_trip.png" alt="Camisa Premium Anjo">
      <figcaption>
        <h3>Anjo Trip $ide</h3>
        <p>Camisa Premium</p>
        <div class="preco">R$ 70,00</div>
        <p class="size">Tamanhos: M</p>
        <a class="buy-btn" href="https://instagram.com/novus.z7" target="_blank">Comprar no Insta</a>
      </figcaption>
    </figure>

    <figure class="product">
      <img src="./img/roupas/compton.png" alt="Camisa Premium Compton">
      <figcaption>
        <h3>Compton</h3>
        <p>Camisa Premium</p>
        <div class="preco">R$ 70,00</div>
        <p class="size">Tamanhos: M</p>
        <a class="buy-btn" href="https://instagram.com/novus.z7" target="_blank">Comprar no Insta</a>
      </figcaption>
    </figure>

    <figure class="product">
      <img src="./img/roupas/high.jpg" alt="Camisa Premium High Dragão">
      <figcaption>
        <h3>HIGH Dragão</h3>
        <p>Camisa Comum.</p>
        <div class="preco">R$ 50,00</div>
        <p class="size">Tamanhos: M</p>
        <a class="buy-btn" href="https://instagram.com/novus.z7" target="_blank">Comprar no Insta</a>
      </figcaption>
    </figure>
  </section>
</main>

<?php include('./templates/footer.php'); ?>

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

</body>

</html>