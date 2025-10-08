<?php
// Conexão com o banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "db_novus";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    exibirMensagem("Falha na conexão do banco: " . $conexao->connect_error, false);
    exit;
}

function exibirMensagem($mensagem, $sucesso = true, $nome_camisa = null) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $sucesso ? "Sucesso" : "Erro"; ?></title>
        <style>
            body {
                background: linear-gradient(135deg, #232526 0%, #414345 100%);
                color: #fff;
                font-family: 'Segoe UI', Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                background: rgba(30,30,30,0.95);
                padding: 40px 60px;
                border-radius: 18px;
                box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37);
                text-align: center;
                max-width: 420px;
                width: 100%;
            }
            h1 {
                color: <?php echo $sucesso ? "#4CAF50" : "#ff4444"; ?>;
                font-size: 2rem;
                margin-bottom: 18px;
            }
            p {
                color: #ccc;
                margin-bottom: 24px;
                font-size: 1.1rem;
            }
            .camisa-nome {
                color: #ffd700;
                font-weight: bold;
                font-size: 1.2rem;
                margin-bottom: 18px;
            }
            a {
                display: inline-block;
                background: #4CAF50;
                color: white;
                text-decoration: none;
                padding: 12px 28px;
                border-radius: 8px;
                font-weight: bold;
                transition: 0.3s;
                font-size: 1rem;
                margin-top: 10px;
            }
            a:hover {
                background: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1><?php echo $sucesso ? "Sucesso!" : "Erro"; ?></h1>
            <p><?php echo $mensagem; ?></p>
            <?php if ($sucesso && $nome_camisa): ?>
                <div class="camisa-nome">Nome da camisa: <?php echo htmlspecialchars($nome_camisa); ?></div>
            <?php endif; ?>
            <a href="./adm.php"><?php echo $sucesso ? "Cadastrar camisa" : "Voltar"; ?></a>
             <a href="./index.php"><?php echo $sucesso ? "pagina principal" : "ir_paginapricipal"; ?></a>
        </div>
    </body>
    </html>
    <?php
}

if (!empty($_FILES["img1"]["name"])) {
    $nome_camisa = $conexao->real_escape_string($_POST['nomeCamisa']);
    $tipo = $conexao->real_escape_string($_POST['tipo']);
    $tamanho = $conexao->real_escape_string($_POST['tamanho']);
    $preco = $conexao->real_escape_string($_POST['preco']);
    $desc = $conexao->real_escape_string($_POST['desc']);

    // Função para salvar imagem
    function salvarImagem($file, $pasta) {
        if (!empty($file["name"])) {
            $extensao = pathinfo($file['name'], PATHINFO_EXTENSION);
            $novo_nome = uniqid() . "." . $extensao;
            $caminho_upload = $pasta . $novo_nome;
            if (move_uploaded_file($file['tmp_name'], $caminho_upload)) {
                return $novo_nome;
            }
        }
        return null;
    }

    $pasta_destino = "./img/roupas/";
    $img1 = salvarImagem($_FILES["img1"], $pasta_destino);
    $img2 = salvarImagem($_FILES["img2"], $pasta_destino);
    $img3 = salvarImagem($_FILES["img3"], $pasta_destino);
    $img4 = salvarImagem($_FILES["img4"], $pasta_destino);
    $img5 = salvarImagem($_FILES["img5"], $pasta_destino);

    $sql = "INSERT INTO tb_produtos (nome, tipo, preco, tamanho, img, img2, img3, img4, img5, descricao)
            VALUES ('$nome_camisa', '$tipo', '$preco', '$tamanho',
            '$img1', '$img2', '$img3', '$img4', '$img5', '$desc')";

    if ($conexao->query($sql) === TRUE) {
        exibirMensagem("Camisa cadastrada com sucesso.", true, $nome_camisa);
    } else {
        exibirMensagem("Erro ao salvar no banco: " . $conexao->error, false);
    }
} else {
    exibirMensagem("Nenhum arquivo enviado.", false);
}

$conexao->close();
?>