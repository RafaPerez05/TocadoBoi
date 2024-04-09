<?php
  require_once "../controller/Controlador.php";
  include "clienteLayout/cabecalho.php";
  session_start();
?>
    <h1>Olá cliente <?php echo  $_SESSION['nome']; ?></h1>
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
    </div>

    <div class="container">
        <div class="row">
            <?php
                $controlador = new Controlador();
                echo $controlador->visualizarProdutosGrid();
            ?>
            <!-- Adicione mais produtos conforme necessário -->
        </div>
    </div>

<?php
  include "clienteLayout/rodape.php";
?>