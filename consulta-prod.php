<?php 


// Configuração e conexão com banco dentro do index ou include externo
$dsn = 'mysql:dbname=db_novus;host=127.0.0.1';
$usuario = 'root';
$senha = '';

try {
    $conn = new PDO($dsn, $usuario, $senha);


    $script = "SELECT * FROM tb_produtos";
    $resultado = $conn->query($script)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    $resultado = [];
}
?>

