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
                        <input class="form-control" type="file" id="formFile" name="inputimagemProd"
                            accept="image/jpeg, image/png" required>
                    </div>
                    <div class="mb-3">
                        <label for="valor" class="form-label">Sexo</label>
                        <select class="form-select" name="inputSexoProd">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tamanho</label>
                        <input type="text" class="form-control" name="inputTamanhoProd" placeholder="Tamanho (M) ou 39">
                    </div>


                    <div class="mb-3">
                        <label for="material" class="form-label">Material</label>
                        <input type="text" class="form-control" name="inputMaterialProd" placeholder="Material">
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select id="tipoSelect" class="form-select" name="inputTipoProd">
                            <option value="BOTA">Bota</option>
                            <option value="CAMISA">Camisa</option>
                            <option value="CHAPEU">Chapéu</option>
                            <option value="CINTO">Cinto</option>
                        </select>
                    </div>

                    <section id="bota" class="bota hidden">
                        <div class="mb-3">
                            <label for="Altura do cano" class="form-label">Altura do cano</label>
                            <input type="number" class="form-control" name="inputAltCanoProd"
                                placeholder="Altura do cano em cm"></input>
                        </div>
                    </section>

                    <section id="camisa" class="camisa hidden">
                        <div class="mb-3">
                            <label for="Modelo" class="form-label">Modelo</label>
                            <input type="text" class="form-control" name="inputModeloProd"
                                placeholder="Modelo da camisa"></input>
                        </div>
                        <div class="mb-3">
                            <label for="Cor" class="form-label">Cor</label>
                            <input type="text" class="form-control" name="inputCorProd"
                                placeholder="Cor da camisa"></input>
                        </div>
                    </section>

                    <section id="chapeu" class="chapeu hidden">
                        <div class="mb-3">
                            <label for="Estilo" class="form-label">Estilo</label>
                            <input type="text" class="form-control" name="inputEstiloProd"
                                placeholder="Estilo do chapéu"></input>
                        </div>
                        <div class="mb-3">
                            <label for="Circunferência" class="form-label">Circunferência</label>
                            <input type="text" class="form-control" name="inputCirculoProd"
                                placeholder="Circunferência do chapéu"></input>
                        </div>
                    </section>

                    <section id="cinto" class="cinto hidden">
                        <div class="mb-3">
                            <label for="Largura" class="form-label">Largura</label>
                            <input type="text" class="form-control" name="inputLarguraProd"
                                placeholder="Largura do cinto"></input>
                        </div>
                        <div class="mb-3">
                            <label for="Material da fivela" class="form-label">Material da fivela</label>
                            <input type="text" class="form-control" name="inputFivelaProd"
                                placeholder="Material da fivela"></input>
                        </div>
                    </section>

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
        <a class="btn btn-primary mb-3 openModal">Cadastrar novo produto</a>

        <table class="table table-striped zebrado">
            <thead>
                <tr>
                    <th>Cod</th>
                    <th>Nome do produto</th>
                    <th>Fabricante</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Sexo</th>
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


var opcBota = document.getElementById("bota");

//começa com bota aparecendo
opcBota.style.display = "block";


document.addEventListener('DOMContentLoaded', (event) => {
    const tipoSelect = document.getElementById('tipoSelect');

    tipoSelect.addEventListener('change', (event) => {
        const selectedValue = event.target.value;
        console.log('Valor selecionado:', selectedValue);

        var opcBota = document.getElementById("bota");
        var opcCamisa = document.getElementById("camisa");
        var opcChapeu = document.getElementById("chapeu");
        var opcCinto = document.getElementById("cinto");

        if (selectedValue == "BOTA") {
            opcBota.style.display = "block";
            opcCamisa.style.display = "none";
            opcChapeu.style.display = "none";
            opcCinto.style.display = "none";
        } else if (selectedValue == "CAMISA") {
            opcBota.style.display = "none";
            opcCamisa.style.display = "block";
            opcChapeu.style.display = "none";
            opcCinto.style.display = "none";

        } else if (selectedValue == "CHAPEU") {
            opcBota.style.display = "none";
            opcCamisa.style.display = "none";
            opcChapeu.style.display = "block";
            opcCinto.style.display = "none";

        } else if (selectedValue == "CINTO") {
            opcBota.style.display = "none";
            opcCamisa.style.display = "none";
            opcChapeu.style.display = "none";
            opcCinto.style.display = "block";
        }
    });
});
</script>

<?php
  include "layout/rodape.php";
?>