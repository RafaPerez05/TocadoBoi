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
                        <button class="btn btn-sm bg-dark text-white px-lg-5 px-3 openModal">CONTINUE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
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

        // Função para salvar os valores iniciais de todos os inputs
        function salvarValoresIniciais() {
            var inputs = document.querySelectorAll('[id^="quantity"]');
            inputs.forEach(function(input) {
                var initialValue = parseFloat(input.value);
                $(input).data("initial-value", initialValue);
            });
        }

        // Atualizar o total e salvar os valores iniciais quando a página for carregada
        salvarValoresIniciais();
        calcularTotal();

        // Evento de clique no botão de aumento
        $(".increase").click(function() {
            var targetInput = $("#" + $(this).data("target"));

            var initialValue = targetInput.data("initial-value");
            var currentValue = parseFloat(targetInput.val());
            targetInput.val(currentValue + initialValue);
            var addInput = $("#" + $(this).data("add"));
            currentValue = parseFloat(addInput.val());
            addInput.val(currentValue + 1);

            // Recalcular o total
            calcularTotal();
        });

        // Evento de clique no botão de diminuição
        $(".decrease").click(function() {
            var targetInput = $("#" + $(this).data("target"));

            var initialValue = targetInput.data("initial-value");
            var currentValue = parseFloat(targetInput.val());

            if (currentValue > initialValue) {
                targetInput.val(currentValue - initialValue);
                var addInput = $("#" + $(this).data("add"));
                currentValue = parseFloat(addInput.val());
                addInput.val(currentValue - 1);

                // Recalcular o total
                calcularTotal();
            }
        });
    });



    // LINHA 109 a 156 ESSE CODIGO TODO SÓ P VER SE TEM O ENDEREÇO NESSA MERDA 
    // MODAL CADASTRO
    var modalCad = document.getElementById("myModal");
    var btnsModalCad = document.querySelectorAll(".openModal");
    var spanCad = document.getElementsByClassName("close")[0];

    // Verificação para modalCad
    if (!modalCad) {
        console.error('Elemento com id "myModal" não encontrado');
    }

    // Verificação para spanCad
    if (!spanCad) {
        console.error('Elemento com classe "close" não encontrado');
    }

    // Esconder o modal de cadastro de endereço
    var codEndereco = document.getElementById("codEndereco");
    var modalCadEndereco = document.getElementsByClassName("form-endereco")[0];

    // Verificação para codEndereco
    if (!codEndereco) {
        console.error('Elemento com id "codEndereco" não encontrado');
    } else {
        console.log(codEndereco.value);
    }

    // Verificação para modalCadEndereco
    if (!modalCadEndereco) {
        console.error('Elemento com classe "endereco" não encontrado');
    }

    btnsModalCad.forEach(function(btn) {
        btn.onclick = function() {
            if (!modalCad) return; // Verificação adicional
            modalCad.style.display = "block";

            if (codEndereco && codEndereco.value != "") {
                if (modalCadEndereco) {
                    modalCadEndereco.style.display = "none";
                }
            } else {
                if (modalCadEndereco) {
                    modalCadEndereco.style.display = "block";
                }
            }
        }
    });

    // Quando o usuário clicar no botão de fechar (para o modal de cadastro), fechar o modal
    spanCad.onclick = function() {
        modalCad.style.display = "none";
    }

    // Quando o usuário clicar fora do modal (para o modal de alteração), fechar o modal
    window.onclick = function(event) {
        if (event.target == modalCad) {
            modalCad.style.display = "none";
        } else if (event.target == modalCad) {
            modalCad.style.display = "none";
        }
    }
    </script>





    <?php
  include "layout/rodape.php";
?>