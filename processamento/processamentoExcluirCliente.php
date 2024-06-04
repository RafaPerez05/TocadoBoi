<?php
require_once("../controller/Controlador.php");

$controlador = new Controlador();

if(isset($_POST["cod"])
){
    $cod = $_POST["cod"];

    echo $cod;
    $controlador->excluirCliente($cod);
    header('Location:../view/gerenciaCliente.php');
    die();
} else {
    echo "ID do produto não encontrado.";
}