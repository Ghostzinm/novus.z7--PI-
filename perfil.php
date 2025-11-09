<?php

$logado = isset($_SESSION['usuario']);
require_once 'config.php';
require_once 'templates/header.php';

if (!$logado) {
  header('Location: cadastro.php');
  exit;
}

// Busca até 3 endereços do usuário
$id_usuario = $_SESSION['usuario']['id'] ?? null;

$sql = "SELECT * FROM tb_enderecos WHERE id_usuario = :id_usuario LIMIT 3";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$enderecos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Busca dados do usuário
$sqlUser = "SELECT * FROM tb_cadastro WHERE id = :id_usuario";
$stmtUser = $conn->prepare($sqlUser);
$stmtUser->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmtUser->execute();
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

// Busca favoritos
$stmt = $conn->prepare("
    SELECT p.* 
    FROM tb_produtos p
    JOIN tb_favoritos f ON p.id = f.id_produto
    WHERE f.id_usuario = ?
");
$stmt->execute([$id_usuario]);
$produtosFavoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Busca pedidos
$sql = "SELECT p.id, pr.nome, p.quantidade, p.preco_total, p.status, p.data_pedido
        FROM tb_pedidos p
        JOIN tb_produtos pr ON pr.id = p.id_produto
        WHERE p.id_usuario = ?
        ORDER BY p.data_pedido DESC";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_usuario]);
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Meu Perfil</title>

  <style>
    /* Container principal */
    .perfil-container {
      max-width: 900px;
      margin: 0 auto;
      padding: 20px;
      font-family: Arial, sans-serif;
    }

    .perfil-section {
      margin-bottom: 30px;
    }

    .perfil-header {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 30px;
    }

    .perfil-header img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
    }

    /* Layout dos endereços */
    .enderecos-container {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .endereco-card {
      flex: 1;
      min-width: 250px;
      background-color: #f7f7f7;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: left;
      position: relative;
    }

    .endereco-card button {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
      position: absolute;
      bottom: 15px;
      right: 15px;
    }

    .endereco-card button:hover {
      background-color: #0056b3;
    }

    a {
      color: #007bff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    /* Mensagem de limite */
    .limite-msg {
      background-color: #111;
      color: #f5f5f5;
      border: 1px solid #333;
      padding: 12px 18px;
      border-radius: 10px;
      font-weight: 600;
      text-align: center;
      margin: 15px 0;
      box-shadow: 0 0 10px rgba(255,255,255,0.1);
    }

    /* Botão desativado */
    .btn-disabled {
      color: gray !important;
      pointer-events: none;
      opacity: 0.6;
      cursor: not-allowed;
    }
  </style>
</head>

<body>
  <div class="perfil-container">

    <!-- Header -->
    <div class="perfil-header">
      <a href="./alterPerfil.php"><i class="count bi bi-pencil-fill"></i></a>
      <img src="./img/avatar/defelaut.jpg" alt="Avatar">
      <div>
        <h1><?= htmlspecialchars($_SESSION['usuario']['nome']) ?></h1>
        <p><?= htmlspecialchars($_SESSION['usuario']['email']) ?></p>
      </div>
    </div>

    <!-- Pedidos -->
    <div class="perfil-section">
      <h2>📦 Meus Pedidos</h2>
      <?php if (empty($pedidos)): ?>
        <p>Você ainda não fez nenhum pedido.</p>
      <?php else: ?>
        <ul>
          <?php foreach ($pedidos as $pedido): ?>
            <li>
              <?= htmlspecialchars($pedido['nome']) ?> -
              R$ <?= number_format($pedido['preco_total'], 2, ',', '.') ?> -
              <strong>
                <?php if ($pedido['status'] === 'Entregue'): ?>
                  ✔ Entregue
                <?php elseif ($pedido['status'] === 'A caminho'): ?>
                  🚚 A caminho
                <?php else: ?>
                  ⏳ <?= htmlspecialchars($pedido['status']) ?>
                <?php endif; ?>
              </strong>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>

    <!-- Favoritos -->
    <div class="perfil-section">
      <h2>❤️ Meus Favoritos</h2>
      <?php if (!empty($produtosFavoritos)): ?>
        <ul>
          <?php
          $total = min(count($produtosFavoritos), 3);
          for ($i = 0; $i < $total; $i++):
            $produto = $produtosFavoritos[$i];
          ?>
            <li>
              <?= htmlspecialchars($produto['nome']) ?> -
              R$ <?= number_format($produto['preco'], 2, ',', '.') ?> -
              <strong>❤️ Favoritado</strong>
            </li>
          <?php endfor; ?>
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
      <p><strong>Telefone:</strong> <?= htmlspecialchars($user['telefone'] ?? 'Não informado') ?></p>
    </div>

<!-- Endereços -->
<div class="perfil-section">
  <h2>🏠 Meus Endereços</h2>

  <a href="#" id="addEnderecoBtn">
    <i class="bungas bi bi-plus"></i> Adicionar novo endereço
  </a>

  <div id="limiteMsg" class="limite-msg" style="display: none;">
    ⚠️ Limite de 3 endereços cadastrados.
  </div>

  <?php if (!empty($enderecos)): ?>
    <div class="enderecos-container">
      <?php foreach ($enderecos as $endereco): ?>
        <div class="endereco-card">
          <p><strong><?= htmlspecialchars($endereco['rua']) ?></strong>, <?= htmlspecialchars($endereco['numero']) ?></p>
          <p><?= htmlspecialchars($endereco['cidade']) ?> - <?= htmlspecialchars($endereco['estado']) ?></p>
          <p>CEP: <?= htmlspecialchars($endereco['cep']) ?></p>
          <form action="editar_endereco.php" method="get">
            <input type="hidden" name="id" value="<?= $endereco['id'] ?>">
            <button type="submit">Editar</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>Nenhum endereço cadastrado.</p>
  <?php endif; ?>
</div>

<script>
  document.getElementById('addEnderecoBtn').addEventListener('click', function(e) {
    e.preventDefault();

    const totalEnderecos = <?= count($enderecos) ?>;
    if (totalEnderecos >= 3) {
      const msg = document.getElementById('limiteMsg');
      msg.style.display = 'block';

      // Some automaticamente depois de 3 segundos
      setTimeout(() => {
        msg.style.display = 'none';
      }, 3000);
    } else {
      // Redireciona normalmente para o cadastro de endereço
      window.location.href = './endereco.php';
    }
  });
</script>



