<?php
$logado = isset($_SESSION['usuario']);
require_once 'templates/header.php';
require_once 'config.php';


$id_usuario = $_SESSION['usuario']['id'];
$sql = "SELECT * FROM tb_enderecos WHERE id_usuario = :id_usuario LIMIT 1";
$stmt = $conn->prepare($sql); // <== aqui usa $conn
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$endereco = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$endereco) { ?>
    <body class="body-perfil">
        <section class="enderecos-perfil">
            <h2 class="titulo-perfil">📦 Meus Endereços</h2>

            <form action="form-endereco.php" method="POST" class="form-perfil">
                <div class="grupo-form-perfil">
                    <label for="cep">CEP</label>
                    <input type="text" id="cep" name="formCep" placeholder="Digite seu CEP" required>
                </div>

                <div class="grupo-form-perfil">
                    <label for="rua">Rua</label>
                    <input type="text" id="rua" name="formRua" placeholder="Ex: Av. Paulista" required>
                </div>

                <div class="grupo-form-perfil">
                    <label for="numero">Número</label>
                    <input type="text" id="numero" name="formNumero" placeholder="Ex: 123" required>
                </div>

                <div class="grupo-form-perfil">
                    <label for="complemento">Complemento</label>
                    <input type="text" id="complemento" name="formComplemento" placeholder="Ex: Apto 45" />
                </div>

                <div class="grupo-form-perfil">
                    <label for="bairro">Bairro</label>
                    <input type="text" id="bairro" name="formBairro" placeholder="Ex: Centro" required>
                </div>

                <div class="grupo-form-perfil">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="formCidade" placeholder="Ex: São Paulo" required>
                </div>

                <div class="grupo-form-perfil">
                    <label for="estado">Estado</label>
                    <input type="text" id="estado" name="formEstado" placeholder="Ex: SP" maxlength="2" required>
                </div>

                <button type="submit" class="btn-perfil">Salvar Endereço</button>
            </form>
        </section>

    <?php
} else {
    ?>
        <meta charset="UTF-8">
        <title>Perfil - novus.z7</title>
        </head>


        <div class="container-perfil">
            <!-- Cabeçalho do perfil -->
            <div class="profile-header-perfil">
                <img src="https://i.pravatar.cc/150?img=12" alt="Foto do Cliente">
                <div class="profile-info-perfil">
                    <h2><?php echo ($_SESSION['usuario']['nome']); ?></h2>
                </div>
            </div>

            <!-- Seções -->
            <div class="sections-perfil">
                <!-- Pedidos -->
                <div class="card-perfil">
                    <h3>Meus Pedidos</h3>
                    <div class="product-perfil">
                        <img src="https://via.placeholder.com/80x80.png?text=Z7" alt="Camisa">
                        <div class="product-info-perfil">
                            <h4>Camisa Ghost Z7</h4>
                            <span>R$ 159,90</span>
                        </div>
                        <div class="status-perfil">Entregue</div>
                    </div>
                    <div class="product-perfil">
                        <img src="https://via.placeholder.com/80x80.png?text=Z7" alt="Camisa">
                        <div class="product-info-perfil">
                            <h4>Camisa Oversized Black</h4>
                            <span>R$ 189,90</span>
                        </div>
                        <div class="status-perfil">A caminho</div>
                    </div>
                </div>

                <!-- Favoritos -->
                <div class="card-perfil">
                    <h3>Favoritos</h3>
                    <div class="product-perfil">
                        <img src="https://via.placeholder.com/80x80.png?text=Z7" alt="Camisa">
                        <div class="product-info-perfil">
                            <h4>Camisa Street Art</h4>
                            <span>R$ 139,90</span>
                        </div>
                    </div>
                    <div class="product-perfil">
                        <img src="https://via.placeholder.com/80x80.png?text=Z7" alt="Camisa">
                        <div class="product-info-perfil">
                            <h4>Camisa Urban Neon</h4>
                            <span>R$ 149,90</span>
                        </div>
                    </div>
                </div>

                <!-- Dados -->
                <div class="card-perfil">
                    <h3>Meus Dados</h3>
                    <p><strong>Nome:</strong> <?php echo ($_SESSION['usuario']['nome']); ?></p>
                    <p><strong>Email:</strong> <?php echo ($_SESSION['usuario']['email']); ?></p>
                    <p><strong>Telefone:</strong> (11) 99999-9999</p>
                </div>

                <!-- Endereço -->
                <div class="card-perfil">
                    <h3>Endereço</h3>
                    <p>Rua Exemplo, 123</p>
                    <p>São Paulo - SP</p>
                    <p>CEP: 00000-000</p>
                </div>
            </div>
        </div>
    </body>

    </html>

<?php };
require_once 'templates/footer.php'; ?>