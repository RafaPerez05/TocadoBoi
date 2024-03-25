<?php
    
    require_once "../controller/Controlador.php";
?>
<?php
  include "layout/cabecalho.php";
?>
<main>
        <!-- Modal -->
        <div id="myModal" class="modal">
        <!-- Conteúdo do modal -->
        <div class="modal-content">
        <span class="close">&times;</span>
            <section class="conteudo-formulario-cadastro">
                <form action="../processamento/processamento.php" method="POST">
                    <label>Cadastrar Produto</label>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="inputNomeProd" placeholder="Nome">
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
                        <input class="form-control" type="file" id="formFile" name="imagem">
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
            </section>
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
                </tr>
            </thead>
                    <?php
                        $controlador = new Controlador();
                        echo $controlador->visualizarProdutos();
                    ?>
            </table>
    </section>

</main>
<?php
  include "layout/rodape.php";
?>
</body>
</html>