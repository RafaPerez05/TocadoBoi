<?php
session_start();
require_once("../controller/Controlador.php");

$controlador = new Controlador();

if(isset($_POST["cod"])){
    $cod = $_POST["cod"];
    $controlador->excluirCarrinho($cod);
    header('Location:../view/clienteCarrinho.php');

    die();
} else {
    echo "ID do produto não encontrado.";
}
?>