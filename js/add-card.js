document.addEventListener('DOMContentLoaded', () => {
  const botoesAdd = document.querySelectorAll('.btn-add-carrinho');
  const qtdCarrinhoEl = document.getElementById('qtd-carrinho');
  const toastContainer = document.getElementById('toast-container-novusz7');

  function mostrarToast(msg, tempo = 3000) {
    const toast = document.createElement('div');
    toast.className = 'novusz7-toast';
    // conteúdo com ícone, texto e botão fechar
    toast.innerHTML = `<span class="icon">✔</span><div class="txt">${msg}</div>
                       <button class="close-small" aria-label="Fechar">&times;</button>`;
    toastContainer.appendChild(toast);

    // evento do botão fechar
    const btnClose = toast.querySelector('.close-small');
    btnClose.addEventListener('click', () => {
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 280);
    });

    // mostra com animação
    requestAnimationFrame(() => toast.classList.add('show'));

    // remove automaticamente
    const timeoutId = setTimeout(() => {
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 280);
    }, tempo);

    // se o usuário clicar no toast, evita remoção imediata (opcional)
    toast.addEventListener('mouseenter', () => clearTimeout(timeoutId));
  }

  botoesAdd.forEach(botao => {
    botao.addEventListener('click', () => {
      const id = botao.getAttribute('data-id');

      fetch('add-carrinho.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${encodeURIComponent(id)}`
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