document.querySelectorAll('.btn-fav').forEach(button => {
    button.addEventListener('click', () => {
        const produtoId = button.getAttribute('data-id');
        favoritarProduto(produtoId);
    });
});

function favoritarProduto(produtoId) {
    fetch('favoritar.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ produtoId: produtoId })
    })
    .then(res => res.json())
    .then(data => {
        const btn = document.getElementById(`fav-${produtoId}`);
        const icon = btn.querySelector('i');

        if (data.favorito) {
            icon.classList.remove('bi-heart');
            icon.classList.add('bi-heart-fill', 'text-danger');
        } else {
            icon.classList.remove('bi-heart-fill', 'text-danger');
            icon.classList.add('bi-heart');
        }
    })
    .catch(err => console.error('Erro ao favoritar:', err));
}
