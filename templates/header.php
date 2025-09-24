<?php
session_start();
$logado = isset($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Novus.z7</title>
  <link rel="icon" href="./img/logo.png" type="image/png" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/footer.css" />
  <link rel="stylesheet" href="./css/header.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
</head>

<body>
  <header class="header">
    <div class="container">
      <h1 class="logo">novus.z7</h1>

      <nav class="nav">
        <ul>
          <li><a href="./index.php">Home</a></li>
          <li><a href="#">Catálogo</a></li>
          <li><a href="./sobre.html">Sobre</a></li>
          <li><a href="#">Contato</a></li>
        </ul>
      </nav>

      <div class="header-right">
        <a href="#" class="btn-icon" title="Carrinho">
          <i class="bi bi-cart-fill"></i>
          <span class="cart-count">2</span>
        </a>

        <?php if ($logado): ?>
          <span class="welcome-msg">Olá, <?php echo htmlspecialchars($_SESSION['usuario']['nome']); ?></span>
          <a href="perfil.php" class="btn-action perfil"><i class="bi bi-person-circle"></i> Perfil</a>
          <a href="form-logout.php" class="btn-action logout"><i class="bi bi-box-arrow-right"></i> Sair</a>
        <?php else: ?>
          <a href="./cadastro.php" class="btn-action login"><i class="bi bi-person-fill"></i> Login</a>
        <?php endif; ?>
      </div>

      <div class="menu-btn" onclick="toggleMenu()" aria-label="Abrir menu">
        <i class="bi bi-list"></i>
      </div>
    </div>

    <!-- MENU MOBILE -->
    <div class="mobile-nav" id="mobileMenu">
      <a href="./index.php">Home</a>
      <a href="#">Catálogo</a>
      <a href="./sobre.html">Sobre</a>
      <a href="#">Contato</a>
      <a href="#"><i class="bi bi-cart-fill"></i> Carrinho</a>

      <?php if ($logado): ?>
        <a href="./perfil.php"><i class="bi bi-person-circle"></i> Olá, <?php echo htmlspecialchars($_SESSION['usuario']['nome']); ?></a>
        <a href="./form-logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
      <?php else: ?>
        <a href="./cadastro.php"><i class="bi bi-person-fill"></i> Login</a>
      <?php endif; ?>
    </div>

  </header>

  <script>
    function toggleMenu() {
      const menu = document.getElementById('mobileMenu');
      menu.classList.toggle('show');
    }
  </script>
</body>
</html>