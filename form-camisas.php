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
$formNomes = $_POST["nome"];
$formPrecos = $_POST["preco"];
$formTamanhos = $_POST["tamanho"];
$formDescs = $_POST["desc"];

// === Upload das imagens ===
$pastaDestino = "imagens/roupas/";

// Garantir que a pasta existe
if (!is_dir($pastaDestino)) {
    mkdir($pastaDestino, 0777, true);
}

// Percorre todos os cadastros enviados
foreach ($formNomes as $index => $nome) {
    $preco = $formPrecos[$index];
    $tamanho = $formTamanhos[$index];
    $descricao = $formDescs[$index];

    // Tratar imagem correspondente
    $imagemCaminho = "";
    if (isset($_FILES['imagem']['tmp_name'][$index]) && $_FILES['imagem']['error'][$index] === UPLOAD_ERR_OK) {
        $arquivoTmp = $_FILES['imagem']['tmp_name'][$index];
        $nomeOriginal = basename($_FILES['imagem']['name'][$index]);
        $novoNome = uniqid() . "_" . $nomeOriginal;
        $caminhoFinal = $pastaDestino . $novoNome;

        if (move_uploaded_file($arquivoTmp, $caminhoFinal)) {
            $imagemCaminho = $caminhoFinal;
        } else {
            echo "Erro ao salvar a imagem da camisa: $nome<br>";
            continue;
        }
    } else {
        echo "Erro no upload da imagem da camisa: $nome<br>";
        continue;
    }

    // === Inserção no banco de dados ===
    $scriptCadastro = "INSERT INTO tb_produtos(nome, preco, tamanho, descricao, img)
                       VALUES (:nome, :preco, :tamanho, :descricao, :img)";
    $scriptPreparado = $conn->prepare($scriptCadastro);
    $scriptPreparado->execute([
        ":nome" => $nome,
        ":preco" => $preco,
        ":tamanho" => $tamanho,
        ":descricao" => $descricao,
        ":img" => $imagemCaminho
    ]);

    echo "Camisa '$nome' cadastrada com sucesso!<br>";
}

// Redireciona após tudo
header('Location: index.php');
exit;
