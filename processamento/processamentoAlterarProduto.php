<?php
session_start();
require_once("../controller/Controlador.php");

$controlador = new Controlador();

function obterCodigo($cod){
    if(isset($_POST["cod"])){
        $cod = $_POST["cod"];
    }
    return $cod;
}   
?>
