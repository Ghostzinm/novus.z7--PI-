<?php
// Só processa se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Pega os dados do form
    $formNome = $_POST["nome"] ?? '';
    $formPreco = $_POST["preco"] ?? '';
    $formTamanho = $_POST["tamanho"] ?? '';
    $formDesc = $_POST["desc"] ?? '';

    // Conexão PDO
    $dsn = 'mysql:dbname=db_novus;host=127.0.0.1';
    $usuario = 'root';
    $senha = '';
    $conn = new PDO($dsn, $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Inserção no banco
    $stmt = $conn->prepare("INSERT INTO tb_produtos(nome, preco, tamanho, descricao) 
                            VALUES (:nome, :preco, :tamanho, :descricao)");
    $stmt->execute([
        ":nome" => $formNome,
        ":preco"=> $formPreco,
        ":tamanho" => $formTamanho,
        ":descricao" => $formDesc
    ]);

    // Pega todos os produtos para atualizar o JSON
    $stmt = $conn->prepare("SELECT * FROM tb_produtos");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Caminho do arquivo JSON (mesma pasta do PHP)
    $arquivoJson = __DIR__ . '/json/roupas.json';

    // Atualiza o arquivo JSON
    file_put_contents($arquivoJson, json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Redireciona para a página de administração
    header('Location: adm.html');
    exit;
}
