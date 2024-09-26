<footer class="rodape-login">
    <p>© 2024 Toca do boi. Todos os direitos reservados</p>
</footer>
<script src="../js/index.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
// Espera o DOM estar completamente carregado
document.addEventListener("DOMContentLoaded", function() {
    // Obtém o valor do input oculto
    const quantidadeForm = document.getElementById('quantidadeForm');
    const quantidadeInput = quantidadeForm.querySelector('input[name="quantidadeCarrinhoBanco"]');
    const cartBadge = document.querySelector('.cart-badge');

    // Obtém o valor e atualiza o cart-badge
    const quantidade = parseInt(quantidadeInput.value) || 0; // Converte para número, ou 0 se não for um número

    // Atualiza o badge e a visibilidade do span
    cartBadge.textContent = quantidade; // Atualiza o conteúdo do span
    if (quantidade > 0) {
        cartBadge.style.display = 'inline'; // Mostra o badge se a quantidade for maior que 0
    } else {
        cartBadge.style.display = 'none'; // Esconde o badge se a quantidade for 0
    }
});


</script>
</body>

</html>