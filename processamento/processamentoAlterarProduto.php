<?php
session_start();
require_once("../controller/Controlador.php");

$controlador = new Controlador();

if(isset($_POST["cod"]) && isset($_POST["tipo"])
){
    $cod = $_POST["cod"];
    $tipo = $_POST["tipo"];

    echo $tipo; 
    //$controlador->excluirProduto($cod,$tipo);
    //header('Location:../view/cadastroProduto.php');
    die();
} else {
    echo "ID do produto não encontrado.";
}