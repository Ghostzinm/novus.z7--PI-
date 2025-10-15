
<?php 
$logado = isset($_SESSION['usuario']);
require_once 'templates/header.php';
require_once 'config.php';

$formCep = $_POST['formCep'];
$formRua = $_POST['formRua'];
$formNumero = $_POST['formNumero'];
$formComplemento = $_POST['formComplemento'];
$formBairro = $_POST['formBairro'];
$formCidade = $_POST['formCidade'];
$formEstado = $_POST['formEstado'];

$id_usuario = $_SESSION['usuario']['id'];
$sql = "INSERT INTO tb_enderecos (id_usuario, cep, rua, numero, complemento, bairro, cidade, estado) 
        VALUES (:id_usuario, :cep, :rua, :numero, :complemento, :bairro, :cidade, :estado)";
$stmt = $conn->prepare($sql); // <== aqui usa $conn
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->bindParam(':cep', $formCep, PDO::PARAM_STR);
$stmt->bindParam(':rua', $formRua, PDO::PARAM_STR);
$stmt->bindParam(':numero', $formNumero, PDO::PARAM_STR);
$stmt->bindParam(':complemento', $formComplemento, PDO::PARAM_STR);
$stmt->bindParam(':bairro', $formBairro, PDO::PARAM_STR);
$stmt->bindParam(':cidade', $formCidade, PDO::PARAM_STR);
$stmt->bindParam(':estado', $formEstado, PDO::PARAM_STR);
$stmt->execute();






header('Location: perfil.php');
exit;



