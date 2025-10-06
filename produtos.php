<?php



if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $preco = $_POST['preco'];
  $tamanho = $_POST['tamanho'] ?? 'Único';

  if (isset($_SESSION['carrinho'][$id])) {
    $_SESSION['carrinho'][$id]['quantidade'] += 1;
  } else {
    $_SESSION['carrinho'][$id] = [
      'nome' => $nome,
      'preco' => $preco,
      'tamanho' => $tamanho,
















      
      'quantidade' => 1
    ];
  }
}

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
    <button class="btn-comprar cart-btn"
      data-id="<?= $produto['id'] ?>"
      data-nome="<?= $produto['nome'] ?>"
      data-img="<?= $produto['img'] ?>"
      data-tamanho="<?= $produto['tamanho'] ?>"
      data-preco="<?= $produto['preco'] ?>">
      <p>Comprar Agora <i class="bi bi-bag-plus"></i></p>
    </button>

  </div>
</main>

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

<script>
  function trocarImagem(elemento) {
    document.getElementById("imagem-principal").src = elemento.src;
  }
</script>



<?php
include('./templates/footer.php');
?>