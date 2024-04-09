<?php
  require_once "../controller/Controlador.php";
  include "clienteLayout/cabecalho.php";

?>
    <div class="container">
        <div class="row">
            <?php
                $controlador = new Controlador();
                echo $controlador->visualizarProdutosMasc();
            ?>
            <!-- Adicione mais produtos conforme necessário -->
        </div>
    </div>
<?php
  include "clienteLayout/rodape.php";
?>