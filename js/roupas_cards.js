const container = document.getElementById('produtos-container');

async function carregarProdutos() {
    try {
        const data = await fetch('./json/roupas.json').then(res => res.json());
        const produtos = data.produtos;

        produtos.forEach(produto => {
            const { nome, imagens, preco, descricao, linkCompra } = produto;
            const imagem = imagens && imagens.length > 0 ? imagens[0] : "./img/default.png";

            const coluna = document.createElement('figure');
            coluna.className = 'col';

            coluna.innerHTML = `
                <figure class="product">
                    <img src="${imagem}" alt="${nome}">
                    <figcaption>
                        <h3>${nome}</h3>
                        <p>${descricao}</p>
                        <div class="preco">R$ ${preco.toFixed(2)}</div>
                        <a class="buy-btn" href="${linkCompra}" target="_blank">Comprar agora</a>
                    </figcaption>
                </figure>
            `;

            container.appendChild(coluna);
        });
    } catch (erro) {
        console.error("Erro ao carregar produtos:", erro);
        container.innerHTML = "<p>Não foi possível carregar os produtos.</p>";
    }
}

carregarProdutos();
