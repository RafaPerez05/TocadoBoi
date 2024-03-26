<?php
  require_once "../controller/Controlador.php";
  include "layout/cabecalho.php";
?>
    <div class="container">
        <div class="row">
            <?php
                $controlador = new Controlador();
                echo $controlador->visualizarProdutosFem();
            ?>
            <!-- Adicione mais produtos conforme necessário -->
        </div>
    </div>
<?php
  include "layout/rodape.php";
?>