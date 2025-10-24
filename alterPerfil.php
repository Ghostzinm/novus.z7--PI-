<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alterar Perfil</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #0d0d0d;
      color: #d4d4d4;
    }

    .card {
      background-color: #111;
      border: 1px solid #00ff80;
      border-radius: 12px;
    }

    .card-header {
      background-color: #00ff80;
      color: #000;
      font-weight: bold;
      text-align: center;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }

    .form-control {
      background-color: #1a1a1a;
      color: #00ff80;
      border: 1px solid #00ff80;
    }

    .form-control:focus {
      background-color: #0f0f0f;
      border-color: #00cc66;
      box-shadow: 0 0 6px #00ff80;
      color: #00ff80;
    }

    .btn-primary {
      background-color: #00ff80;
      border: none;
      color: #000;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #00cc66;
      color: #fff;
      box-shadow: 0 0 10px #00ff80;
    }
  </style>
</head>

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
    