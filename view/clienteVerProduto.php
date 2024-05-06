<?php
  require_once "../controller/Controlador.php";
  include "clienteLayout/cabecalho.php";
  session_start();
?>

<form class="d-flex m-4">
    <input class="form-control" id="searchInput" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit"><i class="fa fa-search" aria-hidden="true"></i>
    </button>
</form>
<!-- 
<div class="container">
    <a href="clienteVerProdutoMasc.php">
        <div class="square design">
            <img src="../imagens/homem.png" alt="Imagem">
            <div class="overlay">
                <h2>Produtos Masculinos</h2>
                <p>Clique para ver produtos para Cowboys</p>
            </div>
        </div>
    </a>
    <a href="clienteVerProdutoFem.php">
        <div class="square design">
            <img src="../imagens/mulher.png" alt="Imagem">
            <div class="overlay">
                <h2>Produtos Femininos</h2>
                <p>Clique para ver mais sobre produtos para Cowgirls</p>
            </div>
        </div>
    </a>
</div>
-->

<div class="container">
    <div class="row">
        <?php
                $controlador = new Controlador();
                echo $controlador->visualizarProdutosGrid();
            ?>
    </div>
</div>

<script>
const searchInput = document.getElementById('searchInput');
const productsList = document.getElementsByClassName('product-card');

const test = productsList[0].getAttribute("id");

console.log(test);

searchInput.addEventListener('input', function() {
    const searchText = searchInput.value.toLowerCase();
    console.log(searchText);

    for (let i = 0; i < productsList.length; i++) {
        // Obtém as tags do produto
        const tags = productsList[i].getAttribute("id").toLowerCase();

        if (tags.includes(searchText)) {
            // Se sim, mostra o produto
            productsList[i].style.display = 'block';
        } else {
            // Se não, oculta o produto
            productsList[i].style.display = 'none';
        }
    }
});
</script>

<?php
  include "clienteLayout/rodape.php";
?>