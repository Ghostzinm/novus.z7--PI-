
<?php 
session_start();
$logado = isset($_SESSION['usuario']);


if ($logado && (int)$_SESSION['usuario']['adm'] != 1) {
  echo '<script>alert("Acesso negado. Faça login como administrador."); window.location.href = "cadastro.php";</script>';
  exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Upload de Camisas - novus.z7</title>
  <link rel="stylesheet" href="./css/adm.css">
</head>
<body>
  <div class="container">
    <h1>Upload de Camisas - novus.z7 🕸️</h1>
 
    <form action="./form-camisas.php" method="post" id="uploadForm" enctype="multipart/form-data">
      <label for="img1">Imagem principal:</label>
      <input type="file" id="img1" accept="image/*" name="img1" required>
 
      <label for="img2">Imagem 2:</label>
      <input type="file" id="img2" accept="image/*" name="img2">
 
      <label for="img3">Imagem 3:</label>
      <input type ="file" id="img3" accept="image/*" name="img3">
 
      <label for="img4">Imagem 4:</label>
      <input type="file" id="img4" accept="image/*" name="img4">

      <label for="img5">Imagem 5:</label>
      <input type="file" id="img5" accept="image/*" name="img5">
 
      <textarea name="desc" placeholder="Descrição da camisa" required></textarea>

<label for="estoque">Quantidade em estoque:</label>
<input type="number" id="estoque" name="estoque" placeholder="Ex: 15" min="0" required>


    

 
      <input name="nomeCamisa" type="text" placeholder="Nome da camisa" required>
      <select name="tipo" required>
        <option value="premium">Premium</option>
        <option value="comum">Comum</option>
      </select>
      <select name="tamanho" required>
        <option value="M">M</option>
        <option value="G">G</option>
        <option value="GG">GG</option>
      </select>
      <input name="preco" type="number" placeholder="Preço da camisa" required>
      <textarea name="desc" placeholder="Descrição da camisa" required></textarea>
      <button type="submit">Adicionar Camisa</button>
    </form>
  </div>
</body>
</html>
 
 