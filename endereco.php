<?php
require_once 'config.php';
require_once 'templates/header.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Endereço</title>
  <!-- Bootstrap CSS (se já não tiver no header.php) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-4">
            <h3 class="text-center mb-4">Cadastro de Endereço</h3>

            <form>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="cep" placeholder="Digite seu CEP">
                <label for="cep">CEP</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="rua" placeholder="Digite sua rua">
                <label for="rua">Rua</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="bairro" placeholder="Digite seu bairro">
                <label for="bairro">Bairro</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="cidade" placeholder="Digite sua cidade">
                <label for="cidade">Cidade</label>
              </div>

              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="numero" placeholder="Número da casa">
                <label for="numero">Número</label>
              </div>

              <div class="form-floating mb-4">
                <input type="text" class="form-control" id="complemento" placeholder="Apartamento, bloco, etc">
                <label for="complemento">Complemento</label>
              </div>
            
             <button type="submit" class="btn btn-custom w-100 py-2 rounded-3">
                Salvar Endereço
              </button>
                
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
