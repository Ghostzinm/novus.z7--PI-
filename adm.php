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
      <label for="imagem">Selecione a imagem da camisa:</label>
      <input type="file" id="imagem" accept="image/*" name="imagem" multiple required>

      <input name="nomeCamisa" type="text" id="nomeCamisa" placeholder="Nome da camisa" required>
      <select name="tipo" id="tipoCamisa" required>
        <option value="premium">Premium</option>
        <option value="comum">Comum</option>
      </select>
         <select name="tamanho" id="tamanhoCamisa" required>
        <option value="M">M</option>
        <option value="G">G</option>
         <option value="GG">GG</option>
      </select>
      <input name="preco"  type="number" step="any" id="preço" placeholder="Preço da camisa" required>

      <textarea name="desc" id="descricaoCamisa" placeholder="Descrição da camisa" required></textarea>
      <button type="submit">Adicionar Camisa</button>
    </form>

  </div>
</body>

</html>