<?php
echo "<h1>cadastro de camisas php </h1>";

$formNome = $_POST["nome"];
$formPreco = $_POST["preco"];
$formTamanho = $_POST["tamanho"];
$formDesc = $_POST["desc"];

$dsn = 'mysql:dbname=db_novus;host=127.0.0.1';
$usuario = 'root';
$senha = '';

$conn = new PDO($dsn, $usuario, $senha);

$scriptCadastro = "INSERT INTO tb_produtos(nome, preco, tamanho, descricao)
                   VALUES (:nome, :preco, :tamanho, :descricao)";

$scriptPreparado = $conn->prepare($scriptCadastro);
$scriptPreparado->execute([
    ":nome" => $formNome,
    ":preco" => $formPreco,
    ":tamanho" => $formTamanho,
    ":descricao" => $formDesc
]);

// Pega todos os produtos para atualizar o JSON
$stmt = $conn->prepare("SELECT * FROM tb_produtos");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // <-- CORREÇÃO AQUI

// Monta o array no formato desejado
$produtosJson = ['produtos' => []];

foreach ($rows as $row) {
    $produtosJson['produtos'][] = [
        'id' => (string)$row['id'],
        'nome' => $row['nome'],
        'preco' => (float)$row['preco'],
        'descricao' => $row['descricao'],
    ];
}

// Caminho do arquivo JSON
$arquivoJson = __DIR__ . '/json/roupas.json';

// Salva o JSON
file_put_contents($arquivoJson, json_encode($produtosJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "JSON atualizado com sucesso!";
header('location:index.php');
