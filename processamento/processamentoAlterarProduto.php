<?php
session_start();
require_once("../controller/Controlador.php");

$controlador = new Controlador();

if(isset($_POST["cod"]) && isset($_POST["tipo"])){
        $cod = $_POST["cod"];
        $tipo = $_POST["tipo"];
    
        echo $tipo;
    }
 
?>