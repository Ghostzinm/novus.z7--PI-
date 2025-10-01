<?php
// Conexão com o banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "db_novus";
 
$conexao = new mysqli($servidor, $usuario, $senha, $banco);
 
if ($conexao->connect_error) {
    die("Falha na conexão do banco: " . $conexao->connect_error);
}
 
if (!empty($_FILES["img1"]["name"])) {
    echo "<h1>Arquivo recebido com sucesso.</h1>";
 
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
        echo "<h1>Camisa cadastrada com sucesso</h1>";
        echo "<p>Nome da camisa: {$nome_camisa}</p>";
        echo "<a href='./index.php'>Cadastrar outra camisa</a>";
    } else {
        echo "Erro ao salvar no banco: " . $conexao->error;
    }
} else {
    echo "Nenhum arquivo enviado.";
}
 
$conexao->close();
?>
 
 