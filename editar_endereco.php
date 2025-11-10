<?php
require_once 'config.php';
require_once 'templates/header.php';


$logado = isset($_SESSION['usuario']);

if (!$logado) {
  header('Location: login.php');
  exit;
}

$id_usuario = $_SESSION['usuario']['id'];
$id_endereco = $_GET['id'] ?? null;

// Busca o endereço atual
if ($id_endereco) {
  $sql = "SELECT * FROM tb_enderecos WHERE id = :id AND id_usuario = :id_usuario LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id_endereco, PDO::PARAM_INT);
  $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
  $stmt->execute();
  $endereco = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$endereco) {
    echo "<p class='text-center mt-5 text-danger'>Endereço não encontrado.</p>";
    exit;
  }
} else {
  echo "<p class='text-center mt-5 text-danger'>ID do endereço inválido.</p>";
  exit;
}
?>

<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-4">
            <h3 class="text-center mb-4">Editar Endereço</h3>

            <form action="salvar_edicao_endereco.php" method="post" id="enderecoForm" autocomplete="off" novalidate>
              <input type="hidden" name="id" value="<?= htmlspecialchars($endereco['id']) ?>">

              <div class="form-floating mb-3">
                <input required type="text" name="formCep" class="form-control" id="cep" value="<?= htmlspecialchars($endereco['cep']) ?>" placeholder="Digite seu CEP" maxlength="9">
                <label for="cep">CEP</label>
                <span class="text-danger small" id="cepError"></span>
              </div>

              <div class="form-floating mb-3">
                <input required type="text" name="formRua" class="form-control" id="rua" value="<?= htmlspecialchars($endereco['rua']) ?>" placeholder="Digite sua rua">
                <label for="rua">Rua</label>
                <span class="text-danger small" id="ruaError"></span>
              </div>

              <div class="form-floating mb-3">
                <input required type="text" name="formBairro" class="form-control" id="bairro" value="<?= htmlspecialchars($endereco['bairro']) ?>" placeholder="Digite seu bairro">
                <label for="bairro">Bairro</label>
                <span class="text-danger small" id="bairroError"></span>
              </div>

              <div class="form-floating mb-3">
                <input required type="text" name="formCidade" class="form-control" id="cidade" value="<?= htmlspecialchars($endereco['cidade']) ?>" placeholder="Digite sua cidade">
                <label for="cidade">Cidade</label>
                <span class="text-danger small" id="cidadeError"></span>
              </div>

              <div class="form-floating mb-3">
                <input required type="text" name="formEstado" class="form-control" id="estado" value="<?= htmlspecialchars($endereco['estado']) ?>" placeholder="Digite seu estado" maxlength="2">
                <label for="estado">Estado</label>
                <span class="text-danger small" id="estadoError"></span>
              </div>

              <div class="form-floating mb-3">
                <input required type="number" name="formNumero" class="form-control" id="numero" value="<?= htmlspecialchars($endereco['numero']) ?>" placeholder="Número da casa" min="1">
                <label for="numero">Número</label>
                <span class="text-danger small" id="numeroError"></span>
              </div>

              <div class="form-floating mb-4">
                <input type="text" name="formComplemento" class="form-control" id="complemento" value="<?= htmlspecialchars($endereco['complemento']) ?>" placeholder="Apartamento, bloco, etc">
                <label for="complemento">Complemento</label>
              </div>

              <button type="submit" class="btn btn-primary btn-custom w-100 py-2 rounded-3">
                Salvar Alterações
              </button>

              <a href="perfil.php" class="btn btn-outline-secondary w-100 mt-3 rounded-3">Cancelar</a>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</body>

<script>
  // Mesmo JS do cadastro, pode reutilizar
  const cep = document.getElementById('cep');
  const rua = document.getElementById('rua');
  const bairro = document.getElementById('bairro');
  const cidade = document.getElementById('cidade');
  const estado = document.getElementById('estado');
  const numero = document.getElementById('numero');
  const form = document.getElementById('enderecoForm');

  const cepError = document.getElementById('cepError');
  const ruaError = document.getElementById('ruaError');
  const bairroError = document.getElementById('bairroError');
  const cidadeError = document.getElementById('cidadeError');
  const estadoError = document.getElementById('estadoError');
  const numeroError = document.getElementById('numeroError');

  function clearErrors() {
    cepError.textContent = '';
    ruaError.textContent = '';
    bairroError.textContent = '';
    cidadeError.textContent = '';
    estadoError.textContent = '';
    numeroError.textContent = '';
  }

  cep.addEventListener('blur', function() {
    clearErrors();
    let cepValue = this.value.replace(/\D/g, '');
    if (cepValue.length === 8) {
      fetch(`https://viacep.com.br/ws/${cepValue}/json/`)
        .then(response => response.json())
        .then(data => {
          if (!data.erro) {
            rua.value = data.logradouro;
            bairro.value = data.bairro;
            cidade.value = data.localidade;
            estado.value = data.uf;
          } else {
            cepError.textContent = 'CEP não encontrado.';
          }
        })
        .catch(() => {
          cepError.textContent = 'Erro ao buscar o CEP.';
        });
    } else if (cepValue.length > 0) {
      cepError.textContent = 'Formato de CEP inválido.';
    }
  });
</script>

</html>
