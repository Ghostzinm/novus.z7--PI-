<?php
session_start();
include 'config.php';

$logado = isset($_SESSION['usuario']);
if (!$logado) {
  header('Location: cadastro.php');
  exit;
}

// Verifica se o usuário está logado
$id_usuario = $_SESSION['usuario']['id'] ?? null;
if (!$id_usuario) {
    die("Você precisa estar logado para acessar a página de pagamento.");
}

$sql = "SELECT * FROM tb_enderecos WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id_usuario]);
$enderecoUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$enderecoUsuario) {
  echo '<script>
          alert("Por favor, cadastre um endereço antes de prosseguir para o pagamento.");
          window.location.href = "endereco.php";
        </script>';
  exit;  // Certifique-se de que o script não continue após o redirecionamento
}


// Pega valor total vindo do carrinho (enviado por POST agora)
$valor = isset($_POST['valor']) ? floatval($_POST['valor']) : 0;
$pagamento = strtolower(trim($_POST['metodo_pagamento'] ?? ''));

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
  <link rel="stylesheet" href="./css/pagamento.css">
</head>

<body>
  <div class="container">
    <h2>Pagamento Seguro</h2>

    <form action="form-carrinho.php" method="post">
      <input type="hidden" name="tipo_pagamento" value="finalizar">

      <?php if ($pagamento === 'cartao') { ?>
        <!-- Dados do cartão -->
        <label for="nome">Nome no Cartão</label>
        <input type="text" name="nome" id="nome" required>

        <label for="numero_cartao">Número do Cartão</label>
        <input type="text" name="numero_cartao" id="numero_cartao" maxlength="16" required>

        <label for="validade">Validade (MM/AA)</label>
        <input type="text" name="validade" id="validade" placeholder="MM/AA" required>

        <label for="cvv">CVV</label>
        <input type="number" name="cvv" id="cvv" maxlength="3" required>

      <?php } elseif ($pagamento === 'pix') { ?>
        <p>Você escolheu pagar via PIX. Use o QR code abaixo para completar o pagamento.</p>
        <img src="img/pix-qr-code.png" alt="QR Code PIX" style="width:200px;height:200px;">

      <?php } ?>
      <!-- Endereço -->
      <label for="endereco_entrega">Endereço de Entrega</label>
      <select name="endereco_entrega" id="endereco_entrega" required>
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

      <!-- Valor total -->
      <input type="hidden" name="valor" value="<?= htmlspecialchars($valor) ?>">

      <!-- Método de pagamento (para ser reenviado para o próximo passo) -->
      <input type="hidden" name="metodo_pagamento" value="<?= htmlspecialchars($pagamento) ?>">

      <input type="submit" value="Pagar Agora">
    </form>

    <div class="footer">🔒 Seus dados estão protegidos</div>
  </div>
</body>

</html>
