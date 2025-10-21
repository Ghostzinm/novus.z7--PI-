<?php
$logado = isset($_SESSION['usuario']);
require_once 'config.php';
require_once 'templates/header.php';

// Busca endereço do usuário
$id_usuario = $_SESSION['usuario']['id'] ?? null;

$sql = "SELECT * FROM tb_enderecos WHERE id_usuario = :id_usuario LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$endereco = $stmt->fetch(PDO::FETCH_ASSOC);

$sqlUser = "SELECT * FROM tb_cadastro WHERE id = :id_usuario";
$stmtUser = $conn->prepare($sqlUser);
$stmtUser->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmtUser->execute();
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

if (!$logado) {
  header('Location: cadastro.php');
  exit;
}



$stmt = $conn->prepare("
    SELECT p.* 
    FROM tb_produtos p
    JOIN tb_favoritos f ON p.id = f.id_produto
    WHERE f.id_usuario = ?
");
$stmt->execute([$_SESSION['usuario']['id']]);
$produtosFavoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Meu Perfil</title>
  <style>
    body {
      font-family: "Segoe UI", Arial, sans-serif;
      background: #121212;
      color: #eee;
      margin: 0;
      padding: 0;
    }
  </style>
</head>

<body>
  <div class="perfil-container ">

    <!-- Header -->
    <div class="perfil-header">

      <a href="./alterPerfil.php"><i class=" count bi bi-pencil-fill"></i></a>
      <img src="./img/roupas/68e65e6bb6fa2.jpg" alt="Avatar">

      <div>
        <h1><?= htmlspecialchars($_SESSION['usuario']['nome']) ?></h1>
        <p><?= htmlspecialchars($_SESSION['usuario']['email']) ?></p>
      </div>
    </div>

    <!-- Pedidos -->
    <div class="perfil-section">
      <h2>📦 Meus Pedidos</h2>
      <ul>
        <li>Camisa Ghost Z7 - R$ 159,90 - <strong>✔ Entregue</strong></li>
        <li>Camisa Oversized Black - R$ 189,90 - <strong>🚚 A caminho</strong></li>
      </ul>
    </div>

    <!-- Favoritos -->
    <div class="perfil-section">
      <h2>❤️ Meus Favoritos</h2>
      <?php if (!empty($produtosFavoritos)): ?>
        <ul>
          <?php foreach ($produtosFavoritos as $produto): ?>
            <li>
              <?= htmlspecialchars($produto['nome']) ?> -
              R$ <?= number_format($produto['preco'], 2, ',', '.') ?> -
              <strong>❤️ Favoritado</strong>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p>Você ainda não favoritou nenhum produto.</p>
      <?php endif; ?>
    </div>

    <!-- Dados -->
    <div class="perfil-section">
      <h2>👤 Meus Dados</h2>
      <p><strong>Nome:</strong> <?= htmlspecialchars($_SESSION['usuario']['nome']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['usuario']['email']) ?></p>
      <p><strong>Telefone:</strong><?= htmlspecialchars($user['telefone']) ?></p>
    </div>

    <!-- Endereço -->
    <div class="perfil-section">
      <h2>🏠 Endereço</h2>
      <?php if ($endereco): ?>
        <p><?= htmlspecialchars($endereco['rua']) ?>, <?= htmlspecialchars($endereco['numero']) ?></p>
        <p><?= htmlspecialchars($endereco['cidade']) ?> - <?= htmlspecialchars($endereco['estado']) ?></p>
        <p>CEP: <?= htmlspecialchars($endereco['cep']) ?></p>
      <?php else: ?>
        <p>Nenhum endereço cadastrado.</p>
        <a href="./endereco.php" style="color:#4CAF50; text-decoration:none;">Cadastrar Endereço</a>
      <?php endif; ?>
    </div>

    <!-- Logout -->


  </div>
</body>

</html>

<?php require_once 'templates/footer.php'; ?>