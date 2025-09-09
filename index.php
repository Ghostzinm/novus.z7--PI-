<?php include('./templates/header.php');
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

<section class="container-produtos" >
  <main class="conteudo container" id="container-produtos">
  <?php foreach ($resultado as $linha): ?>
      <figure class="product">
        <!-- Coloque a imagem do produto, se tiver no banco use $linha['imagem'] -->
        <!-- Aqui, só um placeholder fixo. Ajuste conforme seu banco -->
        <img src="<?php echo './img/roupas/' . ($linha['img'] ?? 'default.webp'); ?>" alt="<?php echo htmlspecialchars($linha['nome']); ?>">
        <figcaption>
          <h3><?php echo htmlspecialchars($linha['nome']); ?></h3>
          <p><?php echo htmlspecialchars($linha['descricao']); ?></p>
          <div class="preco">R$ <?php echo $linha['preco']; ?></div>
          <!-- Se tiver tamanhos, pode puxar do banco, senão deixe fixo -->
          <p class="size">Tamanhos: G</p>
          <a class="buy-btn" href="./produtos.php?id=<?php echo $linha['id']; ?>" target="_blank">Comprar</a>
        </figcaption>
      </figure>
    <?php endforeach; ?>

  </main>
</section>

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