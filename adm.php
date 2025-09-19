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

    <form action="./form-camisas.php" method="post" id="uploadForm">
      <input type="file" id="imgInput" accept="image/*" name="imagem" required>
      <input name="nome" type="text" id="nomeCamisa" placeholder="Nome da camisa" required>
      <select name="tamanho" id="tamanhoCamisa" required>
        <option value="premium">Premium</option>
        <option value="comum">Comum</option>
      </select>
      <input name="preco" type="number" id="preço" placeholder="Preço da camisa" required>

      <textarea name="desc" id="descricaoCamisa" placeholder="Descrição da camisa" required></textarea>
      <button type="submit">Adicionar Camisa</button>
    </form>

  </div>
</body>

</html>