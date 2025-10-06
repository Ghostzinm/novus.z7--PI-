<?php
require('config.php');
session_start();

$formEmail = $_POST["email"];
$formSenha = $_POST["senha"];

// Busca usuário pelo email
$scripEmail = $conn->prepare("SELECT * FROM tb_cadastro WHERE email = :email");
$scripEmail->bindParam(':email', $formEmail);
$scripEmail->execute();

$usuario = $scripEmail->fetch(PDO::FETCH_ASSOC);

if ($usuario && $formSenha === $usuario['senha']) {  
    $_SESSION['usuario'] = [
        'id' => $usuario['id'],
        'nome' => $usuario['nome'],
        'email' => $usuario['email'],
        'telefone' => $usuario['telefone'],
        'adm' => $usuario['adm']
    ];
    header('location:index.php');
    exit;
} else {
    // === Tela de erro estilizada ===
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Erro de Login</title>
        <style>
            body {
                background-color: #0d0d0d;
                color: #fff;
                font-family: 'Segoe UI', Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .erro-container {
                background: #1a1a1a;
                padding: 40px 60px;
                border-radius: 16px;
                box-shadow: 0 0 20px rgba(0,0,0,0.5);
                text-align: center;
                max-width: 400px;
                width: 100%;
            }
            h1 {
                color: #ff4444;
                font-size: 1.8rem;
                margin-bottom: 20px;
            }
            p {
                color: #ccc;
                margin-bottom: 30px;
            }
            a {
                display: inline-block;
                background: #4CAF50;
                color: white;
                text-decoration: none;
                padding: 12px 24px;
                border-radius: 8px;
                font-weight: bold;
                transition: 0.3s;
            }
            a:hover {
                background: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="erro-container">
            <h1>❌ Erro ao entrar</h1>
            <p>Email ou senha incorretos.<br>Tente novamente.</p>
            <a href="cadastro.php">Voltar ao Login</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>
