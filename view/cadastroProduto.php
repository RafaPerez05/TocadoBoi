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
                <form action="../processamento/processamento.php" method="POST" enctype="multipart/form-data">
                    <label>Cadastrar Produto</label>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="inputNomeProd" placeholder="Nome"></input>
                    </div>
                    <div class="mb-3">
                        <label for="fabricante" class="form-label">Fabricante</label>
                        <input type="text" class="form-control" name="inputFabricanteProd" placeholder="Fabricante">
                    </div>
                    <div class="mb-3">
                        <label for="descrição" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="inputDescricaoProd" placeholder="Descrição">
                    </div>
                    <div class="mb-3">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="text" class="form-control" name="inputValorProd" placeholder="Valor">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Imagem</label>
                        <input class="form-control" type="file" id="formFile" name="inputimagemProd" accept="image/jpeg, image/png" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
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
            <h1>Produtos</h1>
        </section>
            <h3>Gerenciamento de Produtos</h3>
            <a id="openModal" class="btn btn-primary mb-3">Cadastrar novo produto</a>

            <table class="table table-striped zebrado">
            <thead>
                <tr>
                <th>Cod</th>
                <th>Nome do produto</th>
                <th>Fabricante</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th></th>
                <th></th>
                </tr>
            </thead>
                    <?php
                        $controlador = new Controlador();
                        echo $controlador->visualizarProdutos();
                    ?>
            </table>
    </section>

</main>
<script>
    //MODAL CADASTRO
    var modalCad = document.getElementById("myModal");
    var btnModalCad = document.getElementById("openModal");
    var spanCad = document.getElementsByClassName("close")[0];

    // Quando o usuário clicar no botão "Novo", abrir o modal de cadastro
    btnModalCad.onclick = function() {
        modalCad.style.display = "block";
    }

    // Quando o usuário clicar no botão de fechar (para o modal de cadastro), fechar o modal
    spanCad.onclick = function() {
        modalCad.style.display = "none";
    }

    //MODAL ALTERAR
    var modalAlt = document.getElementById("myModalAlterar");
    var btnModalAlt = document.getElementById("openModalAlterar");
    var spanAlt = document.getElementsByClassName("close")[1]; // Use [1] para obter o segundo elemento com a classe "close"

    // Quando o usuário clicar no botão "Alterar", abrir o modal de alteração
    btnModalAlt.onclick = function() {
        modalAlt.style.display = "block";
    }

    // Quando o usuário clicar no botão de fechar (para o modal de alteração), fechar o modal
    spanAlt.onclick = function() {
        modalAlt.style.display = "none";
    }

    // Quando o usuário clicar fora do modal (para o modal de alteração), fechar o modal
    window.onclick = function(event) {
        if (event.target == modalAlt) {
            modalAlt.style.display = "none";
        } else if (event.target == modalCad) {
            modalCad.style.display = "none";
        }
    }
</script>
<?php
  include "layout/rodape.php";
?>

