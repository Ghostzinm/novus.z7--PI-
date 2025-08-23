const container = document.getElementById('container-produtos');

async function carregarProdutos() {
    // Pega todo o JSON de uma vez
    const resposta = await fetch("./json/roupas.json");
    const data = await resposta.json(); // data.produtos

    data.produtos.forEach(produto => {
        let nome = produto.nome;
        let idProduto = produto.id;
        let descricao = produto.descricao;
        let preco = produto.preco;
  
        let linkCompra = produto.linkCompra;

        console.log(nome, idProduto, descricao, preco);

        const coluna = document.createElement('div');
        coluna.className = 'col';

        coluna.innerHTML = `
            <figure class="product">
                <figcaption>
                    <h3>${nome}</h3>
                    <p>${descricao}</p>
                    <div class="preco">R$ ${preco}</div>
                </figcaption>
            </figure>
        `;

        container.appendChild(coluna);
    });
}

carregarProdutos();
