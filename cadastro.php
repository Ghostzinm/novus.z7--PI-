
<?php 

$nome = '';
$email = '';
$senha = '';
$cSenha = '';

if (isset($_GET['id']) && !empty('id')) {

    $id = $_GET['id'];
    $dsn = 'mysql:dbname=db_forms;host=127.0.0.1';
    $usuario = 'root';
    $senha = '';

    $conn = new PDO($dsn, $usuario, $senha);

    $scriptSelect = "SELECT * FROM tb_cadastro WHERE id = $id";

    $dadosSelect = $conn->query($scriptSelect)->fetch();

    $nome = $dadosSelect["nome"];
    $telefone = $dadosSelect["telefone"];
    $usuario = $dadosSelect["usuario"];
    $senha = $dadosSelect["senha"];

};


?>

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
        <form action="./form-cadastrar.php" method="POST">
          <h1>Crie sua conta</h1>
          <div class="social-icons">
            <a href="#" class="icon"><i class="bi bi-google"></i></a>
            <a href="#" class="icon"><i class="bi bi-facebook"></i></i></a>
            <a href="#" class="icon"><i class="bi bi-apple"></i></a>
          </div>
          <span>ou use seu email para se cadastrar</span>
          <input <?= $nome ?> name="nome" type="text" id="nome-cadastro" placeholder="Nome" required>
          <input <?= $email ?> name="email" type="email" id="email-cadastro" placeholder="Email" required>
          <input name="telefone" type="text" id="telefone-cadastro" placeholder="Telefone" required >
          <input <?= $senha ?> name="senha" type="password" id="senha-cadastro" placeholder="Senha" required >
          <input <?= $cSenha ?> name="cSenha" type="password" id="confirmar-senha" placeholder="Confirme sua senha" required >
          <button type="submit">Cadastrar</button>
        </form>
      </main>

      <!-- Login -->
      <main class="form-container sign-in">
        <form action="./form-login.php" method="POST">
          <h1>Entrar</h1>
          <div class="social-icons">
            <a href="#" class="icon"><i class="bi bi-google"></i></a>
            <a href="#" class="icon"><i class="bi bi-facebook"></i></i></a>
            <a href="#" class="icon"><i class="bi bi-apple"></i></a>
          </div>
          <span>ou use seu email</span>
          <input type="email" name="email" id="email-login" placeholder="Email" required>
          <input type="password" name="senha" id="senha-login" placeholder="Senha" required>
          <div class="remember-me">
            <label class="checkbox-wrapper">
              <input type="checkbox" id="lembrar" />
              <div class="checkmark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path d="M20 6L9 17L4 12" stroke-width="3"></path>
                </svg>
              </div>
              <span class="label">Lembrar de mim</span>
            </label>
          </div>
          <a href="#">Esqueceu sua senha?</a>
          <button type="submit">Entrar</button>
        </form>
      </main>

      <!-- Painel de alternância -->
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <h1>Bem-vindo de volta!</h1>
            <p>Entre com seus dados para continuar</p>
            <button class="hidden" id="login">Entrar</button>
          </div>
          <div class="toggle-panel toggle-right">
            <h1>Olá, visitante!</h1>
            <p>Cadastre-se para acessar todos os recursos</p>
            <button class="hidden" id="register">Cadastrar</button>
          </div>
        </div>
      </div>
    </div>

  </section>

  <script> 
    const tel = document.getElementById('telefone-cadastro');

    tel.addEventListener('input', function (e) {
      let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
      e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
  </script>

  <script src="./js/cadastro.js"></script>

  <?php include('./templates/footer.php'); ?>