
CREATE TABLE tb_cadastro (

CREATE TABLE tb_cadastro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE tb_produtos (
CREATE TABLE tb_produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    tamanho VARCHAR(50),
    img VARCHAR(255),
    img2 VARCHAR(255),
    img3 VARCHAR(255),
    img4 VARCHAR(255),
    img5 VARCHAR(255),
    img VARCHAR(255),
    img2 VARCHAR(255),
    img3 VARCHAR(255),
    img4 VARCHAR(255),
    img5 VARCHAR(255),
    descricao TEXT
);
CREATE TABLE tb_pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_produto INT,
    quantidade INT NOT NULL,
    preco_total DECIMAL(10,2) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pendente',
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES tb_cadastro(id),
    FOREIGN KEY (id_produto) REFERENCES tb_produtos(id)
);
CREATE TABLE tb_enderecos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    rua VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado VARCHAR(100) NOT NULL,
    cep VARCHAR(20) NOT NULL,
    pais VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES tb_cadastro(id)
);
CREATE TABLE tb_pagamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    metodo_pagamento VARCHAR(50) NOT NULL,
    status_pagamento VARCHAR(50) DEFAULT 'Pendente',
    data_pagamento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pedido) REFERENCES tb_pedidos(id)
);
CREATE TABLE tb_avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_produto INT,
    avaliacao INT CHECK (avaliacao BETWEEN 1 AND 5),
    comentario TEXT,
    data_avaliacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES tb_cadastro(id),
    FOREIGN KEY (id_produto) REFERENCES tb_produtos(id)
);
CREATE TABLE tb_favoritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_produto INT,
    data_favorito TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES tb_cadastro(id),
    FOREIGN KEY (id_produto) REFERENCES tb_produtos(id)
);
CREATE TABLE tb_carrinho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_produto INT,
    quantidade INT NOT NULL,
    data_adicionado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES tb_cadastro(id),
    FOREIGN KEY (id_produto) REFERENCES tb_produtos(id)
);
