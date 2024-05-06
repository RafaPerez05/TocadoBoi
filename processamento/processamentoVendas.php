<?php

session_start();
require_once("../controller/Controlador.php");
require_once("../model/Produto.php");
require_once("../model/Carrinho.php");
require_once("../model/Venda.php");

$controlador = new Controlador();

if(isset($_POST['produto_cod']) &&
   isset($_POST['cliente_cod']) && 
   isset($_POST['quantidade'])
   
   )
{
    $produto_cod = $_POST['produto_cod'];
    $cliente_cod = $_POST['cliente_cod'];
    $quantidade = $_POST['quantidade'];
    
    $controlador->adcionarCarrinho($cliente_cod,$produto_cod,$quantidade);
    header('Location:../view/clienteVerProduto.php');

    
    die();
}