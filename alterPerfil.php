<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alterar Perfil</title>
  <link rel="stylesheet" href="./css/alterPerfil.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 
</head>
<header class="bt-alterPerfil">
  <a class="btn-alterPerfil" href="./perfil.php">voltar</a>

</header>

<style>

  body {
      background-color: #1a1a1aff;
      color: #ffffffcc;
    }

    .btn-alterPerfil{
      display: inline-block;
      margin: 20px;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
  


}
 
    .card {
      background-color: #2c2c2c;
      border-radius: 10px;
    }

    .card-header {
      background-color: #3d3d3d;
      border-bottom: none;
      border-radius: 10px 10px 0 0;
    }

    .form-label {
      color: #ffffffcc;
    }

    .form-control {
      background-color: #444444;
      border: none;
      color: #ffffffcc;
    }

    .form-control::placeholder {
      color: #bbbbbb;
    }

    .btn-primary {
      background-color: #5a5a5a;
      border: none;
    }

    .btn-primary:hover {
      background-color: #777777;
    }

</style>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header">
            <h4 class="mb-0">Alterar Perfil</h4>
          </div>
          <div class="card-body">
            <form action="form-alterperfil.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="nomeUsuario" class="form-label">Novo nome de usuário:</label>
                <input type="text" id="nomeUsuario" name="nome" class="form-control" placeholder="Digite seu novo nome" required>
              </div>

              <div class="mb-3">
                <label for="telefone" class="form-label">Atualizar telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Digite seu novo telefone" required>
              </div>

              <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    