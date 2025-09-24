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

if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
    echo "<h1>Arquivo recebido com sucesso.</h1>";
    $nome_camisa = $conexao->real_escape_string($_POST['nomeCamisa']);
    $tipo = $conexao->real_escape_string($_POST['tipo']);
    $tamanho = $conexao->real_escape_string($_POST['tamanho']);
    $preco = $conexao->real_escape_string($_POST['preco']);
    $desc = $conexao->real_escape_string($_POST['desc']);
    $arquivo_tmp = $_FILES['imagem']["tmp_name"];
    $nome_original = $_FILES['imagem']['name'];

    $extensao = pathinfo($nome_original, PATHINFO_EXTENSION);
    $novo_nome = uniqid() . "." . $extensao;

    $caminho_upload = "./img/roupas/" . $novo_nome;

    if (move_uploaded_file($arquivo_tmp, $caminho_upload)) {
        $sql = "INSERT INTO tb_produtos (nome,tipo, preco, tamanho, img, descricao) 
                VALUES ('$nome_camisa', '$tipo', '$preco', '$tamanho', '$novo_nome', '$desc')";

        if ($conexao->query($sql) === TRUE) {
            echo "<h1>Foto cadastrada com sucesso</h1>";
            echo "<p>Nome da camisa: {$nome_camisa}</p>";
            echo "<p>Nome do arquivo: {$novo_nome}</p>";
            echo "<a href='./index.php'>Cadastrar outra foto</a>";
        } else {
            echo "Erro ao salvar a foto: " . $conexao->error;
        }
    } else {
        echo "Erro ao mover o arquivo para a pasta de uploads.";
    }
} else {
    echo "Nenhum arquivo enviado.";
}

$conexao->close();
?>
