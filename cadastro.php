<?php

$nome = '';
$email = '';
$senha = '';
$cSenha = '';
$telefone = '';

if (isset($_GET['id']) && !empty('id')) {

  include('./config.php');
  $scriptSelect = "SELECT * FROM tb_cadastro WHERE id = $id";

  $dadosSelect = $conn->query($scriptSelect)->fetch();

  $nome = $dadosSelect["nome"];
  $telefone = $dadosSelect["telefone"];
  $usuario = $dadosSelect["usuario"];
  $senha = $dadosSelect["senha"];
};



$erros = [];

?>
<script>
  let campoComErro = '';
  <?php
  if (!empty($erros)) {
    if (in_array("O nome é obrigatório.", $erros) || in_array("O nome deve ter pelo menos 2 letras.", $erros) || in_array("O nome deve conter apenas letras e espaços.", $erros)) {
      echo "campoComErro = 'nome-cadastro';";
    } elseif (in_array("O email é obrigatório.", $erros) || in_array("O email informado é inválido.", $erros)) {
      echo "campoComErro = 'email-cadastro';";
    } elseif (in_array("A senha é obrigatória.", $erros) || in_array("A senha deve ter pelo menos 8 caracteres.", $erros) || in_array("A senha deve conter letras maiúsculas, minúsculas, números e caracteres especiais.", $erros)) {
      echo "campoComErro = 'senha-cadastro';";
    } elseif (in_array("As senhas não coincidem.", $erros)) {
      echo "campoComErro = 'confirmar-senha';";
    } elseif (in_array("O telefone é obrigatório.", $erros) || in_array("O telefone deve conter apenas números (entre 8 e 15 dígitos).", $erros)) {
      echo "campoComErro = 'telefone-cadastro';";
    }
  }
  ?>
  if (campoComErro)
    document.getElementById("<?php echo $campoComErro; ?>").focus();
</script>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/cadastro.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="./css/footer.css">
  <title>Login | novus.z7</title>
</head>

<body>
  <header class="cabecalho">
    <a href="./index.php"><i class="bi bi-box-arrow-in-left"></i></a>
  </header>

  <section class="container2">
    <div class="container" id="container">
      <!-- Cadastro -->
      <main class="form-container sign-up">
        <form action="./form-cadastrar.php" id="form-cadastro" method="POST">
          <h1>Crie sua conta</h1>
         
          <span>ou use seu email para se cadastrar</span>
          <input <?= $nome ?> name="nome" type="text" id="nome-cadastro" placeholder="Nome" required>
          <input <?= $email ?> name="email" type="email" id="email-cadastro" placeholder="Email" required>
          <input <?= $telefone ?> name="telefone" type="tel" id="telefone-cadastro" placeholder="telefone" required>
          <!-- input com botao para ver a -->
          <div class="input-with-toggle">
            <input name="senha" id="senha-cadastro" type="password" placeholder="Senha" required>
            <button type="button" class="toggle-password" aria-label="Mostrar senha" data-target="senha-cadastro">
              <i class="bi bi-eye"></i>
            </button>
          </div>

          <div class="input-with-toggle">
            <input name="cSenha" id="confirmar-senha" type="password" placeholder="Confirme sua senha" required>
            <button type="button" class="toggle-password" aria-label="Mostrar senha" data-target="confirmar-senha">
              <i class="bi bi-eye"></i>
            </button>
          </div>


          <button class="btn-sub" type="submit">Cadastrar</button>
        </form>
      </main>

      <!-- Login -->
      <main class="form-container sign-in">
        <form action="./form-login.php" method="POST">
          <h1>Entrar</h1>
          <div class="social-icons">
          
          </div>
          <span>ou use seu email</span>
          <input type="email" name="email" id="email-login" placeholder="Email" required>
          <div class="input-with-toggle">
            <input name="senha" id="senha-entrar" type="password" placeholder="Senha" required>
            <button type="button" class="toggle-password" aria-label="Mostrar senha" data-target="senha-entrar">
              <i class="bi bi-eye"></i>
            </button>
          </div>
          <div class="remember-me">
            <label class="checkbox-wrapper">
              <input type="checkbox" id="lembrar" />
              <div class="checkmark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path d="M20 6L9 17L4 12" stroke-width="3"></path>
                </svg>
              </div>
              
            </label>
          </div>
        
        

          <button class="btn-sub" type="submit">Entrar</button>
        </form>
      </main>

      <!-- Painel de alternância -->
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <h1>Bem-vindo de volta!</h1>
            <p>Entre com seus dados para continuar</p>
            <button class="hidden btn-sub" id="login">Entrar</button>
          </div>
          <div class="toggle-panel toggle-right">
            <h1>Olá, visitante!</h1>
            <p>Cadastre-se para acessar todos os recursos</p>
            <button class="hidden btn-sub" id="register">Cadastrar</button>
          </div>
        </div>
      </div>
    </div>

  </section>

  <script>
    const tel = document.getElementById('telefone-cadastro');

    tel.addEventListener('input', function(e) {
      let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
      e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
  </script>

<script src="./js/validacao.js"></script>
  <script src="./js/cadastro.js"></script>
  <script src="./js/verSenha.js"></script>
  <script src="./js/recuperarSenha.js" ></script>

  <?php include('./templates/footer.php'); ?>