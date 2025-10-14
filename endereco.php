<?php

require_once 'config.php';
require_once 'templates/header.php';
?>

<body class="bg-light">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body p-4">
            <h3 class="text-center mb-4">Cadastro de Endereço</h3>

            <form id="enderecoForm" autocomplete="off" novalidate>
              <div class="form-floating mb-3">
                <input required type="text" class="form-control" id="cep" placeholder="Digite seu CEP" maxlength="9">
                <label for="cep">CEP</label>
                <span class="text-danger small" id="cepError"></span>
              </div>

              <div class="form-floating mb-3">
                <input required type="text" class="form-control" id="rua" placeholder="Digite sua rua">
                <label for="rua">Rua</label>
                <span class="text-danger small" id="ruaError"></span>
              </div>

              <div class="form-floating mb-3">
                <input required type="text" class="form-control" id="bairro" placeholder="Digite seu bairro">
                <label for="bairro">Bairro</label>
                <span class="text-danger small" id="bairroError"></span>
              </div>

              <div class="form-floating mb-3">
                <input required type="text" class="form-control" id="cidade" placeholder="Digite sua cidade">
                <label for="cidade">Cidade</label>
                <span class="text-danger small" id="cidadeError"></span>
              </div>

              <div class="form-floating mb-3">
                <input required type="text" class="form-control" id="estado" placeholder="Digite seu estado" maxlength="2">
                <label for="estado">Estado</label>
                <span class="text-danger small" id="estadoError"></span>
              </div>

              <div class="form-floating mb-3">
                <input required type="number" class="form-control" id="numero" placeholder="Número da casa" min="1">
                <label for="numero">Número</label>
                <span class="text-danger small" id="numeroError"></span>
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

</body>
<script>
const cep = document.getElementById('cep');
const rua = document.getElementById('rua');
const bairro = document.getElementById('bairro');
const cidade = document.getElementById('cidade');
const estado = document.getElementById('estado');
const numero = document.getElementById('numero');
const complemento = document.getElementById('complemento');
const form = document.getElementById('enderecoForm');

// Error spans
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

// Busca CEP
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

// Validações extras
function validarCep() {
    const cepValue = cep.value.replace(/\D/g, '');
    if (cepValue.length !== 8) {
        cepError.textContent = 'CEP deve conter 8 dígitos.';
        cep.focus();
        return false;
    }
    return true;
}

function validarRua() {
    const ruaValue = rua.value.trim();
    if (ruaValue.length < 3) {
        ruaError.textContent = 'Rua deve ter pelo menos 3 caracteres.';
        rua.focus();
        return false;
    }
    return true;
}

function validarBairro() {
    const bairroValue = bairro.value.trim();
    if (bairroValue.length < 3) {
        bairroError.textContent = 'Bairro deve ter pelo menos 3 caracteres.';
        bairro.focus();
        return false;
    }
    return true;
}

function validarCidade() {
    const cidadeValue = cidade.value.trim();
    if (cidadeValue.length < 2) {
        cidadeError.textContent = 'Cidade deve ter pelo menos 2 caracteres.';
        cidade.focus();
        return false;
    }
    return true;
}

function validarEstado() {
    const estadoValue = estado.value.trim().toUpperCase();
    const estadosValidos = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'];
    if (!estadosValidos.includes(estadoValue)) {
        estadoError.textContent = 'Estado inválido. Use a sigla UF.';
        estado.focus();
        return false;
    }
    return true;
}

function validarNumero() {
    const numeroValue = numero.value.trim();
    if (numeroValue === '' || isNaN(numeroValue) || parseInt(numeroValue) <= 0) {
        numeroError.textContent = 'Por favor, preencha o campo Número com um valor válido.';
        numero.focus();
        return false;
    }
    return true;
}

form.addEventListener('submit', function(e) {
    clearErrors();
    if (
        !validarCep() ||
        !validarRua() ||
        !validarBairro() ||
        !validarCidade() ||
        !validarEstado() ||
        !validarNumero()
    ) {
        e.preventDefault();
    }
});
</script>
</html>
