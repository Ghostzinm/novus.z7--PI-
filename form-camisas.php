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
    $tipo = $conexao->real_escape_string($_POST['tipo']);
    $preco = $conexao->real_escape_string($_POST['preco']);
    $tamanho = $conexao->real_escape_string($_POST['tamanho']);
    $descricao = $conexao->real_escape_string($_POST['descricao']);

    // Função para fazer upload de cada imagem
    function uploadImagem($campo, $pasta = "./uploads/") {
        if (isset($_FILES[$campo]) && $_FILES[$campo]["error"] == 0) {
            $arquivo_tmp = $_FILES[$campo]["tmp_name"];
            $nome_original = $_FILES[$campo]["name"];
            $extensao = pathinfo($nome_original, PATHINFO_EXTENSION);
            $novo_nome = uniqid() . "." . $extensao;
            $caminho_upload = $pasta . $novo_nome;

            if (move_uploaded_file($arquivo_tmp, $caminho_upload)) {
                return $caminho_upload;
            }
        }
        return null; // retorna null se não enviar arquivo
    }

    // Faz upload das 5 imagens
    $img1 = uploadImagem("img");
    $img2 = uploadImagem("img2");
    $img3 = uploadImagem("img3");
    $img4 = uploadImagem("img4");
    $img5 = uploadImagem("img5");

    // Prepara o insert
    $stmt = $conexao->prepare("INSERT INTO tb_produtos (nome, tipo, preco, tamanho, img, img2, img3, img4, img5, descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsssssss", $nome, $tipo, $preco, $tamanho, $img1, $img2, $img3, $img4, $img5, $descricao);

    if ($stmt->execute()) {
        echo "<h1>Produto cadastrado com sucesso!</h1>";
        echo "<a href='./index.php'>Cadastrar outro produto</a>";
    } else {
        echo "Erro ao cadastrar produto: " . $stmt->error;
    }

    $stmt->close();
}

$conexao->close();
?>
