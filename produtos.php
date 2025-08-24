<?php
include('./templates/header.php');
?>

<link rel="stylesheet" href="./css/produtos.css">


  

  <main class="container-produto">
  <div class="galeria">
    <div class="miniaturas">
      <img src="img/roupas/high.jpg" alt="Foto 1" onclick="trocarImagem(this)">
      <img src="img/roupas/Anjo_trip.png" alt="Foto 2" onclick="trocarImagem(this)">
      <img src="img/roupas/lv.webp" alt="Foto 3" onclick="trocarImagem(this)">
      <img src="img/roupas/Anjo_trip.png" alt="Foto 4" onclick="trocarImagem(this)">
    </div>
    <div class="imagem-principal">
      <img id="imagem-principal" src="img/roupas/Anjo_trip.png" alt="Nome da Peça">
    </div>
  </div>

  <div class="info-produto">
    <h2>Camiseta Street Oversized</h2>
    <p class="preco">R$ 149,90</p>
    <p class="descricao">
      Camiseta 100% algodão, modelagem oversized, estampa exclusiva Novus.z7, perfeita para quem curte o lifestyle urbano.
    </p>
    <a href="./carrinho.html" class="btn-comprar">Comprar Agora</a>
  </div>
</main>

  <script>
    function trocarImagem(elemento) {
      document.getElementById("imagem-principal").src = elemento.src;
    }
  </script>



<?php
include('./templates/footer.php');
?>
