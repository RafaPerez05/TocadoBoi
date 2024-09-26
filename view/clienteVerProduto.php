<?php
  require_once "../controller/Controlador.php";
  include "clienteLayout/cabecalho.php";

  // Acessando a sessão via SessionManager
  $vendaEfetuada = SessionManager::get("venda_efetuada");

  if (isset($vendaEfetuada)) {
    $alertClass = $vendaEfetuada ? 'success' : 'danger';
    $alertMessage = $vendaEfetuada ? 'Venda efetuada com sucesso!' : 'Erro ao efetuar a venda. Por favor, tente novamente.';
?>
<div id="alerta-venda"
    class="alert alert-<?php echo $alertClass; ?> alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x"
    role="alert">
    <?php echo $alertMessage; ?>
    <button type="button" class="btn-close" aria-label="Close"></button>
</div>
<?php
    // Removendo a sessão com SessionManager
    SessionManager::remove("venda_efetuada");
}
?>

<form class="d-flex m-4">
    <input class="form-control" id="searchInput" type="search" placeholder="O que procura?" aria-label="Search">
    <button class="btn btn-outline-secondary" type="hiden">
        <i class="fa fa-search" aria-hidden="true"></i>
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
const productsList = document.getElementsByClassName('col-lg-4 col-md-6');

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

document.addEventListener('DOMContentLoaded', function() {
    // Seleciona o alerta pela classe e atribui uma transição
    var alerta = document.getElementById('alerta-venda');
    alerta.style.transition = 'transform 0.3s ease-in-out, opacity 0.5s ease';

    // Fecha o alerta após 3 segundos
    setTimeout(function() {
        alerta.style.transform = 'translateX(100%)';
        alerta.style.opacity = '0';
        alerta.addEventListener('transitionend', function() {
            alerta.remove();
        });
    }, 5000);

    // Fecha o alerta ao clicar no botão de fechar
    var btnFechar = alerta.querySelector('.btn-close');
    btnFechar.addEventListener('click', function() {
        alerta.style.transform = 'translateX(100%)';
        alerta.style.opacity = '0';
        alerta.addEventListener('transitionend', function() {
            alerta.remove();
        });
    });
});
</script>

<?php
  include "clienteLayout/rodape.php";
?>