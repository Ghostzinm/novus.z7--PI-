<?php
session_start();
include 'config.php';

$id_usuario = $_SESSION['usuario']['id'] ?? null;
if (!$id_usuario) {
    die("Usuário não está logado.");
}

if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) === 0) {
    die("Carrinho vazio.");
}

try {
    $conn->beginTransaction();

    foreach ($_SESSION['carrinho'] as $item) {
        $preco_total = $item['preco'] * $item['quantidade'];

        // Cria um pedido por produto
        $sql = "INSERT INTO tb_pedidos (id_usuario, id_produto, quantidade, preco_total, status, data_pedido)
                VALUES (:id_usuario, :id_produto, :quantidade, :preco_total, 'Pendente', NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $id_usuario,
            ':id_produto' => $item['id'],
            ':quantidade' => $item['quantidade'],
            ':preco_total' => $preco_total
        ]);

        // Atualiza estoque
        $updateEstoque = "UPDATE tb_estoque SET quantidade_disponivel = quantidade_disponivel - :qtd WHERE id_produto = :id";
        $stmt2 = $conn->prepare($updateEstoque);
        $stmt2->execute([
            ':qtd' => $item['quantidade'],
            ':id' => $item['id']
        ]);
    }

    $conn->commit();

    // Limpa carrinho
    unset($_SESSION['carrinho']);

    echo "✅ Pedido realizado com sucesso!";

} catch (Exception $e) {
    $conn->rollBack();
    echo "Erro ao salvar pedido: " . $e->getMessage();
}
?>
<?php
header('Location: perfil.php');
exit;


?>