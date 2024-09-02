<?php
require_once("../controller/Controlador.php");
$controlador = new Controlador();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao']) && $_POST['acao'] === 'baixarJson') {

        echo "Teste 123";
        $controlador->gerarRelatoioJson();

        header('Location:../view/home.php');

    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao']) && $_POST['acao'] === 'baixarCsv') {

        echo "Teste 456";
        $controlador->gerarCsvRelatorioVendas();

        header('Location:../view/home.php');

    }
}
