<?php
require_once "../controller/Controlador.php";
include "clienteLayout/cabecalho.php";
?>
<div class="container bg-white rounded-top mt-5" id="zero-pad">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 col-12 pt-3">
            <div class="d-flex flex-column pt-4">
                <div>
                    <h5 class="text-uppercase font-weight-normal">Itens do carrinho</h5>
                    <?php
                    $controlador = new Controlador();
                    echo $controlador->visualizarProdutosCarrinho();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container bg-light rounded-bottom py-4" id="zero-pad">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10 col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <button class="btn btn-sm bg-light border border-dark"><a href="clienteVerProduto.php"
                                style="text-decoration: none;color:black;">Voltar</a></button>
                    </div>
                    <div class="px-md-0 px-1" id="footer-font">
                        <b class="pl-md-4">TOTAL R$</b>
                        <input id="total"
                            style="border: none; background: transparent; outline: none;text-align: center" readonly
                            size="1" Value="0"></input>
                    </div>
                    <div>
                        <button class="btn btn-sm bg-dark text-white px-lg-5 px-3">CONTINUE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    // Declare a variável initialValue no escopo global
    var initialValue;

    $(document).ready(function() {
        // Função para calcular o total
        function calcularTotal() {
            var inputs = document.querySelectorAll('[id^="quantity"]');
            var sum = 0;
            inputs.forEach(function(input) {
                sum += parseFloat(input.value); // Convert value to float and add to sum
            });
            document.getElementById("total").value = sum; // Update the total sum
        }

        // Atualizar o total quando a página for carregada
        calcularTotal();

        // Evento de clique no botão de aumento
        $(".increase").click(function() {
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

            // Recalcular o total
            calcularTotal();
        });

        // Evento de clique no botão de diminuição
        $(".decrease").click(function() {
            var targetInput = $("#" + $(this).data("target"));

            var initialValue = parseFloat(targetInput.data("initial-value"));

            var currentValue = parseFloat(targetInput.val());

            if (currentValue > initialValue) {
                targetInput.val(currentValue - initialValue);
                var addInput = $("#" + $(this).data("add"));
                var currentValue = parseFloat(addInput.val());
                addInput.val(currentValue - 1);

                // Recalcular o total
                calcularTotal();
            }
        });

    });
    </script>



    <?php
  include "layout/rodape.php";
?>