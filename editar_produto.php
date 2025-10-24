<?php
session_start();
require 'config.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    die("Produto não especificado!");
}

$id = (int)$_GET['id'];

// Seleciona o produto pelo ID
$stmt = $conn->prepare("SELECT * FROM tb_produtos WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado!");
}

// Atualizar produto
if (isset($_POST['update'])) {
    $nome = $_POST['nome'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];
    
    if (!empty($_FILES['img']['name'])) {
        $img = $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], "img/$img");
        $stmt = $conn->prepare("UPDATE tb_produtos SET nome=:nome, tamanho=:tamanho, preco=:preco, img=:img WHERE id=:id");
        $stmt->bindParam(':img', $img);
    } else {
        $stmt = $conn->prepare("UPDATE tb_produtos SET nome=:nome, tamanho=:tamanho, preco=:preco WHERE id=:id");
    }

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':tamanho', $tamanho);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: editar_produto.php?id=$id"); // recarrega a página
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Produto</title>
<style>
body { font-family: Arial; background:#111; color:#fff; padding:20px;}
form { max-width:400px; margin:auto; background:#222; padding:20px; border-radius:10px; }
input, select { width:100%; padding:10px; margin:10px 0; border-radius:5px; border:none; }
button { width:100%; padding:10px; border:none; border-radius:5px; background:#00aaff; color:#fff; cursor:pointer; }
img { max-width:100px; display:block; margin:auto; margin-bottom:10px; border-radius:5px; }
h2 { text-align:center; }
</style>
</head>
<body>

<h2>Editar Produto</h2>

<form method="post" enctype="multipart/form-data">
    <img src="img/<?php echo $produto['img']; ?>" alt="Imagem do Produto">
    
    <input type="text" name="nome" placeholder="Nome" value="<?php echo $produto['nome']; ?>" required>
    
    <select name="tamanho" required>
        <option value="M" <?php if($produto['tamanho']=='M') echo 'selected'; ?>>M</option>
        <option value="G" <?php if($produto['tamanho']=='G') echo 'selected'; ?>>G</option>
    </select>
    
    <input type="number" step="0.01" name="preco" placeholder="Preço" value="<?php echo $produto['preco']; ?>" required>
    
    <input type="file" name="img">
    
    <button type="submit" name="update">Salvar Alterações</button>
</form>

</body>
</html>
