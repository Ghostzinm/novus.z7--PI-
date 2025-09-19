<?php 
$logado = isset($_SESSION['usuario']);
require_once 'templates/header.php';

?>
<body>
<section class="perfil-section">
        <div class="container mt-5">
            <?php if ($logado): ?>
                <h2>Perfil do Usuário</h2>
                
                <p><strong>Nome:</strong> 
                    <?php echo htmlspecialchars($_SESSION['usuario']['nome']); ?>
                </p>

                <p><strong>Email:</strong> 
                    <?php echo htmlspecialchars($_SESSION['usuario']['email']); ?>
                </p>

            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    Você não está logado. Por favor, <a href="cadastro.php">faça login</a> para ver seu perfil.
                </div>
            <?php endif; ?>
        </div>
    </section>
    
    <?php require_once 'templates/footer.php'; ?>
