<?php
require_once "../controller/Controlador.php";
include "layout/cabecalho.php";
?>
<main>
    <!-- Modal -->
    <div id="myModal" class="modal">
        <!-- Conteúdo do modal -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <section class="conteudo-formulario-cadastro">
                <form id="form-log" method="POST" action="../processamento/processamento.php" class="container mt-5">
                    <label for="inputNome">Nome</label>
                    <input id="inputNome" type="text" class="form-control mb-3" placeholder="Nome" name="inputNome"
                        required>

                    <label for="inputSobrenome">Sobrenome</label>
                    <input id="inputSobrenome" type="text" class="form-control mb-3" placeholder="Sobrenome"
                        name="inputSobrenome" required>

                    <label for="inputCPF">CPF</label>
                    <input id="inputCPF" type="text" class="form-control mb-3" placeholder="CPF" name="inputCPF"
                        maxlength="11" required>

                    <label for="inputDataNasc">Data de nascimento</label>
                    <input id="inputDataNasc" type="date" class="form-control mb-3" placeholder="Data de nascimento"
                        name="inputDataNasc" required>

                    <label for="inputTelefone">Telefone</label>
                    <input id="inputTelefone" type="tel" class="form-control mb-3"
                        pattern="\(?[0-9]{2}\)?\s?[0-9]{4,5}-?[0-9]{4}" placeholder="Telefone" name="inputTelefone"
                        required>

                    <label for="inputEmail">Email</label>
                    <input id="inputEmail" type="email" class="form-control mb-3" placeholder="Email" name="inputEmail"
                        required>

                    <label for="inputSenha">Senha</label>
                    <input id="inputSenha" type="password" class="form-control mb-3" placeholder="Senha"
                        name="inputSenha" required>

                    <button id="botao-log" type="submit" class="btn btn-success">CADASTRAR-SE</button>
                </form>
            </section>
        </div>
    </div>

    <!-- Modal alterar -->
    <div id="myModalAlterar" class="modal">
        <!-- Conteúdo do modal -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <?php
                    $controlador = new Controlador();
                    echo $controlador->visualizarProdutosModal();
                ?>
        </div>
    </div>

    <section class="conteudo-visualizar">
        <section class="conteudo-visualizar-box">
            <h1>Clientes</h1>
        </section>
        <h3>Gerenciamento de Clientes</h3>
        <a class="btn btn-primary mb-3 openModal">Cadastrar novo cliente</a>

        <table class="table table-borderless zebrado">
            <thead class="table">
                <tr>
                    <th>Cod</th>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Email</th>
                    <th>Telefone</th>

                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <?php
                        $controlador = new Controlador();
                        echo $controlador->visualizarClientes();
                    ?>
        </table>
    </section>

</main>
<script>
//MODAL CADASTRO
var modalCad = document.getElementById("myModal");
var btnsModalCad = document.querySelectorAll(".openModal");
var spanCad = document.getElementsByClassName("close")[0];

// Para cada botão de cadastro, adicionar um evento de clique para abrir o modal
btnsModalCad.forEach(function(btn) {
    btn.onclick = function() {
        modalCad.style.display = "block";
    }
});

// Quando o usuário clicar no botão de fechar (para o modal de cadastro), fechar o modal
spanCad.onclick = function() {
    modalCad.style.display = "none";
}

// Quando o usuário clicar fora do modal fechar o modal
window.onclick = function(event) {
    if (event.target == modalCad) {
        modalCad.style.display = "none";
    }
}
</script>

<?php
  include "layout/rodape.php";
?>