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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    // Declare a variável initialValue no escopo global
    var initialValue;

    $(document).ready(function () {
      $(".increase").click(function () {
        var targetInput = $("#" + $(this).data("target"));

        if (!targetInput.data("initial-value")) {
          var initialValue = parseFloat(targetInput.val());
          targetInput.data("initial-value", initialValue);
        }


        var initialValue = targetInput.data("initial-value");
        var currentValue = parseFloat(targetInput.val());
        targetInput.val(currentValue + initialValue);

        var addInput = $("#" + $(this).data("add"));
        var currentValue = parseFloat(addInput.val());
        addInput.val(currentValue + 1);
      });

      $(".decrease").click(function () {
        var targetInput = $("#" + $(this).data("target"));

        var initialValue = parseFloat(targetInput.data("initial-value"));

        var currentValue = parseFloat(targetInput.val());

        if (currentValue > initialValue) {
          targetInput.val(currentValue - initialValue);
          var addInput = $("#" + $(this).data("add"));
          var currentValue = parseFloat(addInput.val());
          addInput.val(currentValue - 1);
        }
      });

    });
  </script>

<?php
  include "layout/rodape.php";
?>
