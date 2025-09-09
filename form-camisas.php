<?php
echo "<h1>Cadastro de Camisas PHP</h1>";

// Carrega variáveis de ambiente
$_ENV = parse_ini_file('.env');

// Conecta ao banco de dados
$dsn = "mysql:dbname={$_ENV['BANCO']};host={$_ENV['HOST']}";
$usuario = $_ENV['USUARIO'];
$senha = $_ENV['SENHA'];
$conn = new PDO($dsn, $usuario, $senha);

// Pega os dados do formulário
$formNome = $_POST["nome"];
$formPreco = $_POST["preco"];
$formTamanho = $_POST["tamanho"];
$formDesc = $_POST["desc"];

// === Upload da imagem ===
$pastaDestino = "imagens/roupas";
$imagemCaminho = "";

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $arquivoTmp = $_FILES['imagem']['tmp_name'];
    $nomeOriginal = basename($_FILES['imagem']['name']);
    $novoNome = uniqid() . "_" . $nomeOriginal;
    $caminhoFinal = $pastaDestino . $novoNome;

    if (move_uploaded_file($arquivoTmp, $caminhoFinal)) {
        $imagemCaminho = $caminhoFinal; // Caminho da imagem a ser salvo no banco
    } else {
        echo "Erro ao salvar a imagem.";
        exit;
    }
} else {
    echo "Erro no upload da imagem.";
    exit;
}

// === Inserção no banco de dados ===
$scriptCadastro = "INSERT INTO tb_produtos(nome, preco, tamanho, descricao, img)
                   VALUES (:nome, :preco, :tamanho, :descricao, :img)";

$scriptPreparado = $conn->prepare($scriptCadastro);
$scriptPreparado->execute([
    ":nome" => $formNome,
    ":preco" => $formPreco,
    ":tamanho" => $formTamanho,
    ":descricao" => $formDesc,
    ":img" => $imagemCaminho
]);

// Redireciona para a página inicial após o cadastro
header('Location: index.php');
exit;
