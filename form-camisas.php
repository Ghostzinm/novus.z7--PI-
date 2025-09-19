<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "db_novus";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão do banco: " . $conexao->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $conexao->real_escape_string($_POST['nome']);
    $tamanho_tipo = $conexao->real_escape_string($_POST['tipo']); // tipo da camisa
    $tamanho_camisa = $conexao->real_escape_string($_POST['tamanho']); // tamanho da camisa
    $preco = $conexao->real_escape_string($_POST['preco']);
    $descricao = $conexao->real_escape_string($_POST['desc']);

    // Pasta de upload
    $pasta_upload = "./uploads/";

    // Array para armazenar os caminhos das imagens
    $imagens = [];

    if (isset($_FILES['imagem'])) {     
        $arquivos = $_FILES['imagem'];
        $total = count($arquivos['name']);

        for ($i = 0; $i < $total; $i++) {
            if ($arquivos['error'][$i] == 0) {
                $extensao = pathinfo($arquivos['name'][$i], PATHINFO_EXTENSION);
                $novo_nome = uniqid() . "." . $extensao;
                $caminho_upload = $pasta_upload . $novo_nome;

                if (move_uploaded_file($arquivos['tmp_name'][$i], $caminho_upload)) {
                    $imagens[] = $caminho_upload;
                }
            }
        }
    }

    // Preencher até 5 imagens, se tiver menos, preencher com NULL
    for ($i = count($imagens); $i < 5; $i++) {
        $imagens[$i] = null;
    }

    // Insert no banco
    $stmt = $conexao->prepare("INSERT INTO tb_produtos (nome, tipo, preco, tamanho, img, img2, img3, img4, img5, descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "ssds sssss",
        $nome,
        $tamanho_tipo,
        $preco,
        $tamanho_camisa,
        $imagens[0],
        $imagens[1],
        $imagens[2],
        $imagens[3],
        $imagens[4],
        $descricao
    );

    if ($stmt->execute()) {
        echo "<h1>Camisa cadastrada com sucesso!</h1>";
        echo "<a href='./form-camisas.php'>Cadastrar outra camisa</a>";
    } else {
        echo "Erro ao cadastrar camisa: " . $stmt->error;
    }

    $stmt->close();
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Upload de Camisas - novus.z7</title>
  <link rel="stylesheet" href="./css/adm.css">
</head>

<body>
  <div class="container">
    <h1>Upload de Camisas - novus.z7 🕸️</h1>

    <form action="./form-camisas.php" method="post" id="uploadForm" enctyp
 