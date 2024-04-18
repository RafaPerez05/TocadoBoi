<?php
require_once("../controller/Controlador.php");
$controlador = new Controlador();

if(
    isset($_POST['inputCod']) &&
    isset($_POST['inputNome']) &&
    isset($_POST['inputSobrenome']) && 
    isset($_POST['inputCPF']) && 
    isset($_POST['inputDataNasc']) && 
    isset($_POST['inputTelefone']) && 
    isset($_POST['inputEmail']) &&
    isset($_POST['inputSenha'])
   )
{   
    $cod = $_POST['inputCod'];
    $nome = $_POST['inputNome'];
    $sobrenome = $_POST['inputSobrenome'];
    $cpf = $_POST['inputCPF'];
    $dataNasc = $_POST['inputDataNasc'];
    $telefone = $_POST['inputTelefone'];
    $email = $_POST['inputEmail'];
    $senha = $_POST['inputSenha'];

    echo $cod;
    
    $controlador->alterarCliente($cod, $nome, $sobrenome, $cpf, $dataNasc, $telefone, $email, $senha);
    session_destroy();
    session_start();
    header('Location:../view/clienteGerenciaUsuario.php');
    die();
}