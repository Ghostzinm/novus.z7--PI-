<?php

include('./templates/header.php');
include('config.php');

$id = $_GET['id'];

$scriptConsulta = "SELECT * FROM tb_produtos WHERE id = :id";
$resultadoConsulta = $conn->prepare($scriptConsulta);
$resultadoConsulta->bindParam(':id', $id, PDO::PARAM_INT);
$resultadoConsulta->execute();

$produto = $resultadoConsulta->fetch();

?>

<link rel="stylesheet" href="./css/produtos.css">


  

  <main class="container-produto">
  <div class="galeria">
    <div class="miniaturas">
      <img src="img/roupas/<?= $produto['img'] ?>" alt="Foto 1" onclick="trocarImagem(this)">
      <img src="img/roupas/<?= $produto['img2'] ?>" alt="Foto 2" onclick="trocarImagem(this)">
      <img src="img/roupas/lv.webp" alt="Foto 3" onclick="trocarImagem(this)">
      <img src="img/roupas/Anjo_trip.png" alt="Foto 4" onclick="trocarImagem(this)">
    </div>
    <div class="imagem-principal">
      <img id="imagem-principal" src="img/roupas/<?= $produto['img'] ?>" alt="Nome da Peça">
    </div>
  </div>

  <div class="info-produto">
    <h2><?= $produto['nome'] ?></h2>
    <p class="preco"><?= $produto['preco'] ?></p>
    <p class="descricao">
    <?= $produto['descricao'] ?>
    </p>
    <a href="./carrinho.php?idProduto=<?= $id ?>" class="btn-comprar">Comprar Agora</a>
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
