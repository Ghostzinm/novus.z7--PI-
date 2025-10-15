<?php
session_start();
include 'config.php';
$logado = isset($_SESSION['usuario']);

if (!$logado) {
  header('Location: cadastro.php');
  exit;
}
// Pega valor total vindo do carrinho
$valor = isset($_GET['valor']) ? floatval($_GET['valor']) : 0;

// Verifica se o usuário está logado
$id_usuario = $_SESSION['usuario']['id'] ?? null;
if (!$id_usuario) {
    die("Você precisa estar logado para acessar a página de pagamento.");
}

// Busca os endereços cadastrados do usuário
$sql = "SELECT * FROM tb_enderecos WHERE id_usuario = :id_usuario";
$stmt = $conn->prepare($sql);
$stmt->execute([':id_usuario' => $id_usuario]);
$enderecos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Pagamento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root {
      --color-bg: #0f0f0f;
      --color-bg-card: rgba(20, 20, 20, 0.7);
      --color-primary: #00ff88;
      --color-primary-dark: #00cc6a;
      --color-text: #ffffff;
      --color-text-muted: #aaaaaa;
      --color-border: rgba(255, 255, 255, 0.1);
      --shadow-neon: 0 0 15px var(--color-primary);
      --transition-default: 0.6s ease-in-out;
      --btn-color: #00ff88;
      --btn-text: #312525;
      --bg-dark: #2c2c2c;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: var(--color-bg);
      color: var(--color-text);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding: 20px;
    }

    .container {
      background-color: var(--color-bg-card);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 0 20px rgba(0, 255, 136, 0.1);
      max-width: 400px;
      width: 100%;
      border: 1px solid var(--color-border);
      backdrop-filter: blur(10px);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: var(--color-primary);
      text-shadow: var(--shadow-neon);
    }

    label {
      display: block;
      margin-bottom: 6px;
      color: var(--color-text);
      font-size: 14px;
      font-weight: 500;
    }

    input[type="text"],
    input[type="number"],
    select {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid var(--color-border);
      border-radius: 8px;
      background-color: var(--bg-dark);
      color: var(--color-text);
      font-size: 15px;
      transition: border var(--transition-default), box-shadow var(--transition-default);
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    select:focus {
      outline: none;
      border-color: var(--color-primary);
      box-shadow: 0 0 10px var(--color-primary);
    }

    input[type="submit"] {
      width: 100%;
      padding: 14px;
      background-color: var(--btn-color);
      color: var(--btn-text);
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      box-shadow: var(--shadow-neon);
      transition: background-color var(--transition-default), transform 0.2s;
    }

    input[type="submit"]:hover {
      background-color: var(--color-primary-dark);
      transform: scale(1.02);
    }

    .footer {
      text-align: center;
      margin-top: 20px;
      font-size: 13px;
      color: var(--color-text-muted);
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Pagamento Seguro</h2>

    <form action="form-carrinho.php" method="post">
      <!-- Simulação dos dados do cartão -->
      <label for="nome">Nome no Cartão</label>
      <input type="text" name="nome" id="nome" required>

      <label for="numero_cartao">Número do Cartão</label>
      <input type="text" name="numero_cartao" id="numero_cartao" maxlength="16" required>

      <label for="validade">Validade (MM/AA)</label>
      <input type="text" name="validade" id="validade" placeholder="MM/AA" required>

      <label for="cvv">CVV</label>
      <input type="number" name="cvv" id="cvv" maxlength="3" required>

      <!-- Endereço -->
      <label for="endereco_entrega">Endereço de Entrega</label>
      <select name="endereco_entrega" id="endereco_entrega" >
        <option value="">Selecione um endereço</option>
        <?php foreach ($enderecos as $end): 
          $enderecoCompleto = "{$end['rua']}, {$end['numero']}";
          if (!empty($end['complemento'])) {
              $enderecoCompleto .= " ({$end['complemento']})";
          }
          $enderecoCompleto .= " - {$end['bairro']}, {$end['cidade']}/{$end['estado']} - CEP: {$end['cep']}";
        ?>
          <option value="<?= htmlspecialchars($enderecoCompleto) ?>">
            <?= htmlspecialchars($enderecoCompleto) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <!-- Método de pagamento -->
      <label for="metodo_pagamento">Forma de Pagamento</label>
      <select name="metodo_pagamento" id="metodo_pagamento" required>
        <option value="">Selecione</option>
        <option value="Cartão de Crédito">Cartão de Crédito</option>
        <option value="Pix">Pix</option>
        <option value="Boleto">Boleto</option>
      </select>

      <!-- Valor total (opcional) -->
      <input type="hidden" name="valor" value="<?= $valor ?>">

      <input type="submit" value="Pagar Agora">
    </form>

    <div class="footer">🔒 Seus dados estão protegidos</div>
  </div>
</body>

</html>
