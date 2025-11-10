//refaça o readme.md falando sobre o esse projeto
## Tema gerador
- Desenvolvimento de um software utilizando a arquitetura cliente e servidor.

## tema do projeto O quê é?
- um site de venda de roupas 

## objetivo e para que?

- vender camisas de alta qualidade com um preço acessivel

## detalhamento como?

- **acões necessarias para o desenvolvimento:** pegamos de referencias sitemas de vendas de roupas, tenis e até mesmo eletronicos.
usamos referencias como a estilização e organização desses sites e principalmente seus forms de cadastro 

     usamos uma branch  para podermos mexer os dois no mesmo  projeto ao mesmo tempo 

     para relizar nossos obijetivos precisamos de diciplina e concentração 

# novus.z7 (PI)
versão PI da NOVUs.z7
## Estrutura de Pastas e Arquivos

## 🌟 Estrutura Detalhada do Projeto

A seguir, você encontra uma visão completa e organizada da estrutura do projeto, com explicações claras sobre o papel de cada pasta e arquivo. Isso facilita o entendimento, manutenção e colaboração no desenvolvimento.

```
novus.z7--PI-/
├── src/
│   ├── main.py               # 🚀 Ponto de entrada da aplicação
│   ├── controllers/          # 🎛️ Controladores das rotas e regras de negócio
│   │   └── user_controller.py    # 👤 Gerenciamento de usuários
│   ├── models/               # 🗄️ Modelos de dados e entidades
│   │   └── user.py               # 👤 Estrutura do usuário
│   └── views/                # 🖼️ Interface do usuário (templates)
│       └── index.html            # 🏠 Página inicial
├── config/
│   ├── settings.py           # ⚙️ Configurações gerais do projeto
│   └── database.py           # 🛢️ Configuração do banco de dados
├── tests/
│   ├── test_main.py          # ✅ Testes do main.py
│   └── test_user.py          # ✅ Testes de funcionalidades de usuário
├── requirements.txt          # 📦 Dependências do projeto
├── README.md                 # 📖 Documentação principal
└── .gitignore                # 🚫 Arquivos ignorados pelo Git
```

### 📂 Descrição dos principais arquivos e pastas

- **src/main.py**: Inicia a aplicação, carrega módulos e configurações.
- **src/controllers/**: Gerencia as rotas e lógica de negócio. Exemplo: `user_controller.py` cuida das operações de usuário.
- **src/models/**: Define as estruturas de dados do sistema, como usuários, produtos, etc.
- **src/views/**: Contém os templates e páginas que compõem a interface do usuário.
- **config/settings.py**: Centraliza variáveis de ambiente, chaves secretas e parâmetros de configuração.
- **config/database.py**: Realiza a configuração e inicialização do banco de dados.
- **tests/**: Abriga os testes automatizados para garantir qualidade e estabilidade do código.
- **requirements.txt**: Lista todas as bibliotecas necessárias para rodar o projeto.
- **README.md**: Documentação completa do projeto, com instruções de uso e informações relevantes.
- **.gitignore**: Define arquivos e pastas que não devem ser versionados.

---

## 🚀 Como executar o projeto

1. Instale as dependências:
    ```bash
    pip install -r requirements.txt
    ```
2. Configure as variáveis de ambiente em `config/settings.py`.
3. (Opcional) Ajuste o banco de dados em `config/database.py`.
4. Execute o sistema:
    ```bash
    python src/main.py
    ```

---

---

## 📄 Licença

Este projeto está sob a licença  MIT. Consulte o arquivo LICENSE para mais detalhes.


