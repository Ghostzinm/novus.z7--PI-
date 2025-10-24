document.addEventListener('DOMContentLoaded', () => {
  const botoesAdd = document.querySelectorAll('.btn-add-carrinho');
  const qtdCarrinhoEl = document.getElementById('qtd-carrinho');
  const toastContainer = document.getElementById('toast-container-novusz7');

  function mostrarToast(msg, tempo = 3000) {
    const toast = document.createElement('div');
    toast.className = 'novusz7-toast';
    toast.innerHTML = `<span class="icon">✔</span><div class="txt">${msg}</div>
                       <button class="close-small" aria-label="Fechar">&times;</button>`;
    toastContainer.appendChild(toast);

    const btnClose = toast.querySelector('.close-small');
    btnClose.addEventListener('click', () => {
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 280);
    });

    requestAnimationFrame(() => toast.classList.add('show'));
    const timeoutId = setTimeout(() => {
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 280);
    }, tempo);

    toast.addEventListener('mouseenter', () => clearTimeout(timeoutId));
  }

  botoesAdd.forEach(botao => {
    botao.addEventListener('click', () => {
      const id = botao.getAttribute('data-id');

      // 🔹 NOVO: pega também o tamanho e a quantidade, se existirem no produto
      const tamanho = document.getElementById('tamanho')?.value || 'Único';
      const quantidade = document.getElementById('quantidade')?.value || 1;

      // 🔹 aqui você envia tudo pro PHP
      

      fetch('add-carrinho.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${encodeURIComponent(id)}&tamanho=${encodeURIComponent(tamanho)}&quantidade=${encodeURIComponent(quantidade)}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          mostrarToast(`"${data.produto.nome}" adicionado ao carrinho 🛒`);
          if (data.total_itens !== undefined) {
            qtdCarrinhoEl.textContent = data.total_itens;
          } else if (data.carrinho_qtd !== undefined) {
            qtdCarrinhoEl.textContent = data.carrinho_qtd;
          }
        } else {
          mostrarToast('Erro: ' + (data.msg || 'não foi possível adicionar'));
        }
      })
      .catch(err => {
        console.error(err);
        mostrarToast('Erro na requisição');
      });
    });
  });
});
