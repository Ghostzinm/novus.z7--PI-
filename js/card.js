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
        let img = produto.img;
        let telaProduto = produto.telaProduto;

        console.log(nome, idProduto, descricao, preco);

        const coluna = document.createElement('div');
        coluna.className = 'col';

        coluna.innerHTML = `
            <figure class="product">
                <a href="${telaProduto}" target="_blank">
                    <img src="${img}" alt="${nome}">
                <figcaption>
                    <h3>${nome}</h3>
                    <p>${descricao}</p>
                    <div class="preco">R$ ${preco}</div>
                </figcaption>
                </a>
            </figure>
        `;


        container.appendChild(coluna);
    });
}

carregarProdutos();
