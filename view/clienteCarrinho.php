<?php
require_once "../controller/Controlador.php";
include "clienteLayout/cabecalho.php";
?>
    <div class="container">
        <div class="row">
            <?php
                $controlador = new Controlador();
                echo $controlador->visualizarProdutosCarrinho();
            ?>
            <!-- Adicione mais produtos conforme necessário -->
        </div>
    </div>


    <label for="valor">Valor:</label>
<input type="text" id="valor" name="valor" value="10" readonly style="border: none; background: transparent; outline: none; text-align: center;">

<label for="quantidade">Quantidade:</label>
<input type="number" id="quantidade" name="quantidade" min="0" step="1" oninput="updateValor()">

<script>
function updateValor() {
  var valorInput = document.getElementById('valor');
  var quantidadeInput = document.getElementById('quantidade');

  var valor = parseFloat(valorInput.value);
  var quantidade = parseFloat(quantidadeInput.value);

  if (!isNaN(valor) && !isNaN(quantidade)) {
    valorInput.value = valor * quantidade;
  }
}
</script>



<?php
  include "layout/rodape.php";
?>
