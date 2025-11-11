# 🕸️ Novus.z7 — Plataforma de E-commerce Streetwear

Projeto desenvolvido como um **sistema web de vendas** voltado para uma loja de camisas streetwear, com funcionalidades completas de **cadastro, login, carrinho, pedidos e administração de produtos**.  
A aplicação foi construída em **PHP**, com integração a banco de dados e suporte a sessões de usuário.

---

## 📁 Estrutura do Projeto

novus.z7--PI-/
│
├── sql
│    ├── bancoCAdastro.sql
├── classes
│    ├──favoritos.php
├── css
│    ├──adn.css
│    ├──alterPerfil.css
│    ├──cadastro.css
│    ├──carrinho.css
│    ├──contato.css
│    ├──exibir-favorito.css
│    ├──footer.css
│    ├──pagamento.css
│    ├──perfil.css
│    ├──produtos.css
│    ├──sobre.css
│    ├──style.css
│
├── fonts
│    ├──Cinzel-VariableFont_wght.ttf
├── img
│    ├──carrossel
│    ├──roupas
│
├── templates
│    ├──footer.php
│    ├──header.php
│ 
├── .env
├── .env-exemple
├── .gitattributes
├── .gitignore
│
├── index.php
├── produtos.php
├── carrinho.php
├── pedidos.php
├── perfil.php
├── adm.php
│
├── config.php
├── cadastro.php
├── form-login.php
├── form-logout.php
├── form-cadastrar.php
│
├── add-carrinho.php
├── carrinho-delete.php
├── favoritar.php
├── exibir-favorito.php
│
├── editar_produto.php
├── form-cardEditar.php
├── form-cardApagar.php
├── form-cardReativar.php
│
├── endereco.php
├── editar_endereco.php
├── salvar_edicao_endereco.php
├── excluir_endereco.php
│
├── sobre.php
└── README.md


---

## ⚙️ Principais Arquivos e Funções

### 🏠 **index.php**
Página inicial da loja — exibe os produtos e direciona para as demais páginas (detalhes, carrinho, login etc).

### 🧾 **config.php**
Arquivo central de **configuração do banco de dados**, responsável por conectar o sistema às tabelas MySQL.

### 👤 **cadastro.php / form-cadastrar.php / form-login.php / form-logout.php**
Gerenciam **autenticação de usuários** — registro, login e logout de clientes.

### 👕 **produtos.php / editar_produto.php / form-cardEditar.php**
Área de **gerenciamento de produtos** — exibe, edita e controla o estoque dos itens.

### 🛒 **carrinho.php / add-carrinho.php / carrinho-delete.php**
Gerenciam o **carrinho de compras**, incluindo adição, listagem e remoção de itens.

### ⭐ **favoritar.php / exibir-favorito.php**
Permitem **salvar produtos como favoritos** para acesso rápido posterior.

### 🚚 **endereco.php / editar_endereco.php / excluir_endereco.php**
Gerenciam os **endereços de entrega** do usuário.

### 💳 **pagamento.php / pedidos.php**
Tratam do processo de **finalização de compra** e listagem dos **pedidos realizados**.

### 👑 **adm.php**
Painel administrativo com acesso restrito para *produtos, e pedidos**.

### 📜 **sobre.php**
Página institucional com informações sobre a marca **Novus.z7**.

### 🧩 **.env / .env-exemple**
Definem variáveis de ambiente (ex: credenciais do banco, chaves secretas).  
O arquivo `.env-exemple` serve como modelo de referência.

---

## 💡 Tecnologias Utilizadas

- **PHP 8+**
- **MySQL** (banco de dados)
- **HTML5 / CSS3 / JavaScript**
- **Git / GitHub**
- **Variáveis de ambiente (.env)**

---