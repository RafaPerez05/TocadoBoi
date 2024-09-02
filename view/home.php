<?php
include "layout/cabecalho.php";
require_once "../controller/Controlador.php";
session_start();
?>

<div class="container-fluid">
    <h1 class="mt-5">Relatório de Vendas</h1>
        <?php
        $controlador = new Controlador();
        echo $controlador->botoesBaixarRelatorio();
        ?>
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
<script>

    //baixar JSON já gerado por aqui !!
    document.getElementById("downloadJson").addEventListener("click", function() {
        const link = document.createElement("a");
        link.href = "../model/JSON/relatorio_vendas.json";
        link.download = "relatorio_vendas.json";
        link.click();
    });

    //baixar CSV já gerado por aqui !!
    document.getElementById("downloadCsv").addEventListener("click", function() {
        const link = document.createElement("a");
        link.href = "../model/JSON/relatorio_vendas.csv";
        link.download = "relatorio_vendas.csv";
        link.click();
    });

</script>
<?php
include "layout/rodape.php";
?>