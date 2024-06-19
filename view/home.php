<?php
include "layout/cabecalho.php";
require_once "../controller/Controlador.php";
session_start();
?>

<div class="container-fluid">
    <h1 class="mt-5">Relatório de Vendas</h1>
    <div class="row mt-3">
        <div class="col-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Cod. Venda</th>
                        <th>Cliente</th>
                        <th>Valor Total</th>
                        <th>Data da Venda</th>
                        <th>Endereço de Entrega</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $controlador = new Controlador();
                    echo $controlador->exibirRelatorioVendas();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include "layout/rodape.php";
?>