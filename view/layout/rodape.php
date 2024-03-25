<footer class="rodape-login">
        <p>© 2024 Toca do boi. Todos os direitos reservados</p>
</footer>
<script src="../js/index.js"></script>
<script>
    // Obter referências aos elementos do DOM
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("openModal");
    var span = document.getElementsByClassName("close")[0];

    // Quando o usuário clicar no botão "Novo", abrir o modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Quando o usuário clicar no botão de fechar, fechar o modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Quando o usuário clicar fora do modal, fechar o modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>